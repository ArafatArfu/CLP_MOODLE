<?php
namespace local_centermanagement\local;

use local_centermanagement\local\centermanagement_exception;

defined('MOODLE_INTERNAL') || die();

class center_manager {

    public static function create_center(\stdClass $formdata, $filearea = null) {
        global $USER;

        $data = new \stdClass();
        $data->center_code = trim($formdata->center_code);
        $data->center_name = trim($formdata->center_name);
        $data->school_name = trim($formdata->school_name ?? '');
        $data->center_type = $formdata->center_type ?? 'clc';
        $data->division = trim($formdata->division ?? '');
        $data->district = trim($formdata->district ?? '');
        $data->upazila = trim($formdata->upazila ?? '');
        $data->address = trim($formdata->address ?? '');
        $data->contact_person = trim($formdata->contact_person ?? '');
        $data->contact_number = trim($formdata->contact_number ?? '');
        $data->email = trim($formdata->email ?? '');
        $data->establishment_date = $formdata->establishment_date ?? null;
        $data->start_date = $formdata->start_date ?? null;
        $data->support = trim($formdata->support ?? '');
        $data->sponsor_name = trim($formdata->sponsor_name ?? '');
        $data->devices_count = (int)($formdata->devices_count ?? 0);
        $data->students_count = (int)($formdata->students_count ?? 0);
        $data->status = (int)($formdata->status ?? 1);
        $data->description = $formdata->description ?? '';
        $data->image = '';

        $id = center_repository::create_center((array)$data);

        if ($filearea && isset($formdata->image)) {
            $fs = get_file_storage();
            $context = \context_system::instance();
            $file = $formdata->image;
            if ($file && $file->get_filesize() > 0) {
                $filerecord = array(
                    'contextid' => $context->id,
                    'component' => 'local_centermanagement',
                    'filearea' => $filearea,
                    'itemid' => $id,
                    'filepath' => '/',
                    'filename' => $file->get_filename(),
                    'timecreated' => time(),
                    'timemodified' => time(),
                );
                $fs->create_file_from_storedfile($filerecord, $file);
                $data->image = $file->get_filename();
                center_repository::update_center($id, array('image' => $data->image));
            }
        }

        return $id;
    }

    public static function update_center($id, \stdClass $formdata, $filearea = null) {
        $center = center_repository::get_center_by_id($id);

        $data = array();
        if (isset($formdata->center_code)) {
            $data['center_code'] = trim($formdata->center_code);
        }
        if (isset($formdata->center_name)) {
            $data['center_name'] = trim($formdata->center_name);
        }
        if (property_exists($formdata, 'school_name')) {
            $data['school_name'] = trim($formdata->school_name);
        }
        if (property_exists($formdata, 'center_type')) {
            $data['center_type'] = $formdata->center_type;
        }
        if (property_exists($formdata, 'division')) {
            $data['division'] = trim($formdata->division);
        }
        if (property_exists($formdata, 'district')) {
            $data['district'] = trim($formdata->district);
        }
        if (property_exists($formdata, 'upazila')) {
            $data['upazila'] = trim($formdata->upazila);
        }
        if (property_exists($formdata, 'address')) {
            $data['address'] = trim($formdata->address);
        }
        if (property_exists($formdata, 'contact_person')) {
            $data['contact_person'] = trim($formdata->contact_person);
        }
        if (property_exists($formdata, 'contact_number')) {
            $data['contact_number'] = trim($formdata->contact_number);
        }
        if (property_exists($formdata, 'email')) {
            $data['email'] = trim($formdata->email);
        }
        if (property_exists($formdata, 'establishment_date')) {
            $data['establishment_date'] = $formdata->establishment_date;
        }
        if (property_exists($formdata, 'start_date')) {
            $data['start_date'] = $formdata->start_date;
        }
        if (property_exists($formdata, 'support')) {
            $data['support'] = trim($formdata->support);
        }
        if (property_exists($formdata, 'sponsor_name')) {
            $data['sponsor_name'] = trim($formdata->sponsor_name);
        }
        if (property_exists($formdata, 'devices_count')) {
            $data['devices_count'] = (int)$formdata->devices_count;
        }
        if (property_exists($formdata, 'students_count')) {
            $data['students_count'] = (int)$formdata->students_count;
        }
        if (property_exists($formdata, 'status')) {
            $data['status'] = (int)$formdata->status;
        }
        if (property_exists($formdata, 'description')) {
            $data['description'] = $formdata->description;
        }

        if ($filearea && isset($formdata->image)) {
            $fs = get_file_storage();
            $context = \context_system::instance();
            $file = $formdata->image;
            if ($file && $file->get_filesize() > 0) {
                $filerecord = array(
                    'contextid' => $context->id,
                    'component' => 'local_centermanagement',
                    'filearea' => $filearea,
                    'itemid' => $id,
                    'filepath' => '/',
                    'filename' => $file->get_filename(),
                    'timecreated' => time(),
                    'timemodified' => time(),
                );
                $fs->create_file_from_storedfile($filerecord, $file);
                $data['image'] = $file->get_filename();
            }
        }

        return center_repository::update_center($id, $data);
    }

    public static function delete_center($id) {
        return center_repository::delete_center($id);
    }

    public static function can_manage_centers() {
        return has_capability('local/centermanagement:manage', \context_system::instance());
    }

    public static function can_view_centers() {
        return has_capability('local/centermanagement:viewall', \context_system::instance());
    }

    public static function can_add_center() {
        return has_capability('local/centermanagement:add', \context_system::instance());
    }

    public static function can_edit_center($centerid = null) {
        return has_capability('local/centermanagement:edit', \context_system::instance());
    }

    public static function can_delete_center($centerid = null) {
        return has_capability('local/centermanagement:delete', \context_system::instance());
    }
}
