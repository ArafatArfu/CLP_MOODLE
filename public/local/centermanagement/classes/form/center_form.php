<?php

namespace local_centermanagement\form;

use local_centermanagement\local\center_repository;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class center_form extends \moodleform {

    public function definition() {
        global $CFG, $DB;

        $mform = $this->_form;
        $center = $this->_customdata['center'] ?? null;
        $editoroptions = $this->_customdata['editoroptions'] ?? [];

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('text', 'center_code', get_string('centercode', 'local_centermanagement'));
        $mform->setType('center_code', PARAM_TEXT);
        $mform->addRule('center_code', get_string('required'), 'required', null, 'client');
        $mform->addRule('center_code', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'center_name', get_string('centername', 'local_centermanagement'));
        $mform->setType('center_name', PARAM_TEXT);
        $mform->addRule('center_name', get_string('required'), 'required', null, 'client');
        $mform->addRule('center_name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'school_name', get_string('schoolname', 'local_centermanagement'));
        $mform->setType('school_name', PARAM_TEXT);
        $mform->addRule('school_name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('select', 'center_type', get_string('centertype', 'local_centermanagement'), [
            'clc' => get_string('centertypeclc', 'local_centermanagement'),
            'scr' => get_string('centertypescr', 'local_centermanagement'),
        ]);
        $mform->setType('center_type', PARAM_TEXT);
        $mform->addRule('center_type', get_string('required'), 'required', null, 'client');

        $mform->addElement('text', 'division', get_string('division', 'local_centermanagement'));
        $mform->setType('division', PARAM_TEXT);
        $mform->addRule('division', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'district', get_string('district', 'local_centermanagement'));
        $mform->setType('district', PARAM_TEXT);
        $mform->addRule('district', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'upazila', get_string('upazila', 'local_centermanagement'));
        $mform->setType('upazila', PARAM_TEXT);
        $mform->addRule('upazila', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('textarea', 'address', get_string('address', 'local_centermanagement'));
        $mform->setType('address', PARAM_TEXT);

        $mform->addElement('text', 'contact_person', get_string('contactperson', 'local_centermanagement'));
        $mform->setType('contact_person', PARAM_TEXT);
        $mform->addRule('contact_person', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'contact_number', get_string('contactnumber', 'local_centermanagement'));
        $mform->setType('contact_number', PARAM_TEXT);
        $mform->addRule('contact_number', get_string('maximumchars', '', 50), 'maxlength', 50, 'client');

        $mform->addElement('text', 'email', get_string('email', 'local_centermanagement'));
        $mform->setType('email', PARAM_EMAIL);
        $mform->addRule('email', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('date_picker', 'establishment_date', get_string('establishmentdate', 'local_centermanagement'));
        $mform->setType('establishment_date', PARAM_INT);
        $mform->disabledIf('establishment_date', 'id', 'eq', '0');

        $mform->addElement('date_picker', 'start_date', get_string('startdate', 'local_centermanagement'));
        $mform->setType('start_date', PARAM_INT);

        $mform->addElement('select', 'support', get_string('support', 'local_centermanagement'), [
            '' => get_string('all'),
            'maintained' => get_string('maintained', 'local_centermanagement'),
            'activated' => get_string('activated', 'local_centermanagement'),
            'reactivated' => get_string('reactivated', 'local_centermanagement'),
        ]);
        $mform->setType('support', PARAM_TEXT);

        $mform->addElement('textarea', 'sponsor_name', get_string('sponsorname', 'local_centermanagement'));
        $mform->setType('sponsor_name', PARAM_TEXT);

        $mform->addElement('text', 'devices_count', get_string('devicescount', 'local_centermanagement'));
        $mform->setType('devices_count', PARAM_INT);
        $mform->setDefault('devices_count', 0);

        $mform->addElement('text', 'students_count', get_string('studentscount', 'local_centermanagement'));
        $mform->setType('students_count', PARAM_INT);
        $mform->setDefault('students_count', 0);

        $mform->addElement('select', 'status', get_string('status', 'local_centermanagement'), [
            '1' => get_string('statusactive', 'local_centermanagement'),
            '0' => get_string('statusinactive', 'local_centermanagement'),
        ]);
        $mform->setType('status', PARAM_INT);
        $mform->setDefault('status', 1);

        $mform->addElement('file', 'image', get_string('image', 'local_centermanagement'));
        $mform->setType('image', PARAM_FILE);
        $mform->addRule('image', null, 'maxfiles', 1);
        $mform->addRule('image', null, 'filetype', ['jpg', 'jpeg', 'png', 'gif']);

        $mform->addElement('editor', 'description', get_string('description', 'local_centermanagement'), null, $editoroptions);
        $mform->setType('description', PARAM_RAW);

        $this->add_action_buttons($center ? true : false, $center ? get_string('save') : get_string('addcenter', 'local_centermanagement'));
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (isset($data['center_code']) && !empty($data['center_code'])) {
            $excludeid = isset($data['id']) ? (int)$data['id'] : 0;
            if (center_repository::is_center_code_unique($data['center_code'], $excludeid)) {
                $errors['center_code'] = get_string('centercodenotunique', 'local_centermanagement');
            }
        }

        if (isset($data['email']) && !empty($data['email'])) {
            if (!validate_email($data['email'])) {
                $errors['email'] = get_string('invalidemail');
            }
        }

        return $errors;
    }

    public function get_data() {
        $data = parent::get_data();
        if (!$data) {
            return null;
        }

        if (isset($data->description)) {
            $data->description = $data->description['text'] ?? '';
        }

        return $data;
    }
}
