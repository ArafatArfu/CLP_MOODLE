<?php
namespace local_centermanagement\local;

use local_centermanagement\local\centermanagement_exception;

defined('MOODLE_INTERNAL') || die();

class center_manager {

    public static function create_center(\stdClass $formdata, $fileareas = null) {
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
        $data->mailing_address = $formdata->mailing_address ?? '';
        $data->history_of_center = $formdata->history_of_center ?? '';
        $data->description_of_center = $formdata->description_of_center ?? '';
        $data->contact_person_details = $formdata->contact_person_details ?? '';
        $data->accomplishment = $formdata->accomplishment ?? '';
        $data->current_status = $formdata->current_status ?? 'supported';
        $data->hm_teacher_name = trim($formdata->hm_teacher_name ?? '');
        $data->hm_phone_number = trim($formdata->hm_phone_number ?? '');
        $data->hm_email = trim($formdata->hm_email ?? '');
        $data->clc_teacher_name = trim($formdata->clc_teacher_name ?? '');
        $data->clc_teacher_email = trim($formdata->clc_teacher_email ?? '');
        $data->clc_teacher_phone = trim($formdata->clc_teacher_phone ?? '');
        $data->scr_teacher_name = trim($formdata->scr_teacher_name ?? '');
        $data->scr_teacher_email = trim($formdata->scr_teacher_email ?? '');
        $data->scr_teacher_phone = trim($formdata->scr_teacher_phone ?? '');
        $data->global_classroom = $formdata->global_classroom ?? 'no';
        $data->program_clp_pi_english_club = $formdata->program_clp_pi_english_club ?? 'no';
        $data->program_egl_english = $formdata->program_egl_english ?? 'no';
        $data->program_egl_math = $formdata->program_egl_math ?? 'no';
        $data->program_csaw = $formdata->program_csaw ?? 'no';
        $data->school_grading = $formdata->school_grading ?? '';
        $data->clc_graduate_students = $formdata->clc_graduate_students ?? '';
        $data->scr_benefited_students = $formdata->scr_benefited_students ?? '';
        $data->hardware_status = $formdata->hardware_status ?? '';
        $data->last_visit_date = $formdata->last_visit_date ?? null;
        $data->image = '';

        $id = center_repository::create_center((array)$data);

        $fileareas = $fileareas ?: [];
        if (!is_array($fileareas)) {
            $fileareas = [$fileareas];
        }

        $fs = get_file_storage();
        $context = \context_system::instance();

        $bannerfilenames = [];
        $plaquefilenames = [];
        $schoolphotofilenames = [];

        foreach ($fileareas as $filearea) {
            if (empty($filearea) || !isset($formdata->$filearea)) {
                continue;
            }
            $files = $formdata->$filearea;
            $filenames = [];

            if (is_array($files)) {
                foreach ($files as $file) {
                    if ($file instanceof \stored_file && $file->get_filesize() > 0) {
                        $filenames[] = $file->get_filename();
                        $filerecord = [
                            'contextid' => $context->id,
                            'component' => 'local_centermanagement',
                            'filearea' => $filearea,
                            'itemid' => $id,
                            'filepath' => '/',
                            'filename' => $file->get_filename(),
                            'timecreated' => time(),
                            'timemodified' => time(),
                        ];
                        $fs->create_file_from_storedfile($filerecord, $file);
                    } elseif (is_string($file) && $file !== '') {
                        $filenames[] = $file;
                    }
                }
            } elseif ($files instanceof \stored_file && $files->get_filesize() > 0) {
                $filenames[] = $files->get_filename();
                $filerecord = [
                    'contextid' => $context->id,
                    'component' => 'local_centermanagement',
                    'filearea' => $filearea,
                    'itemid' => $id,
                    'filepath' => '/',
                    'filename' => $files->get_filename(),
                    'timecreated' => time(),
                    'timemodified' => time(),
                ];
                $fs->create_file_from_storedfile($filerecord, $files);
            } elseif (is_string($files) && $files !== '') {
                $filenames[] = $files;
            }

            if ($filearea === 'banner_images') {
                $bannerfilenames = $filenames;
                if (!empty($filenames)) {
                    center_repository::update_center($id, ['image' => $filenames[0]]);
                }
            } elseif ($filearea === 'plaque_images') {
                $plaquefilenames = $filenames;
            } elseif ($filearea === 'school_photos') {
                $schoolphotofilenames = $filenames;
            }
        }

        if (!empty($bannerfilenames)) {
            center_repository::set_banner_images($id, $bannerfilenames);
        }
        if (!empty($plaquefilenames)) {
            center_repository::set_plaque_images($id, $plaquefilenames);
        }
        if (!empty($schoolphotofilenames)) {
            center_repository::set_school_photos($id, $schoolphotofilenames);
        }

        return $id;
    }

