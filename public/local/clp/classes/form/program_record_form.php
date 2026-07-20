<?php
namespace local_clp\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

/**
 * Form used by the dashboard to create and edit a single CLC record.
 */
class program_record_form extends \moodleform {

    public function definition(): void {
        global $DB;

        $mform = $this->_form;
        $program = $this->_customdata['program'] ?? 'clc';

        $schools = $DB->get_fieldset_sql(
            "SELECT DISTINCT school FROM {clp_clc_participants} WHERE school <> '' ORDER BY school ASC"
        );

        $mform->addElement('header', 'hdr_school', get_string('section_school', 'local_clp'));

        $mform->addElement('text', 'school', get_string('school', 'local_clp'), [
            'id' => 'sc-school-input',
            'autocomplete' => 'off',
            'placeholder' => get_string('schoolplaceholder', 'local_clp'),
            'maxlength' => 200,
            'class' => 'sc-school-search-input',
        ]);
        $mform->setType('school', PARAM_TEXT);
        $mform->addRule('school', null, 'required', null, 'client');

        $schoolsjson = json_encode(array_values($schools));
        $mform->addElement('static', 'schoolnote', '', get_string('schoolnote', 'local_clp'));

        $mform->addElement('header', 'hdr_date', get_string('section_date', 'local_clp'));

        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[$m] = userdate(gmmktime(0, 0, 0, $m, 1, 2000), '%B');
        }
        $curyear = (int) date('Y');
        $years = [];
        for ($y = $curyear + 1; $y >= 2010; $y--) {
            $years[$y] = $y;
        }

        $mform->addElement('select', 'month', get_string('month', 'local_clp'), $months);
        $mform->setType('month', PARAM_INT);
        $mform->addRule('month', null, 'required', null, 'client');
        $mform->setDefault('month', (int) date('n'));

        $mform->addElement('select', 'year', get_string('year', 'local_clp'), $years);
        $mform->setType('year', PARAM_INT);
        $mform->addRule('year', null, 'required', null, 'client');
        $mform->setDefault('year', (int) date('Y'));

        $mform->addElement('header', 'hdr_personal', get_string('section_personal', 'local_clp'));

        $mform->addElement('text', 'name', get_string('name', 'local_clp'), ['maxlength' => 200]);
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        $mform->addElement('text', 'father_name', get_string('fathername', 'local_clp'), ['maxlength' => 200]);
        $mform->setType('father_name', PARAM_TEXT);

        $mform->addElement('text', 'mother_name', get_string('mothername', 'local_clp'), ['maxlength' => 200]);
        $mform->setType('mother_name', PARAM_TEXT);

        $mform->addElement('select', 'gender', get_string('gender', 'local_clp'), [
            '' => get_string('selectone', 'local_clp'),
            'Male' => get_string('male', 'local_clp'),
            'Female' => get_string('female', 'local_clp'),
            'Other' => get_string('other', 'local_clp'),
        ]);
        $mform->setType('gender', PARAM_ALPHANUMEXT);

        $mform->addElement('header', 'hdr_location', get_string('section_location', 'local_clp'));

        $mform->addElement('text', 'district', get_string('district', 'local_clp'), ['maxlength' => 100]);
        $mform->setType('district', PARAM_TEXT);

        $mform->addElement('text', 'division', get_string('division', 'local_clp'), ['maxlength' => 100]);
        $mform->setType('division', PARAM_TEXT);

        $mform->addElement('text', 'upazila', get_string('upazila', 'local_clp'), ['maxlength' => 100]);
        $mform->setType('upazila', PARAM_TEXT);

        $mform->addElement('header', 'hdr_contact', get_string('section_contact', 'local_clp'));

        $mform->addElement('text', 'mobile', get_string('mobile', 'local_clp'), ['maxlength' => 30]);
        $mform->setType('mobile', PARAM_RAW_TRIMMED);

        $mform->addElement('text', 'email', get_string('email', 'local_clp'), ['maxlength' => 254]);
        $mform->setType('email', PARAM_EMAIL);

        $mform->addElement('hidden', 'id', 0);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'program', $program);
        $mform->setType('program', PARAM_ALPHANUMEXT);

        $this->add_action_buttons(true, get_string('saverecord', 'local_clp'));
    }

    public function validation($data, $files): array {
        $errors = parent::validation($data, $files);

        if (!empty($data['email']) && !validate_email($data['email'])) {
            $errors['email'] = get_string('invalidemail', 'local_clp');
        }

        if (!empty($data['mobile'])) {
            $mobile = preg_replace('/[\s\-\(\)]/', '', $data['mobile']);
            if (!preg_match('/^\+?[0-9]{10,15}$/', $mobile)) {
                $errors['mobile'] = get_string('invalidmobile', 'local_clp');
            }
        }

        return $errors;
    }
}
