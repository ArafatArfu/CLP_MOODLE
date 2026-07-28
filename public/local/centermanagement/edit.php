<?php
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');

use local_centermanagement\form\center_form;

local_centermanagement_require_manager();

$id = required_param('id', PARAM_INT);
$center = \local_centermanagement\local\center_repository::get_center_by_id($id);

if (!\local_centermanagement\local\center_manager::can_edit_center($id)) {
    print_error('noaccess', 'local_centermanagement');
}

local_centermanagement_dashboard_page_setup('/local/centermanagement/edit.php?id=' . $id, get_string('editcenter', 'local_centermanagement'));

$form = new center_form(null, [
    'center' => $center,
    'editoroptions' => [
        'maxfiles' => 0,
        'maxbytes' => 0,
        'trusttext' => false,
        'noclean' => false,
        'context' => \context_system::instance(),
    ],
]);

$defaults = (array) $center;
if (!empty($center->start_date)) {
    $defaults['start_date'] = userdate($center->start_date, get_string('strftimedate', 'langconfig'));
}
if (!empty($center->establishment_date)) {
    $defaults['establishment_date'] = userdate($center->establishment_date, get_string('strftimedate', 'langconfig'));
}
if (!empty($center->last_visit_date)) {
    $defaults['last_visit_date'] = $center->last_visit_date;
}
$form->set_data($defaults);

if ($data = $form->get_data()) {
    \local_centermanagement\local\center_manager::update_center($id, $data, ['banner_images', 'plaque_images', 'school_photos']);
    if (!empty($data->sponsors)) {
        \local_centermanagement\local\center_repository::delete_sponsor(0, $id);
        foreach ($data->sponsors as $sponsor) {
            \local_centermanagement\local\center_repository::create_sponsor([
                'center_id' => $id,
                'name' => $sponsor['name'],
                'country' => $sponsor['country'] ?? '',
                'address' => $sponsor['address'] ?? '',
                'email' => $sponsor['email'] ?? '',
                'phone' => $sponsor['phone'] ?? '',
            ]);
        }
    }
    redirect(
        new moodle_url('/local/centermanagement/index.php'),
        get_string('centersupdated', 'local_centermanagement'),
        null,
        \core\output\notification::NOTIFY_SUCCESS
    );
}

ob_start();
$form->display();
$formhtml = ob_get_clean();

$content = html_writer::start_div('container-fluid');
$content .= html_writer::start_div('row');
$content .= html_writer::start_div('col-12');
$content .= html_writer::start_div('card mb-4');
$content .= html_writer::start_div('card-header');
$content .= html_writer::tag('h3', get_string('editcenter', 'local_centermanagement'), ['class' => 'card-title']);
$content .= html_writer::end_div('card-header');
$content .= html_writer::start_div('card-body');
$content .= $formhtml;
$content .= html_writer::end_div('card-body');
$content .= html_writer::end_div('card');
$content .= html_writer::end_div('col-12');
$content .= html_writer::end_div('row');
$content .= html_writer::end_div('container-fluid');

global $OUTPUT;
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_centermanagement/center_list', ['centers' => false, 'addurl' => new moodle_url('/local/centermanagement/add.php')]);
echo $content;
echo $OUTPUT->footer();
