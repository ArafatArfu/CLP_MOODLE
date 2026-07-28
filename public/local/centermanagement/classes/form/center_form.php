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

        $mform->addElement('hidden', 'sponsors_json');
        $mform->setType('sponsors_json', PARAM_RAW);

        $mform->addElement('header', 'section_banner', get_string('schoolbannerimages', 'local_centermanagement'));
        $mform->addElement('filepicker', 'banner_images', get_string('schoolbannerimages', 'local_centermanagement'), null, [
            'maxfiles' => 10,
            'maxbytes' => $CFG->maxbytes,
            'accepted_types' => ['image'],
            'subdirs' => 0,
            'return_types' => FILE_INTERNAL,
        ]);
        $mform->addHelpButton('banner_images', 'schoolbannerimages', 'local_centermanagement');

        $mform->addElement('header', 'section_basic', get_string('basicinfo', 'local_centermanagement'));

        $mform->addElement('text', 'center_name', get_string('nameofinstitution', 'local_centermanagement'));
        $mform->setType('center_name', PARAM_TEXT);
        $mform->addRule('center_name', get_string('requiredfield', 'local_centermanagement'), 'required', null, 'client');
        $mform->addRule('center_name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'center_code', get_string('centercode', 'local_centermanagement'));
        $mform->setType('center_code', PARAM_TEXT);
        $mform->addRule('center_code', get_string('requiredfield', 'local_centermanagement'), 'required', null, 'client');
        $mform->addRule('center_code', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'school_name', get_string('schoolname', 'local_centermanagement'));
        $mform->setType('school_name', PARAM_TEXT);
        $mform->addRule('school_name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('radios', 'center_type', get_string('centertype', 'local_centermanagement'), [
            'clc' => get_string('centertypeclc', 'local_centermanagement'),
            'scr' => get_string('centertypescr', 'local_centermanagement'),
            'clc_scr' => get_string('centertypeclcscr', 'local_centermanagement'),
            'other' => get_string('centertypeother', 'local_centermanagement'),
        ]);
        $mform->setType('center_type', PARAM_TEXT);
        $mform->addRule('center_type', get_string('requiredfield', 'local_centermanagement'), 'required', null, 'client');

        $mform->addElement('date_picker', 'start_date', get_string('startdate', 'local_centermanagement'));
        $mform->setType('start_date', PARAM_INT);
        $mform->addRule('start_date', get_string('requiredfield', 'local_centermanagement'), 'required', null, 'client');

        $mform->addElement('header', 'section_mailing', get_string('mailingaddress', 'local_centermanagement'));
        $mform->addElement('editor', 'mailing_address', get_string('mailingaddress', 'local_centermanagement'), null, $editoroptions);
        $mform->setType('mailing_address', PARAM_CLEAN);

        $mform->addElement('header', 'section_history', get_string('historyofthecenter', 'local_centermanagement'));
        $mform->addElement('editor', 'history_of_center', get_string('historyofthecenter', 'local_centermanagement'), null, $editoroptions);
        $mform->setType('history_of_center', PARAM_CLEAN);

        $mform->addElement('header', 'section_description', get_string('descriptionofthecenter', 'local_centermanagement'));
        $mform->addElement('editor', 'description_of_center', get_string('descriptionofthecenter', 'local_centermanagement'), null, $editoroptions);
        $mform->setType('description_of_center', PARAM_CLEAN);

        $mform->addElement('header', 'section_contact_person', get_string('contactpersonwithphoneemail', 'local_centermanagement'));
        $mform->addElement('editor', 'contact_person_details', get_string('contactpersonwithphoneemail', 'local_centermanagement'), null, $editoroptions);
        $mform->setType('contact_person_details', PARAM_CLEAN);

        $mform->addElement('header', 'section_accomplishment', get_string('accomplishment', 'local_centermanagement'));
        $mform->addElement('editor', 'accomplishment', get_string('accomplishment', 'local_centermanagement'), null, $editoroptions);
        $mform->setType('accomplishment', PARAM_CLEAN);

        $mform->addElement('header', 'section_sponsors', get_string('sponsors', 'local_centermanagement'));
        $mform->addElement('hidden', 'sponsors_json');
        $mform->setType('sponsors_json', PARAM_RAW);
        $mform->addElement('static', 'sponsors_container', '', '<div id="sponsors-container"></div>'
            . '<button type="button" class="btn btn-sm btn-secondary mt-2" id="add-sponsor-btn">' . get_string('addsponsor', 'local_centermanagement') . '</button>'
            . '<script>
                (function() {
                    var container = document.getElementById("sponsors-container");
                    var addBtn = document.getElementById("add-sponsor-btn");
                    if (!container || !addBtn) return;
                    function sponsorRow(index, data) {
                        var div = document.createElement("div");
                        div.className = "sponsor-row row mb-2";
                        div.innerHTML = \'<div class="col-md-3"><input type="text" name="sponsor_name[]" class="form-control" placeholder="Sponsor Name" value="\' + (data.name || "") + \'"></div>\' +
                            \'<div class="col-md-2"><input type="text" name="sponsor_country[]" class="form-control" placeholder="Country" value="\' + (data.country || "") + \'"></div>\' +
                            \'<div class="col-md-3"><input type="text" name="sponsor_address[]" class="form-control" placeholder="Address" value="\' + (data.address || "") + \'"></div>\' +
                            \'<div class="col-md-2"><input type="email" name="sponsor_email[]" class="form-control" placeholder="Email" value="\' + (data.email || "") + \'"></div>\' +
                            \'<div class="col-md-2"><input type="text" name="sponsor_phone[]" class="form-control" placeholder="Phone" value="\' + (data.phone || "") + \'"></div>\' +
                            \'<div class="col-md-1"><button type="button" class="btn btn-sm btn-danger remove-sponsor">X</button></div>\';
                        return div;
                    }
                    addBtn.addEventListener("click", function() {
                        container.appendChild(sponsorRow(container.children.length, {}));
                    });
                    container.addEventListener("click", function(e) {
                        if (e.target && e.target.classList.contains("remove-sponsor")) {
                            var row = e.target.closest(".sponsor-row");
                            if (row) row.remove();
                        }
                    });
                    var form = document.querySelector("form");
                    if (form) {
                        form.addEventListener("submit", function() {
                            var json = document.getElementById("id_sponsors_json");
                            var rows = container.querySelectorAll(".sponsor-row");
                            var data = [];
                            rows.forEach(function(row) {
                                var name = row.querySelector(\'input[name="sponsor_name[]"]\');
                                var country = row.querySelector(\'input[name="sponsor_country[]"]\');
                                var address = row.querySelector(\'input[name="sponsor_address[]"]\');
                                var email = row.querySelector(\'input[name="sponsor_email[]"]\');
                                var phone = row.querySelector(\'input[name="sponsor_phone[]"]\');
                                data.push({name: name ? name.value : "", country: country ? country.value : "", address: address ? address.value : "", email: email ? email.value : "", phone: phone ? phone.value : ""});
                            });
                            json.value = JSON.stringify(data);
                        });
                    }
                })();
            </script>');

        $mform->addElement('header', 'section_status', get_string('currentstatus', 'local_centermanagement'));
        $mform->addElement('radios', 'current_status', get_string('currentstatus', 'local_centermanagement'), [
            'supported' => get_string('supported', 'local_centermanagement'),
            'non_supported' => get_string('nonsupported', 'local_centermanagement'),
        ]);
        $mform->setType('current_status', PARAM_TEXT);
        $mform->addRule('current_status', get_string('requiredfield', 'local_centermanagement'), 'required', null, 'client');

        $mform->addElement('header', 'section_contact_info', get_string('contactinformation', 'local_centermanagement'));

        $mform->addElement('text', 'hm_teacher_name', get_string('hmteachername', 'local_centermanagement'));
        $mform->setType('hm_teacher_name', PARAM_TEXT);
        $mform->addRule('hm_teacher_name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'hm_phone_number', get_string('hmphonenumber', 'local_centermanagement'));
        $mform->setType('hm_phone_number', PARAM_TEXT);
        $mform->addRule('hm_phone_number', get_string('maximumchars', '', 50), 'maxlength', 50, 'client');

        $mform->addElement('text', 'hm_email', get_string('hmemail', 'local_centermanagement'));
        $mform->setType('hm_email', PARAM_EMAIL);
        $mform->addRule('hm_email', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'clc_teacher_name', get_string('clcteachername', 'local_centermanagement'));
        $mform->setType('clc_teacher_name', PARAM_TEXT);
        $mform->addRule('clc_teacher_name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'clc_teacher_email', get_string('clcteacheremail', 'local_centermanagement'));
        $mform->setType('clc_teacher_email', PARAM_EMAIL);
        $mform->addRule('clc_teacher_email', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'clc_teacher_phone', get_string('clcteacherphone', 'local_centermanagement'));
        $mform->setType('clc_teacher_phone', PARAM_TEXT);
        $mform->addRule('clc_teacher_phone', get_string('maximumchars', '', 50), 'maxlength', 50, 'client');

        $mform->addElement('text', 'scr_teacher_name', get_string('scrteachername', 'local_centermanagement'));
        $mform->setType('scr_teacher_name', PARAM_TEXT);
        $mform->addRule('scr_teacher_name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'scr_teacher_email', get_string('scrteacheremail', 'local_centermanagement'));
        $mform->setType('scr_teacher_email', PARAM_EMAIL);
        $mform->addRule('scr_teacher_email', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'scr_teacher_phone', get_string('scrteacherphone', 'local_centermanagement'));
        $mform->setType('scr_teacher_phone', PARAM_TEXT);
        $mform->addRule('scr_teacher_phone', get_string('maximumchars', '', 50), 'maxlength', 50, 'client');

        $mform->addElement('header', 'section_global_classroom', get_string('globalclassroom', 'local_centermanagement'));
        $mform->addElement('radios', 'global_classroom', get_string('globalclassroom', 'local_centermanagement'), [
            'yes' => get_string('yes', 'local_centermanagement'),
            'no' => get_string('no', 'local_centermanagement'),
        ]);
        $mform->setType('global_classroom', PARAM_TEXT);
        $mform->setDefault('global_classroom', 'no');

        $mform->addElement('header', 'section_other_programs', get_string('otherprograms', 'local_centermanagement'));
        $mform->addElement('radios', 'program_clp_pi_english_club', get_string('programclppienglishclub', 'local_centermanagement'), ['yes' => get_string('yes'), 'no' => get_string('no')]);
        $mform->setType('program_clp_pi_english_club', PARAM_TEXT);
        $mform->setDefault('program_clp_pi_english_club', 'no');

        $mform->addElement('radios', 'program_egl_english', get_string('programeglenglish', 'local_centermanagement'), ['yes' => get_string('yes'), 'no' => get_string('no')]);
        $mform->setType('program_egl_english', PARAM_TEXT);
        $mform->setDefault('program_egl_english', 'no');

        $mform->addElement('radios', 'program_egl_math', get_string('programeglmath', 'local_centermanagement'), ['yes' => get_string('yes'), 'no' => get_string('no')]);
        $mform->setType('program_egl_math', PARAM_TEXT);
        $mform->setDefault('program_egl_math', 'no');

        $mform->addElement('radios', 'program_csaw', get_string('programcsaw', 'local_centermanagement'), ['yes' => get_string('yes'), 'no' => get_string('no')]);
        $mform->setType('program_csaw', PARAM_TEXT);
        $mform->setDefault('program_csaw', 'no');

        $mform->addElement('header', 'section_grading', get_string('schoolgrading', 'local_centermanagement'));
        $mform->addElement('radios', 'school_grading', get_string('schoolgrading', 'local_centermanagement'), [
            'a' => get_string('gradea', 'local_centermanagement'),
            'b' => get_string('gradeb', 'local_centermanagement'),
            'c' => get_string('gradec', 'local_centermanagement'),
            'd' => get_string('graded', 'local_centermanagement'),
        ]);
        $mform->setType('school_grading', PARAM_TEXT);

        $mform->addElement('header', 'section_graduate', get_string('clcgraduatestudents', 'local_centermanagement'));
        $mform->addElement('editor', 'clc_graduate_students', get_string('clcgraduatestudents', 'local_centermanagement'), null, $editoroptions);
        $mform->setType('clc_graduate_students', PARAM_CLEAN);

        $mform->addElement('header', 'section_scr', get_string('scrbenefitedstudents', 'local_centermanagement'));
        $mform->addElement('editor', 'scr_benefited_students', get_string('scrbenefitedstudents', 'local_centermanagement'), null, $editoroptions);
        $mform->setType('scr_benefited_students', PARAM_CLEAN);

        $mform->addElement('header', 'section_hardware', get_string('hardwarestatus', 'local_centermanagement'));
        $mform->addElement('editor', 'hardware_status', get_string('hardwarestatus', 'local_centermanagement'), null, $editoroptions);
        $mform->setType('hardware_status', PARAM_CLEAN);

        $mform->addElement('header', 'section_visit', get_string('lastvisitdate', 'local_centermanagement'));
        $mform->addElement('date_time_selector', 'last_visit_date', get_string('lastvisitdate', 'local_centermanagement'));
        $mform->setType('last_visit_date', PARAM_INT);

        $mform->addElement('header', 'section_plaque', get_string('plaque', 'local_centermanagement'));
        $mform->addElement('filepicker', 'plaque_images', get_string('plaque', 'local_centermanagement'), null, [
            'maxfiles' => 20,
            'maxbytes' => $CFG->maxbytes,
            'accepted_types' => ['image'],
            'subdirs' => 0,
            'return_types' => FILE_INTERNAL,
        ]);
        $mform->addHelpButton('plaque_images', 'plaque', 'local_centermanagement');

        $mform->addElement('header', 'section_photos', get_string('schoolphotos', 'local_centermanagement'));
        $mform->addElement('filepicker', 'school_photos', get_string('schoolphotos', 'local_centermanagement'), null, [
            'maxfiles' => 50,
            'maxbytes' => $CFG->maxbytes,
            'accepted_types' => ['image'],
            'subdirs' => 0,
            'return_types' => FILE_INTERNAL,
        ]);
        $mform->addHelpButton('school_photos', 'schoolphotos', 'local_centermanagement');

        if ($center) {
            $this->add_action_buttons(true, get_string('update', 'local_centermanagement'));
        } else {
            $this->add_action_buttons(false, get_string('addcenter', 'local_centermanagement'));
        }
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

        $emailfields = ['hm_email', 'clc_teacher_email', 'scr_teacher_email'];
        foreach ($emailfields as $field) {
            if (!empty($data[$field]) && !validate_email($data[$field])) {
                $errors[$field] = get_string('invalidemail');
            }
        }

        $phonefields = ['contact_number', 'hm_phone_number', 'clc_teacher_phone', 'scr_teacher_phone'];
        foreach ($phonefields as $field) {
            if (!empty($data[$field])) {
                $phone = preg_replace('/[^0-9+]/', '', $data[$field]);
                if (!preg_match('/^\+?[0-9]{7,15}$/', $phone)) {
                    $errors[$field] = get_string('invalidphone');
                }
            }
        }

        if (empty($data['start_date'])) {
            $errors['start_date'] = get_string('invaliddate');
        }

        if (!empty($data['last_visit_date']) && !is_array($data['last_visit_date']) && ($data['last_visit_date'] < 100000 || $data['last_visit_date'] > 4102444800)) {
            $errors['last_visit_date'] = get_string('invaliddate');
        }

        if (isset($data['sponsors_json']) && is_string($data['sponsors_json'])) {
            $sponsors = json_decode($data['sponsors_json'], true);
            if ($sponsors !== null && is_array($sponsors)) {
                foreach ($sponsors as $idx => $sponsor) {
                    if (empty($sponsor['name'])) {
                        $errors['sponsors_json'] = get_string('requiredfield', 'local_centermanagement') . ' (Sponsor ' . ($idx + 1) . ' name)';
                        break;
                    }
                    if (!empty($sponsor['email']) && !validate_email($sponsor['email'])) {
                        $errors['sponsors_json'] = get_string('invalidemail') . ' (Sponsor ' . ($idx + 1) . ')';
                        break;
                    }
                    if (!empty($sponsor['phone'])) {
                        $phone = preg_replace('/[^0-9+]/', '', $sponsor['phone']);
                        if (!preg_match('/^\+?[0-9]{7,15}$/', $phone)) {
                            $errors['sponsors_json'] = get_string('invalidphone') . ' (Sponsor ' . ($idx + 1) . ')';
                            break;
                        }
                    }
                }
            }
        }

        return $errors;
    }

    public function get_data() {
        $data = parent::get_data();
        if (!$data) {
            return null;
        }

        $editorfields = [
            'mailing_address', 'history_of_center', 'description_of_center',
            'contact_person_details', 'accomplishment',
            'clc_graduate_students', 'scr_benefited_students', 'hardware_status'
        ];
        foreach ($editorfields as $field) {
            if (isset($data->$field) && is_array($data->$field)) {
                $data->$field = $data->$field['text'] ?? '';
            }
        }

        if (isset($data->sponsors_json) && is_string($data->sponsors_json)) {
            $sponsors = json_decode($data->sponsors_json, true);
            if (is_array($sponsors)) {
                $data->sponsors = $sponsors;
            } else {
                $data->sponsors = [];
            }
        } else {
            $data->sponsors = [];
        }

        return $data;
    }
}