    public static function update_center($id, \stdClass $formdata, $fileareas = null) {
        $center = center_repository::get_center_by_id($id);

        $data = [];
        $fields = [
            'center_code', 'school_name', 'center_type', 'division', 'district', 'upazila',
            'address', 'contact_person', 'contact_number', 'email',
            'support', 'sponsor_name', 'devices_count', 'students_count', 'status', 'description',
            'mailing_address', 'history_of_center', 'description_of_center', 'contact_person_details',
            'accomplishment', 'current_status',
            'hm_teacher_name', 'hm_phone_number', 'hm_email',
            'clc_teacher_name', 'clc_teacher_email', 'clc_teacher_phone',
            'scr_teacher_name', 'scr_teacher_email', 'scr_teacher_phone',
            'global_classroom', 'program_clp_pi_english_club', 'program_egl_english',
            'program_egl_math', 'program_csaw', 'school_grading',
            'clc_graduate_students', 'scr_benefited_students', 'hardware_status'
        ];
        foreach ($fields as $field) {
            if (property_exists($formdata, $field)) {
                $value = $formdata->$field;
                if (in_array($field, ['center_code', 'school_name', 'division', 'district', 'upazila', 'address',
                    'contact_person', 'contact_number', 'email', 'support', 'sponsor_name',
                    'hm_teacher_name', 'hm_phone_number', 'hm_email',
                    'clc_teacher_name', 'clc_teacher_email', 'clc_teacher_phone',
                    'scr_teacher_name', 'scr_teacher_email', 'scr_teacher_phone',
                    'school_grading', 'clc_graduate_students', 'scr_benefited_students', 'hardware_status',
                    'description', 'mailing_address', 'history_of_center', 'description_of_center',
                    'contact_person_details', 'accomplishment'])) {
                    $data[$field] = trim((string)$value);
                } else {
                    $data[$field] = $value;
                }
            }
        }
        if (property_exists($formdata, 'establishment_date')) {
            $data['establishment_date'] = $formdata->establishment_date ?: null;
        }
        if (property_exists($formdata, 'start_date')) {
            $data['start_date'] = $formdata->start_date ?: null;
        }
        if (property_exists($formdata, 'last_visit_date')) {
            $data['last_visit_date'] = $formdata->last_visit_date ?: null;
        }

        center_repository::update_center($id, $data);

        $fileareas = $fileareas ?: [];
        if (!is_array($fileareas)) {
            $fileareas = [$fileareas];
        }

        $fs = get_file_storage();
        $context = \context_system::instance();

        $bannerfilenames = [];
        $plaquefilenames = [];
        $schoolphotofilenames = [];

        foreach ($fileareas as $filearea) {
            if (empty($filearea) || !isset($formdata->$filearea)) {
                continue;
            }
            $files = $formdata->$filearea;
            $filenames = [];

            if (is_array($files)) {
                foreach ($files as $file) {
                    if ($file instanceof \stored_file && $file->get_filesize() > 0) {
                        $filenames[] = $file->get_filename();
                        $filerecord = [
                            'contextid' => $context->id,
                            'component' => 'local_centermanagement',
                            'filearea' => $filearea,
                            'itemid' => $id,
                            'filepath' => '/',
                            'filename' => $file->get_filename(),
                            'timecreated' => time(),
                            'timemodified' => time(),
                        ];
                        $fs->create_file_from_storedfile($filerecord, $file);
                    } elseif (is_string($file) && $file !== '') {
                        $filenames[] = $file;
                    }
                }
            } elseif ($files instanceof \stored_file && $files->get_filesize() > 0) {
                $fs->delete_area_files($context->id, 'local_centermanagement', $filearea, $id);
                $filenames[] = $files->get_filename();
                $filerecord = [
                    'contextid' => $context->id,
                    'component' => 'local_centermanagement',
                    'filearea' => $filearea,
                    'itemid' => $id,
                    'filepath' => '/',
                    'filename' => $files->get_filename(),
                    'timecreated' => time(),
                    'timemodified' => time(),
                ];
                $fs->create_file_from_storedfile($filerecord, $files);
            } elseif (is_string($files) && $files !== '') {
                $filenames[] = $files;
            }

            if ($filearea === 'banner_images') {
                $bannerfilenames = $filenames;
                if (!empty($filenames)) {
                    $data['image'] = $filenames[0];
                }
            } elseif ($filearea === 'plaque_images') {
                $plaquefilenames = $filenames;
            } elseif ($filearea === 'school_photos') {
                $schoolphotofilenames = $filenames;
            }
        }

        center_repository::update_center($id, $data);

        if (!empty($bannerfilenames)) {
            center_repository::set_banner_images($id, $bannerfilenames);
        }
        if (!empty($plaquefilenames)) {
            center_repository::set_plaque_images($id, $plaquefilenames);
        }
        if (!empty($schoolphotofilenames)) {
            center_repository::set_school_photos($id, $schoolphotofilenames);
        }

        return true;
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

    public static function can_manage_sponsors() {
        return has_capability('local/centermanagement:managesponsors', \context_system::instance());
    }

    public static function can_manage_photos() {
        return has_capability('local/centermanagement:managephotos', \context_system::instance());
    }

    public static function publish_center($id) {
        global $DB;
        return $DB->set_field('local_centermanagement_centers', 'status', 1, ['id' => (int)$id]);
    }

    public static function unpublish_center($id) {
        global $DB;
        return $DB->set_field('local_centermanagement_centers', 'status', 0, ['id' => (int)$id]);
    }

    public static function duplicate_center($id) {
        global $DB, $USER;
        $center = $DB->get_record('local_centermanagement_centers', ['id' => (int)$id], '*', MUST_EXIST);
        if (!$center) {
            return false;
        }

        $duplicate = (array)$center;
        unset($duplicate['id']);
        $duplicate['center_name'] = $duplicate['center_name'] . ' (Copy)';
        $duplicate['center_code'] = $duplicate['center_code'] . '_copy';
        $duplicate['timecreated'] = time();
        $duplicate['timemodified'] = time();
        $duplicate['usermodified'] = $USER->id;

        $newid = $DB->insert_record('local_centermanagement_centers', (object)$duplicate);

        $sponsors = $DB->get_records('local_centermanagement_sponsors', ['center_id' => $id]);
        foreach ($sponsors as $sponsor) {
            $newsponsor = (array)$sponsor;
            unset($newsponsor['id']);
            $newsponsor['center_id'] = $newid;
            $newsponsor['timecreated'] = time();
            $newsponsor['timemodified'] = time();
            $DB->insert_record('local_centermanagement_sponsors', (object)$newsponsor);
        }

        return $newid;
    }
}
