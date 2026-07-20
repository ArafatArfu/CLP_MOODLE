<?php
namespace local_clp\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

/**
 * Form used by the dashboard to manage the public content of the CLC program.
 */
class program_settings_form extends \moodleform {

    public function definition(): void {
        $mform = $this->_form;
        $program = $this->_customdata['program'] ?? 'clc';

        if ($program === 'clc') {
            $mform->addElement('textarea', 'clc_description', get_string('clcdescription', 'local_clp'),
                ['rows' => 5]);
            $mform->setType('clc_description', PARAM_TEXT);

            $mform->addElement('text', 'clc_centers', get_string('clccenters', 'local_clp'), ['maxlength' => 10]);
            $mform->setType('clc_centers', PARAM_INT);
            $mform->addRule('clc_centers', null, 'required', null, 'client');
            $mform->addRule('clc_centers', null, 'numeric', null, 'client');

            $mform->addElement('text', 'clc_smart_classrooms', get_string('clcsmartclassrooms', 'local_clp'),
                ['maxlength' => 10]);
            $mform->setType('clc_smart_classrooms', PARAM_INT);
            $mform->addRule('clc_smart_classrooms', null, 'required', null, 'client');
            $mform->addRule('clc_smart_classrooms', null, 'numeric', null, 'client');
        }

        $mform->addElement('hidden', 'program', $program);
        $mform->setType('program', PARAM_ALPHANUMEXT);

        $this->add_action_buttons(true, get_string('savecontent', 'local_clp'));
    }

    public function validation($data, $files): array {
        $errors = parent::validation($data, $files);

        foreach (['clc_centers', 'clc_smart_classrooms'] as $field) {
            if (isset($data[$field]) && $data[$field] !== '' && (!is_numeric($data[$field]) || (int) $data[$field] < 0)) {
                $errors[$field] = get_string('invalidnumber', 'local_clp');
            }
        }

        return $errors;
    }
}
