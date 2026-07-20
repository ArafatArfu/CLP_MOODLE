<?php
namespace local_centermanagement\local;

use local_centermanagement\local\centermanagement_exception;

defined('MOODLE_INTERNAL') || die();

class center_repository {

    public static function get_center_by_id($id) {
        global $DB;
        return $DB->get_record('local_centermanagement_centers', ['id' => $id], '*', MUST_EXIST);
    }

    public static function get_centers(array $filters = [], int $limit = 20, int $offset = 0, string $sort = 'timecreated DESC') {
        global $DB;

        $sql = "SELECT * FROM {local_centermanagement_centers} WHERE 1=1";
        $countsql = "SELECT COUNT(*) FROM {local_centermanagement_centers} WHERE 1=1";
        $params = [];

        if (isset($filters['search'])) {
            $search = '%' . $DB->sql_like_escape($filters['search']) . '%';
            $sql .= " AND (" . $DB->sql_like('center_name', '?', false) .
                    " OR " . $DB->sql_like('school_name', '?', false) .
                    " OR " . $DB->sql_like('center_code', '?', false) . ")";
            $countsql .= " AND (" . $DB->sql_like('center_name', '?', false) .
                         " OR " . $DB->sql_like('school_name', '?', false) .
                         " OR " . $DB->sql_like('center_code', '?', false) . ")";
            $params[] = $search;
            $params[] = $search;
            $params[] = $search;
        }

        if (isset($filters['center_type'])) {
            $sql .= " AND center_type = ?";
            $countsql .= " AND center_type = ?";
            $params[] = $filters['center_type'];
        }

        if (isset($filters['status'])) {
            $sql .= " AND status = ?";
            $countsql .= " AND status = ?";
            $params[] = (int)$filters['status'];
        }

        if (isset($filters['division_id'])) {
            $sql .= " AND division = ?";
            $countsql .= " AND division = ?";
            $params[] = $filters['division_id'];
        }

        if (isset($filters['district_id'])) {
            $sql .= " AND district = ?";
            $countsql .= " AND district = ?";
            $params[] = $filters['district_id'];
        }

        if (isset($filters['upazila_id'])) {
            $sql .= " AND upazila = ?";
            $countsql .= " AND upazila = ?";
            $params[] = $filters['upazila_id'];
        }

        $allowed_sort_fields = [
            'name ASC' => 'center_name ASC',
            'name DESC' => 'center_name DESC',
            'start_date ASC' => 'start_date ASC',
            'start_date DESC' => 'start_date DESC',
            'timecreated ASC' => 'timecreated ASC',
            'timecreated DESC' => 'timecreated DESC',
        ];

        if (isset($allowed_sort_fields[$sort])) {
            $sql .= " ORDER BY " . $allowed_sort_fields[$sort];
        } else {
            $sql .= " ORDER BY timecreated DESC";
        }

        $total = $DB->count_records_sql($countsql, $params);
        $centers = $DB->get_records_sql($sql, $params, $limit, $offset);

        return ['centers' => $centers, 'total' => $total];
    }

    public static function get_active_centers() {
        global $DB;
        return $DB->get_records('local_centermanagement_centers', ['status' => 1], 'district ASC, start_date ASC');
    }

    public static function create_center(array $data) {
        global $DB, $USER;
        $data['timecreated'] = time();
        $data['timemodified'] = time();
        $data['usermodified'] = $USER->id;
        return $DB->insert_record('local_centermanagement_centers', (object)$data);
    }

    public static function update_center($id, array $data) {
        global $DB, $USER;
        $data['timemodified'] = time();
        $data['usermodified'] = $USER->id;
        return $DB->update_record('local_centermanagement_centers', (object)$data);
    }

    public static function delete_center($id) {
        global $DB;
        return $DB->delete_records('local_centermanagement_centers', ['id' => $id]);
    }

    public static function is_center_code_unique($code, $excludeid = 0) {
        global $DB;
        if ($excludeid) {
            return $DB->record_exists_select('local_centermanagement_centers',
                "center_code = :center_code AND id != :id",
                ['center_code' => $code, 'id' => $excludeid]);
        }
        return $DB->record_exists('local_centermanagement_centers', ['center_code' => $code]);
    }

    public static function get_centers_grouped_by_district() {
        global $DB;
        $centers = self::get_active_centers();
        $groups = [];
        foreach ($centers as $center) {
            $districtname = $center->district ?? '';
            $groups[$districtname][] = $center;
        }
        uksort($groups, function ($a, $b) {
            $pa = $a === '' ? 1 : 0;
            $pb = $b === '' ? 1 : 0;
            if ($pa !== $pb) {
                return $pa <=> $pb;
            }
            return strcmp(ltrim((string)$a), ltrim((string)$b));
        });
        return $groups;
    }

    /**
     * Returns centres grouped by district for the public
     * "Your Sponsored Center(s)" page (school-info.php).
     *
     * This mirrors the Laravel WebsiteController::schoolInfo() data flow,
     * adapted to the denormalised local_centermanagement_centers table
     * (the Moodle port has no separate districts/schools/upazilas tables,
     * so the district name is stored directly on the centre row).
     *
     * Behaviour aligned with the Laravel source:
     *  - Only active (status = 1) centres are shown. The Laravel source
     *    omits an explicit status filter, but the public website is only
     *    meant to display sponsored/active centres, so the existing Moodle
     *    active-only behaviour is preserved.
     *  - Search matches centre name, school name or centre code (the
     *    Laravel source searches the related school name; the superset
     *    keeps the existing "Search by Center Name" behaviour).
     *  - Centres are grouped by district and ordered by district then
     *    start_date, with empty district names sorted last (mirrors the
     *    Laravel collection sortBy on the left-trimmed district name).
     *
     * @param string $search Optional free-text search term.
     * @return array[] Associative array of district => list of centre records.
     */
    public static function get_sponsored_centers(string $search = ''): array {
        global $DB;

        $sql = "SELECT * FROM {local_centermanagement_centers} WHERE status = 1";
        $params = [];

        if ($search !== '') {
            $like = '%' . $DB->sql_like_escape($search) . '%';
            $sql .= " AND (" . $DB->sql_like('center_name', '?', false) .
                    " OR " . $DB->sql_like('school_name', '?', false) .
                    " OR " . $DB->sql_like('center_code', '?', false) . ")";
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
        }

        $sql .= " ORDER BY district ASC, start_date ASC";

        $centers = $DB->get_records_sql($sql, $params);

        $groups = [];
        foreach ($centers as $center) {
            $district = $center->district ?? '';
            $groups[$district][] = $center;
        }

        uksort($groups, function ($a, $b) {
            $pa = $a === '' ? 1 : 0;
            $pb = $b === '' ? 1 : 0;
            if ($pa !== $pb) {
                return $pa <=> $pb;
            }
            return strcmp(ltrim((string)$a), ltrim((string)$b));
        });

        return $groups;
    }
}
