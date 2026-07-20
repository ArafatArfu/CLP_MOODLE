<?php
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');

use local_centermanagement\form\center_form;

local_centermanagement_require_manager();

if (!\local_centermanagement\local\center_manager::can_add_center()) {
    print_error('noaccess', 'local_centermanagement');
}

local_centermanagement_dashboard_page_setup('/local/centermanagement/add.php', get_string('addcenter', 'local_centermanagement'));

$form = new center_form(null, [
    'center' => null,
    'editoroptions' => [
        'maxfiles' => 0,
        'maxbytes' => 0,
        'trusttext' => false,
        'noclean' => false,
        'context' => \context_system::instance(),
    ],
]);

if ($data = $form->get_data()) {
    \local_centermanagement\local\center_manager::create_center($data, 'center_image');
    redirect(
        new moodle_url('/local/centermanagement/index.php'),
        get_string('centersadded', 'local_centermanagement'),
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
$content .= html_writer::tag('h3', get_string('addcenter', 'local_centermanagement'), ['class' => 'card-title']);
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
echo $content;
echo $OUTPUT->footer();
