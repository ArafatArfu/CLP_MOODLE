<?php
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');

local_centermanagement_require_manager();

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
