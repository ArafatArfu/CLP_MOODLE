<?php
namespace local_centermanagement\local;

use local_centermanagement\local\centermanagement_exception;

defined('MOODLE_INTERNAL') || die();

class center_repository {

    public static function get_center_by_id($id) {
        global $DB;
        return $DB->get_record('local_centermanagement_centers', ['id' => (int)$id], '*', MUST_EXIST);
    }

    public static function get_centers(array $filters = [], int $limit = 20, int $offset = 0, string $sort = 'timecreated DESC') {
        global $DB;

        $sql = "SELECT * FROM {local_centermanagement_centers} WHERE 1=1";
        $countsql = "SELECT COUNT(*) FROM {local_centermanagement_centers} WHERE 1=1";
        $params = [];

        if (!empty($filters['search'])) {
            $search = '%' . $DB->sql_like_escape($filters['search']) . '%';
            $sql .= " AND (" . $DB->sql_like('center_name', '?', false) .
                    " OR " . $DB->sql_like('school_name', '?', false) .
                    " OR " . $DB->sql_like('center_code', '?', false) .
                    " OR " . $DB->sql_like('sponsor_name', '?', false) .
                    " OR " . $DB->sql_like('district', '?', false) . ")";
            $countsql .= " AND (" . $DB->sql_like('center_name', '?', false) .
                         " OR " . $DB->sql_like('school_name', '?', false) .
                         " OR " . $DB->sql_like('center_code', '?', false) .
                         " OR " . $DB->sql_like('sponsor_name', '?', false) .
                         " OR " . $DB->sql_like('district', '?', false) . ")";
            $params[] = $search;
            $params[] = $search;
            $params[] = $search;
            $params[] = $search;
            $params[] = $search;
        }

        if (!empty($filters['center_type'])) {
            $sql .= " AND center_type = ?";
            $countsql .= " AND center_type = ?";
            $params[] = $filters['center_type'];
        }

        if (array_key_exists('status', $filters) && $filters['status'] !== '') {
            $sql .= " AND status = ?";
            $countsql .= " AND status = ?";
            $params[] = (int)$filters['status'];
        }

        if (!empty($filters['division'])) {
            $sql .= " AND division = ?";
            $countsql .= " AND division = ?";
            $params[] = $filters['division'];
        }

        if (!empty($filters['district'])) {
            $sql .= " AND district = ?";
            $countsql .= " AND district = ?";
            $params[] = $filters['district'];
        }

        if (!empty($filters['upazila'])) {
            $sql .= " AND upazila = ?";
            $countsql .= " AND upazila = ?";
            $params[] = $filters['upazila'];
        }

        if (!empty($filters['sponsor'])) {
            $sql .= " AND " . $DB->sql_like('sponsor_name', '?', false);
            $countsql .= " AND " . $DB->sql_like('sponsor_name', '?', false);
            $params[] = '%' . $DB->sql_like_escape($filters['sponsor']) . '%';
        }

        $allowed_sort_fields = [
            'center_name ASC' => 'center_name ASC',
            'center_name DESC' => 'center_name DESC',
            'division ASC' => 'division ASC',
            'division DESC' => 'division DESC',
            'district ASC' => 'district ASC',
            'district DESC' => 'district DESC',
            'upazila ASC' => 'upazila ASC',
            'upazila DESC' => 'upazila DESC',
            'start_date ASC' => 'start_date ASC',
            'start_date DESC' => 'start_date DESC',
            'center_type ASC' => 'center_type ASC',
            'center_type DESC' => 'center_type DESC',
            'sponsor_name ASC' => 'sponsor_name ASC',
            'sponsor_name DESC' => 'sponsor_name DESC',
            'status ASC' => 'status ASC',
            'status DESC' => 'status DESC',
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
        $DB->delete_records('local_centermanagement_centers', ['id' => (int)$id]);
        $DB->delete_records('local_centermanagement_sponsors', ['center_id' => (int)$id]);
        $DB->delete_records('local_centermanagement_banner_images', ['center_id' => (int)$id]);
        $DB->delete_records('local_centermanagement_plaque_gallery', ['center_id' => (int)$id]);
        $DB->delete_records('local_centermanagement_school_photo_gallery', ['center_id' => (int)$id]);
        return true;
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

    public static function get_distinct_field(string $field): array {
        global $DB;

        $allowed = ['division', 'district', 'upazila', 'support', 'center_type'];
        if (!in_array($field, $allowed, true)) {
            return [];
        }

        $sql = "SELECT DISTINCT $field
                  FROM {local_centermanagement_centers}
                 WHERE $field IS NOT NULL AND $field <> ''
                 ORDER BY $field ASC";
        $values = $DB->get_fieldset_sql($sql);
        return array_values(array_filter($values, function ($v) {
            return $v !== '' && $v !== null;
        }));
    }

    public static function get_sponsors(int $centerid): array {
        global $DB;
        return $DB->get_records('local_centermanagement_sponsors', ['center_id' => $centerid], 'sortorder ASC, id ASC');
    }

    public static function create_sponsor(array $data): int {
        global $DB;
        $data['timecreated'] = time();
        $data['timemodified'] = time();
        return $DB->insert_record('local_centermanagement_sponsors', (object)$data);
    }

    public static function update_sponsor($id, array $data): bool {
        global $DB;
        $data['id'] = $id;
        $data['timemodified'] = time();
        return $DB->update_record('local_centermanagement_sponsors', (object)$data);
    }

    public static function delete_sponsor($id, $centerid): bool {
        global $DB;
        return $DB->delete_records_select('local_centermanagement_sponsors', 'id = ? AND center_id = ?', [(int)$id, (int)$centerid]);
    }

    public static function get_banner_images(int $centerid): array {
        global $DB;
        return $DB->get_records('local_centermanagement_banner_images', ['center_id' => $centerid], 'sortorder ASC, id ASC');
    }

    public static function set_banner_images(int $centerid, array $filenames): void {
        global $DB;
        $DB->delete_records('local_centermanagement_banner_images', ['center_id' => $centerid]);
        $time = time();
        foreach ($filenames as $sort => $filename) {
            $record = (object)[
                'center_id' => $centerid,
                'filename' => $filename,
                'sortorder' => (int)$sort,
                'timecreated' => $time,
                'timemodified' => $time,
            ];
            $DB->insert_record('local_centermanagement_banner_images', $record);
        }
    }

    public static function get_plaque_images(int $centerid): array {
        global $DB;
        return $DB->get_records('local_centermanagement_plaque_gallery', ['center_id' => $centerid], 'sortorder ASC, id ASC');
    }

    public static function set_plaque_images(int $centerid, array $filenames): void {
        global $DB;
        $DB->delete_records('local_centermanagement_plaque_gallery', ['center_id' => $centerid]);
        $time = time();
        foreach ($filenames as $sort => $filename) {
            $record = (object)[
                'center_id' => $centerid,
                'filename' => $filename,
                'sortorder' => (int)$sort,
                'timecreated' => $time,
                'timemodified' => $time,
            ];
            $DB->insert_record('local_centermanagement_plaque_gallery', $record);
        }
    }

    public static function get_school_photos(int $centerid): array {
        global $DB;
        return $DB->get_records('local_centermanagement_school_photo_gallery', ['center_id' => $centerid], 'sortorder ASC, id ASC');
    }

    public static function set_school_photos(int $centerid, array $filenames): void {
        global $DB;
        $DB->delete_records('local_centermanagement_school_photo_gallery', ['center_id' => $centerid]);
        $time = time();
        foreach ($filenames as $sort => $filename) {
            $record = (object)[
                'center_id' => $centerid,
                'filename' => $filename,
                'sortorder' => (int)$sort,
                'timecreated' => $time,
                'timemodified' => $time,
            ];
            $DB->insert_record('local_centermanagement_school_photo_gallery', $record);
        }
    }

    public static function search_sponsored_centers(array $f, int $page = 1, int $perpage = 20): array {
        global $DB;

        $where = ['status = 1'];
        $params = [];

        if (!empty($f['q'])) {
            $like = '%' . $DB->sql_like_escape($f['q']) . '%';
            $where[] = '(' . $DB->sql_like('center_name', '?', false) .
                ' OR ' . $DB->sql_like('school_name', '?', false) .
                ' OR ' . $DB->sql_like('center_code', '?', false) .
                ' OR ' . $DB->sql_like('sponsor_name', '?', false) .
                ' OR ' . $DB->sql_like('district', '?', false) . ')';
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
        }

        foreach (['district', 'division', 'upazila', 'center_type', 'support'] as $col) {
            if (!empty($f[$col])) {
                $where[] = "$col = ?";
                $params[] = $f[$col];
            }
        }

        if (!empty($f['sponsor'])) {
            $where[] = "sponsor_name = ?";
            $params[] = $f['sponsor'];
        }

        if (isset($f['status']) && $f['status'] !== '') {
            $where[] = "status = ?";
            $params[] = (int)$f['status'];
        }

        $allowedSort = [
            'center_name' => 'center_name',
            'district'     => 'district',
            'division'     => 'division',
            'upazila'     => 'upazila',
            'start_date'   => 'start_date',
            'sponsor_name' => 'sponsor_name',
            'support'      => 'support',
            'center_type'  => 'center_type',
            'status'       => 'status',
        ];
        $sortfield = $allowedSort[$f['sort'] ?? ''] ?? 'center_name';
        $dir = strtoupper($f['dir'] ?? 'ASC') === 'DESC' ? 'DESC' : 'ASC';

        $whereSql = implode(' AND ', $where);
        $total = $DB->count_records_sql(
            "SELECT COUNT(*) FROM {local_centermanagement_centers} WHERE $whereSql",
            $params
        );

        $totalpages = max(1, (int)ceil($total / $perpage));
        $page = max(1, min($page, $totalpages));
        $limitfrom = ($page - 1) * $perpage;

        $sql = "SELECT * FROM {local_centermanagement_centers} WHERE $whereSql ORDER BY $sortfield $dir, id DESC";
        $rows = $DB->get_records_sql($sql, $params, $limitfrom, $perpage);

        return [
            'rows'       => $rows,
            'total'      => $total,
            'page'       => $page,
            'totalpages' => $totalpages,
        ];
    }

    public static function get_distinct_sponsors(): array {
        global $DB;
        $sql = "SELECT DISTINCT sponsor_name
                  FROM {local_centermanagement_centers}
                 WHERE sponsor_name IS NOT NULL AND sponsor_name <> '' AND status = 1
                 ORDER BY sponsor_name ASC";
        $names = $DB->get_fieldset_sql($sql);
        return array_values(array_filter($names, function ($v) {
            return $v !== '' && $v !== null;
        }));
    }
}
