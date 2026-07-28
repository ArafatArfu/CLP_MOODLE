<?php
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');

local_centermanagement_require_manager();

$action = optional_param('action', '', PARAM_ALPHANUMEXT);
$id = optional_param('id', 0, PARAM_INT);

if ($action && confirm_sesskey() && $id) {
    if ($action === 'publish' && \local_centermanagement\local\center_manager::can_manage_centers()) {
        \local_centermanagement\local\center_manager::publish_center($id);
        redirect(new moodle_url('/local/centermanagement/index.php'), get_string('centersupdated', 'local_centermanagement'), null, \core\output\notification::NOTIFY_SUCCESS);
    } elseif ($action === 'unpublish' && \local_centermanagement\local\center_manager::can_manage_centers()) {
        \local_centermanagement\local\center_manager::unpublish_center($id);
        redirect(new moodle_url('/local/centermanagement/index.php'), get_string('centersupdated', 'local_centermanagement'), null, \core\output\notification::NOTIFY_SUCCESS);
    } elseif ($action === 'duplicate' && \local_centermanagement\local\center_manager::can_add_center()) {
        $newid = \local_centermanagement\local\center_manager::duplicate_center($id);
        if ($newid) {
            redirect(new moodle_url('/local/centermanagement/edit.php', ['id' => $newid]), get_string('centersadded', 'local_centermanagement'), null, \core\output\notification::NOTIFY_SUCCESS);
        }
    }
}

$page = max(1, (int) optional_param('page', 1, PARAM_INT));
$search = optional_param('search', '', PARAM_TEXT);
$center_type = optional_param('center_type', '', PARAM_TEXT);
$status = optional_param('status', '', PARAM_TEXT);
$sort = optional_param('sort', 'timecreated DESC', PARAM_TEXT);

$filters = [];
if ($search !== '') {
    $filters['search'] = $search;
}
if ($center_type !== '') {
    $filters['center_type'] = $center_type;
}
if ($status !== '') {
    $filters['status'] = $status;
}

$perpage = 20;

local_centermanagement_dashboard_page_setup('/local/centermanagement/index.php', get_string('allcenters', 'local_centermanagement'));

global $OUTPUT;
$renderer = $PAGE->get_renderer('local_centermanagement');

echo $OUTPUT->header();
echo $renderer->render_center_list($filters, $sort, $page, $perpage);
echo $OUTPUT->footer();
