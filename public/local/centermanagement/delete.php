<?php
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');

local_centermanagement_require_manager();

$id = required_param('id', PARAM_INT);
$center = \local_centermanagement\local\center_repository::get_center_by_id($id);

if (!\local_centermanagement\local\center_manager::can_delete_center($id)) {
    print_error('noaccess', 'local_centermanagement');
}

local_centermanagement_dashboard_page_setup('/local/centermanagement/delete.php?id=' . $id, get_string('deletecenter', 'local_centermanagement'));

$confirm = optional_param('confirm', 0, PARAM_INT);

if ($confirm && confirm_sesskey()) {
    \local_centermanagement\local\center_manager::delete_center($id);
    redirect(
        new moodle_url('/local/centermanagement/index.php'),
        get_string('centersdeleted', 'local_centermanagement'),
        null,
        \core\output\notification::NOTIFY_SUCCESS
    );
}

$context_data = [
    'deleteurl' => new moodle_url('/local/centermanagement/delete.php', ['id' => $id, 'confirm' => 1]),
    'id' => $id,
    'cancelurl' => new moodle_url('/local/centermanagement/index.php'),
    'sesskey' => sesskey(),
];

global $OUTPUT;
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_centermanagement/center_delete', $context_data);
echo $OUTPUT->footer();
