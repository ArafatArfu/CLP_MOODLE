<?php
// CLC management dashboard.
//
// Renders a left sidebar with the CLC program menu entry. Selecting it lists
// records in a table with Create, Edit and Delete actions.

require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/locallib.php');

local_clp_require_manager();

$programkey = required_param('program', PARAM_ALPHANUMEXT);
$programs = local_clp_programs();
if (!array_key_exists($programkey, $programs)) {
    $programkey = 'clc';
}
$page = max(1, (int) optional_param('page', 1, PARAM_INT));

$program = $programs[$programkey];
local_clp_dashboard_page_setup($programkey, $program['fullname'] . ' management');

global $DB, $OUTPUT;

$total = $DB->count_records('clp_clc_participants', ['program' => $programkey]);
$perpage = local_clp_dash_per_page();
$totalpages = max(1, (int) ceil($total / $perpage));
if ($page > $totalpages) {
    $page = $totalpages;
}
$limitfrom = ($page - 1) * $perpage;
$rows = $DB->get_records(
    'clp_clc_participants',
    ['program' => $programkey],
    'name ASC, id DESC',
    '*',
    $limitfrom,
    $perpage
);

$columns = [
    ['key' => 'name', 'label' => get_string('name', 'local_clp')],
    ['key' => 'father_name', 'label' => get_string('fathername', 'local_clp')],
    ['key' => 'mother_name', 'label' => get_string('mothername', 'local_clp')],
    ['key' => 'district', 'label' => get_string('district', 'local_clp')],
    ['key' => 'division', 'label' => get_string('division', 'local_clp')],
    ['key' => 'upazila', 'label' => get_string('upazila', 'local_clp')],
    ['key' => 'mobile', 'label' => get_string('mobile', 'local_clp')],
    ['key' => 'email', 'label' => get_string('email', 'local_clp')],
    ['key' => 'gender', 'label' => get_string('gender', 'local_clp')],
    ['key' => 'school', 'label' => get_string('school', 'local_clp')],
];

$head = '';
foreach ($columns as $col) {
    $head .= html_writer::tag('th', s($col['label']), ['scope' => 'col']);
}
$head .= html_writer::tag('th', get_string('actions', 'local_clp'), ['scope' => 'col', 'class' => 'sc-dash-actions-col']);

if (empty($rows)) {
    $colcount = count($columns) + 1;
    $body = html_writer::tag(
        'tr',
        html_writer::tag('td', get_string('norecords', 'local_clp'), ['colspan' => $colcount, 'class' => 'sc-dash-empty']),
        ['class' => 'sc-dash-empty-row']
    );
} else {
    $body = '';
    foreach ($rows as $row) {
        $cells = '';
        foreach ($columns as $col) {
            $cells .= html_writer::tag('td', s($row->{$col['key']} ?? ''));
        }

        $editurl = new moodle_url('/local/clp/edit.php', ['program' => $programkey, 'id' => $row->id]);
        $deleteurl = new moodle_url('/local/clp/delete.php', ['program' => $programkey, 'id' => $row->id]);

        $actions = html_writer::link($editurl, get_string('edit', 'local_clp'), ['class' => 'sc-dash-action sc-dash-edit'])
            . html_writer::link($deleteurl, get_string('delete', 'local_clp'), ['class' => 'sc-dash-action sc-dash-delete']);

        $cells .= html_writer::tag('td', $actions, ['class' => 'sc-dash-actions-col']);
        $body .= html_writer::tag('tr', $cells);
    }
}

$table = html_writer::tag(
    'table',
    html_writer::tag('thead', html_writer::tag('tr', $head))
        . html_writer::tag('tbody', $body),
    ['class' => 'sc-dash-table']
);

$addurl = new moodle_url('/local/clp/edit.php', ['program' => $programkey]);
$addbutton = html_writer::link(
    $addurl,
    $OUTPUT->pix_icon('t/add', '') . ' ' . get_string('addrecord', 'local_clp'),
    ['class' => 'sc-dash-btn sc-dash-btn-primary']
);

$settingsurl = new moodle_url('/local/clp/content.php', ['program' => $programkey]);
$settingsbutton = html_writer::link(
    $settingsurl,
    $OUTPUT->pix_icon('i/settings', '') . ' ' . get_string('content', 'local_clp'),
    ['class' => 'sc-dash-btn sc-dash-btn-ghost']
);

$topbar = html_writer::div(
    html_writer::div(
        html_writer::tag('h2', s($program['name']), ['class' => 'sc-dash-topbar-title'])
            . html_writer::tag('p', s($program['description']), ['class' => 'sc-dash-topbar-sub'])
            . html_writer::tag('span', $total . ' ' . get_string('records', 'local_clp'), ['class' => 'sc-dash-count']),
        'sc-dash-topbar-info'
    )
    . html_writer::div($settingsbutton . $addbutton, 'sc-dash-topbar-actions'),
    'sc-dash-topbar'
);

$content = html_writer::div($topbar . html_writer::div($table, 'sc-dash-table-wrap') . local_clp_dashboard_pagination($programkey, $page, $totalpages, $total), 'sc-dash-card');

echo $OUTPUT->header();
echo local_clp_dashboard_shell($content, $programkey);
echo $OUTPUT->footer();
