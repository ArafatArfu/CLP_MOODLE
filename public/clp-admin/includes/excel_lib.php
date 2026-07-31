<?php
// CLP Admin Panel - Excel import/export library for CLC participant records.
//
// This is a self-contained, dependency-free implementation of the CLC Excel
// upload feature migrated from the SkillConnect dashboard (upload.php +
// clc_import_service). It provides:
//   - download_template(): stream an .xlsx template with the expected columns
//   - preview():           parse an uploaded .xlsx / .csv file, validate rows
//   - import():            insert the valid rows into mdl_clp_clc_participants
//
// XLSX is read/written natively (an .xlsx file is a ZIP of XML parts), so no
// external library (PhpSpreadsheet, Spout, etc.) or Composer autoloader is
// required. CSV uploads are also supported.
//
// Column order matches the SkillConnect template exactly:
//   School Name | Month | Year | Student Name | Father's Name | Mother's Name |
//   Class | Division | District | Upazila/Thana | Mobile | Email | Gender
// (The "Class" column is preserved in the template/preview for fidelity with
// SkillConnect, but is not stored because the current CLC table has no such
// column.)

require_once __DIR__ . '/functions.php';

class Clp_Clc_Excel {

    /** Physical table name for CLC participants (mdl_ prefix). */
    const TABLE = 'mdl_clp_clc_participants';

    /** Template / expected column headers, in order. */
    public static function columns() {
        return [
            'school'      => 'School Name',
            'month'       => 'Month',
            'year'        => 'Year',
            'name'        => "Student Name",
            'father_name' => "Father's Name",
            'mother_name' => "Mother's Name",
            'class'       => 'Class',
            'division'    => 'Division',
            'district'    => 'District',
            'upazila'     => 'Upazila/Thana',
            'mobile'      => 'Mobile',
            'email'       => 'Email',
            'gender'      => 'Gender',
        ];
    }

    // ------------------------------------------------------------------
    // Template download.
    // ------------------------------------------------------------------

