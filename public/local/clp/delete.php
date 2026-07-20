<?php
// Delete a CLC record from the dashboard.

require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/locallib.php');

local_clp_require_manager();

$programkey = required_param('program', PARAM_ALPHANUMEXT);
$programs = local_clp_programs();
if (!array_key_exists($programkey, $programs)) {
    $programkey = 'clc';
}
$id = required_param('id', PARAM_INT);
$confirm = optional_param('confirm', 0, PARAM_INT);
$program = $programs[$programkey];

local_clp_dashboard_page_setup($programkey, $program['fullname'] . ' management');

global $DB, $OUTPUT;

$record = $DB->get_record('clp_clc_participants', ['id' => $id, 'program' => $programkey]);
if (!$record) {
    redirect(
        new moodle_url('/local/clp/dashboard.php', ['program' => $programkey]),
        get_string('recordnotfound', 'local_clp'),
        null,
        \core\output\notification::NOTIFY_ERROR
    );
}

if ($confirm && confirm_sesskey()) {
    $DB->delete_records('clp_clc_participants', ['id' => $id, 'program' => $programkey]);
    redirect(
        new moodle_url('/local/clp/dashboard.php', ['program' => $programkey]),
        get_string('recorddeleted', 'local_clp'),
        null,
        \core\output\notification::NOTIFY_SUCCESS
    );
}

$yesurl = new moodle_url('/local/clp/delete.php', ['program' => $programkey, 'id' => $id, 'confirm' => 1, 'sesskey' => sesskey()]);
$nourl = new moodle_url('/local/clp/dashboard.php', ['program' => $programkey]);

$cancel = html_writer::link($nourl, get_string('cancel', 'local_clp'), ['class' => 'sc-dash-btn sc-dash-btn-ghost']);
$delete = html_writer::link($yesurl, get_string('delete', 'local_clp'), ['class' => 'sc-dash-btn sc-dash-danger']);

$message = html_writer::tag('p', get_string('confirmdelete', 'local_clp'), ['class' => 'sc-dash-confirm-msg'])
    . html_writer::tag('p', s($record->name) . ' &middot; ' . s($record->school), ['class' => 'sc-dash-confirm-meta'])
    . html_writer::div($delete . $cancel, 'sc-dash-confirm-actions');

$content = html_writer::start_div('sc-dash-card sc-dash-confirm')
    . html_writer::tag('h2', get_string('deleterecord', 'local_clp'), ['class' => 'sc-dash-card-title'])
    . $message
    . html_writer::end_div();

echo $OUTPUT->header();
echo local_clp_dashboard_shell($content, $programkey);
echo $OUTPUT->footer();