    /**
     * Stream an .xlsx template (header row + one example row) to the browser.
     */
    public static function download_template() {
        $headers = array_values(self::columns());
        $example = [
            'Rural Primary School', (string)date('n'), (string)date('Y'),
            'Student Full Name', "Father Full Name", "Mother Full Name", 'Class 5',
            'Dhaka', 'Dhaka', 'Savar', '01712345678',
            'student@example.com', 'Male',
        ];

        $rows = [$headers, $example];
        $xlsx = self::build_xlsx($rows);

        $filename = 'clc_import_template_' . date('Ymd') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($xlsx));
        header('Cache-Control: max-age=0');
        echo $xlsx;
    }

    // ------------------------------------------------------------------
    // Preview / validation.
    // ------------------------------------------------------------------

    /**
     * Parse an uploaded spreadsheet and split rows into valid / invalid.
     *
     * @param string $tmpfile  Uploaded temp file path.
     * @param string $original Original filename (used to detect extension).
     * @return array{valid: array, invalid: array, total: int}
     */
    public static function preview($tmpfile, $original) {
        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));

        if ($ext === 'csv' || $ext === 'txt') {
            $rows = self::read_csv($tmpfile);
        } else {
            $rows = self::read_xlsx($tmpfile);
        }

        $valid = [];
        $invalid = [];

        if (empty($rows)) {
            return ['valid' => [], 'invalid' => [], 'total' => 0];
        }

        // First non-empty row is treated as the header row and skipped.
        $keys = array_keys(self::columns());
        $started = false;
        $rownum = 0;

        foreach ($rows as $raw) {
            $rownum++;
            // Skip the header row (row 1).
            if (!$started) {
                $started = true;
                continue;
            }

            // Skip completely empty rows.
            $joined = trim(implode('', array_map('strval', $raw)));
            if ($joined === '') {
                continue;
            }

            $record = [];
            foreach ($keys as $i => $key) {
                $record[$key] = isset($raw[$i]) ? trim((string)$raw[$i]) : '';
            }
            $record['row'] = $rownum;

            $errors = self::validate_row($record);
            if (empty($errors)) {
                $valid[] = $record;
            } else {
                $record['errors'] = $errors;
                $invalid[] = $record;
            }
        }

        return [
            'valid' => $valid,
            'invalid' => $invalid,
            'total' => count($valid) + count($invalid),
        ];
    }

    /**
     * Validate a single mapped row. Mirrors SkillConnect rules:
     * name + school required, valid month/year, email + mobile format.
     *
     * @param array $r
     * @return array List of error strings (empty = valid).
     */
    public static function validate_row(array $r) {
        $errors = [];

        if (($r['name'] ?? '') === '') {
            $errors[] = 'Student name is required.';
        }
        if (($r['school'] ?? '') === '') {
            $errors[] = 'School name is required.';
        }

        $month = self::normalize_month($r['month'] ?? '');
        if ($month < 1 || $month > 12) {
            $errors[] = 'Invalid month.';
        }

        $year = (int)($r['year'] ?? 0);
        if ($year < 2010 || $year > (int)date('Y') + 1) {
            $errors[] = 'Invalid year.';
        }

        if (!empty($r['email']) && !filter_var($r['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email.';
        }

        if (!empty($r['mobile'])) {
            $mobile = preg_replace('/[\s\-\(\)]/', '', $r['mobile']);
            if (!preg_match('/^\+?[0-9]{10,15}$/', $mobile)) {
                $errors[] = 'Invalid mobile.';
            }
        }

        if (!empty($r['gender']) && !in_array(ucfirst(strtolower($r['gender'])), ['Male', 'Female', 'Other'], true)) {
            $errors[] = 'Invalid gender.';
        }

        return $errors;
    }

    // ------------------------------------------------------------------
    // Import.
    // ------------------------------------------------------------------

    /**
     * Insert valid records into the CLC table, skipping duplicates.
     *
     * A duplicate = same name + school + mobile already present for the CLC
     * program (matches the intent of the SkillConnect importer's skip count).
     *
     * @param array $records Valid records from preview().
     * @return array{inserted:int, failed:int, skipped:int}
     */
    public static function import(array $records) {
        $inserted = 0;
        $failed = 0;
        $skipped = 0;

        if (empty($records)) {
            return ['inserted' => 0, 'failed' => 0, 'skipped' => 0];
        }

        $db = clp_db_connect();
        $program = 'clc';

        $dupStmt = $db->prepare(
            "SELECT COUNT(*) AS c FROM " . self::TABLE . "
             WHERE program = 'clc' AND name = ? AND school = ? AND mobile = ?"
        );

        $insStmt = $db->prepare(
            "INSERT INTO " . self::TABLE . "
             (program, name, father_name, mother_name, district, division, upazila, mobile, email, gender, school, month, timecreated)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        foreach ($records as $r) {
            $name   = $r['name'] ?? '';
            $school = $r['school'] ?? '';
            $mobile = $r['mobile'] ?? '';

            // Duplicate check. Buffer + free the result so the following
            // INSERT on the same connection does not hit "commands out of sync".
            $dupStmt->bind_param('sss', $name, $school, $mobile);
            $dupStmt->execute();
            $dupCount = 0;
            $dupStmt->bind_result($dupCount);
            $dupStmt->store_result();
            $dupStmt->fetch();
            $dupStmt->free_result();
            $isdup = (int)$dupCount > 0;
            if ($isdup) {
                $skipped++;
                continue;
            }

            $father   = $r['father_name'] ?? '';
            $mother   = $r['mother_name'] ?? '';
            $district = $r['district'] ?? '';
            $division = $r['division'] ?? '';
            $upazila  = $r['upazila'] ?? '';
            $email    = $r['email'] ?? '';
            $gender   = $r['gender'] !== '' ? ucfirst(strtolower($r['gender'])) : '';
            $month    = self::normalize_month($r['month'] ?? '');
            $year     = (int)($r['year'] ?? date('Y'));
            $timecreated = mktime(0, 0, 0, 1, 1, $year);

            $insStmt->bind_param(
                'sssssssssssii',
                $program, $name, $father, $mother, $district, $division,
                $upazila, $mobile, $email, $gender, $school, $month, $timecreated
            );

            if ($insStmt->execute()) {
                $inserted++;
            } else {
                $failed++;
            }
        }

        $dupStmt->close();
        $insStmt->close();
        $db->close();

        return ['inserted' => $inserted, 'failed' => $failed, 'skipped' => $skipped];
    }

    // ------------------------------------------------------------------
    // Helpers.
    // ------------------------------------------------------------------

    /**
     * Convert a month value (number or name) into 1-12, or 0 if invalid.
     */
    public static function normalize_month($value) {
        $value = trim((string)$value);
        if ($value === '') {
            return 0;
        }
        if (ctype_digit($value)) {
            $m = (int)$value;
            return ($m >= 1 && $m <= 12) ? $m : 0;
        }
        $ts = strtotime('1 ' . $value . ' 2000');
        if ($ts !== false) {
            return (int)date('n', $ts);
        }
        return 0;
    }

    // ------------------------------------------------------------------
    // Native CSV reader.
    // ------------------------------------------------------------------

    private static function read_csv($file) {
        $rows = [];
        if (($h = fopen($file, 'r')) !== false) {
            while (($data = fgetcsv($h, 0, ',')) !== false) {
                $rows[] = $data;
            }
            fclose($h);
        }
        return $rows;
    }

    // ------------------------------------------------------------------
    // Native XLSX reader (ZIP of XML parts).
    // ------------------------------------------------------------------

    /**
     * Read the first worksheet of an .xlsx file into a 2D array of strings.
     *
     * @param string $file
     * @return array
     */
    private static function read_xlsx($file) {
        if (!class_exists('ZipArchive')) {
            return [];
        }

        $zip = new ZipArchive();
        if ($zip->open($file) !== true) {
            return [];
        }

        // Shared strings table.
        $shared = [];
        $ssXml = $zip->getFromName('xl/sharedStrings.xml');
        if ($ssXml !== false) {
            $sx = @simplexml_load_string($ssXml);
            if ($sx !== false) {
                foreach ($sx->si as $si) {
                    $shared[] = self::extract_si_text($si);
                }
            }
        }

        // Locate the first worksheet target from the workbook relationships.
        $sheetPath = self::first_sheet_path($zip);
        $sheetXml = $zip->getFromName($sheetPath);
        $zip->close();

        if ($sheetXml === false) {
            return [];
        }

        $sx = @simplexml_load_string($sheetXml);
        if ($sx === false || !isset($sx->sheetData)) {
            return [];
        }

        $rows = [];
        foreach ($sx->sheetData->row as $row) {
            $cells = [];
            $maxcol = 0;
            $tmp = [];
            foreach ($row->c as $c) {
                $ref = (string)$c['r'];
                $col = self::col_index($ref);
                $type = (string)$c['t'];
                $val = '';

                if ($type === 's') {
                    // Shared string index.
                    $idx = (int)$c->v;
                    $val = $shared[$idx] ?? '';
                } else if ($type === 'inlineStr') {
                    $val = self::extract_si_text($c->is);
                } else {
                    $val = isset($c->v) ? (string)$c->v : '';
                }

                $tmp[$col] = $val;
                if ($col > $maxcol) {
                    $maxcol = $col;
                }
            }
            for ($i = 0; $i <= $maxcol; $i++) {
                $cells[$i] = $tmp[$i] ?? '';
            }
            $rows[] = $cells;
        }

        return $rows;
    }

    /** Extract text from a shared-string / inline-string node (handles rich text). */
    private static function extract_si_text($si) {
        if ($si === null) {
            return '';
        }
        if (isset($si->t)) {
            return (string)$si->t;
        }
        $text = '';
        if (isset($si->r)) {
            foreach ($si->r as $r) {
                $text .= (string)$r->t;
            }
        }
        return $text;
    }

    /** Resolve the first worksheet XML path inside the archive. */
    private static function first_sheet_path(ZipArchive $zip) {
        // Default (what we and most writers produce).
        $default = 'xl/worksheets/sheet1.xml';

        $wbXml = $zip->getFromName('xl/workbook.xml');
        $relXml = $zip->getFromName('xl/_rels/workbook.xml.rels');
        if ($wbXml === false || $relXml === false) {
            return $default;
        }

        $wb = @simplexml_load_string($wbXml);
        if ($wb === false || !isset($wb->sheets->sheet)) {
            return $default;
        }
        $firstSheet = $wb->sheets->sheet[0];
        $rid = '';
        foreach ($firstSheet->attributes('http://schemas.openxmlformats.org/officeDocument/2006/relationships') as $k => $v) {
            if ($k === 'id') {
                $rid = (string)$v;
            }
        }
        if ($rid === '') {
            return $default;
        }

        $rels = @simplexml_load_string($relXml);
        if ($rels === false) {
            return $default;
        }
        foreach ($rels->Relationship as $rel) {
            if ((string)$rel['Id'] === $rid) {
                $target = (string)$rel['Target'];
                $target = ltrim($target, '/');
                if (strpos($target, 'xl/') !== 0) {
                    $target = 'xl/' . $target;
                }
                return $target;
            }
        }
        return $default;
    }

    /** Convert a cell reference (e.g. "C7") to a 0-based column index. */
    private static function col_index($ref) {
        if (!preg_match('/^([A-Z]+)/', $ref, $m)) {
            return 0;
        }
        $letters = $m[1];
        $num = 0;
        $len = strlen($letters);
        for ($i = 0; $i < $len; $i++) {
            $num = $num * 26 + (ord($letters[$i]) - 64);
        }
        return $num - 1;
    }

    // ------------------------------------------------------------------
    // Native XLSX writer (minimal valid workbook).
    // ------------------------------------------------------------------

    /**
     * Build a minimal, valid .xlsx binary from a 2D array of rows.
     *
     * @param array $rows Array of rows; each row an array of scalar values.
     * @return string Raw .xlsx bytes.
     */
    private static function build_xlsx(array $rows) {
        // Build shared strings + sheet.
        $strings = [];
        $stringIndex = [];

        $sheetRows = '';
        $r = 0;
        foreach ($rows as $row) {
            $r++;
            $c = 0;
            $cells = '';
            foreach ($row as $value) {
                $c++;
                $ref = self::col_letter($c) . $r;
                $value = (string)$value;
                if ($value === '') {
                    continue;
                }
                if (!isset($stringIndex[$value])) {
                    $stringIndex[$value] = count($strings);
                    $strings[] = $value;
                }
                $idx = $stringIndex[$value];
                $cells .= '<c r="' . $ref . '" t="s"><v>' . $idx . '</v></c>';
            }
            $sheetRows .= '<row r="' . $r . '">' . $cells . '</row>';
        }

        $sharedItems = '';
        foreach ($strings as $s) {
            $sharedItems .= '<si><t xml:space="preserve">' . self::xml_escape($s) . '</t></si>';
        }

        $contentTypes = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
            . '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
            . '<Default Extension="xml" ContentType="application/xml"/>'
            . '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
            . '<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'
            . '<Override PartName="/xl/sharedStrings.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sharedStrings+xml"/>'
            . '</Types>';

        $rootRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
            . '</Relationships>';

        $workbook = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
            . '<sheets><sheet name="CLC Import" sheetId="1" r:id="rId1"/></sheets>'
            . '</workbook>';

        $workbookRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
            . '<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/sharedStrings" Target="sharedStrings.xml"/>'
            . '</Relationships>';

        $sheet = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            . '<sheetData>' . $sheetRows . '</sheetData>'
            . '</worksheet>';

        $sharedStrings = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<sst xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" count="' . count($strings) . '" uniqueCount="' . count($strings) . '">'
            . $sharedItems . '</sst>';

        // Package into a ZIP.
        $tmp = tempnam(sys_get_temp_dir(), 'clcxlsx');
        $zip = new ZipArchive();
        $zip->open($tmp, ZipArchive::OVERWRITE);
        $zip->addFromString('[Content_Types].xml', $contentTypes);
        $zip->addFromString('_rels/.rels', $rootRels);
        $zip->addFromString('xl/workbook.xml', $workbook);
        $zip->addFromString('xl/_rels/workbook.xml.rels', $workbookRels);
        $zip->addFromString('xl/worksheets/sheet1.xml', $sheet);
        $zip->addFromString('xl/sharedStrings.xml', $sharedStrings);
        $zip->close();

        $data = file_get_contents($tmp);
        @unlink($tmp);
        return $data;
    }

    /** Convert a 1-based column number to a spreadsheet letter (A, B, …, AA). */
    private static function col_letter($num) {
        $letter = '';
        while ($num > 0) {
            $mod = ($num - 1) % 26;
            $letter = chr(65 + $mod) . $letter;
            $num = (int)(($num - $mod) / 26);
        }
        return $letter;
    }

    private static function xml_escape($s) {
        return htmlspecialchars($s, ENT_QUOTES | ENT_XML1, 'UTF-8');
    }
}
