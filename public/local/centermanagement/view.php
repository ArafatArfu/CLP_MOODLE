<?php
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');

local_centermanagement_require_manager();

$id = required_param('id', PARAM_INT);
$center = \local_centermanagement\local\center_repository::get_center_by_id($id);

local_centermanagement_dashboard_page_setup('/local/centermanagement/view.php?id=' . $id, get_string('viewcenter', 'local_centermanagement'));

global $OUTPUT;

$canedit = \local_centermanagement\local\center_manager::can_edit_center();

$startdate = '';
if (!empty($center->start_date)) {
    $startdate = userdate($center->start_date, get_string('strftimedate', 'langconfig'));
}

$establishmentdate = '';
if (!empty($center->establishment_date)) {
    $establishmentdate = userdate($center->establishment_date, get_string('strftimedate', 'langconfig'));
}

$timemodified = '';
if (!empty($center->timemodified)) {
    $timemodified = userdate($center->timemodified, get_string('strftimedate', 'langconfig'));
}

$context = \context_system::instance();

$bannerimages = [];
foreach (\local_centermanagement\local\center_repository::get_banner_images($center->id) as $idx => $b) {
    $bannerimages[] = [
        'url' => (string) \moodle_url::make_pluginfile_url($context->id, 'local_centermanagement', 'banner_images', $center->id, '/', $b->filename),
        'first' => $idx === 0,
    ];
}

$plaqueimages = [];
foreach (\local_centermanagement\local\center_repository::get_plaque_images($center->id) as $p) {
    $plaqueimages[] = (string) \moodle_url::make_pluginfile_url($context->id, 'local_centermanagement', 'plaque_images', $center->id, '/', $p->filename);
}

$schoolphotos = [];
foreach (\local_centermanagement\local\center_repository::get_school_photos($center->id) as $p) {
    $schoolphotos[] = (string) \moodle_url::make_pluginfile_url($context->id, 'local_centermanagement', 'school_photos', $center->id, '/', $p->filename);
}

$sponsors = \local_centermanagement\local\center_repository::get_sponsors($center->id);

$context_data = [
    'center_code' => $center->center_code ?? '',
    'center_name' => $center->center_name ?? '',
    'school_name' => $center->school_name ?? '',
    'center_type' => strtoupper($center->center_type ?? 'CLC'),
    'division' => $center->division ?? '',
    'district' => $center->district ?? '',
    'upazila' => $center->upazila ?? '',
    'address' => $center->address ?? '',
    'contact_person' => $center->contact_person ?? '',
    'contact_number' => $center->contact_number ?? '',
    'email' => $center->email ?? '',
    'establishment_date' => $establishmentdate,
    'start_date' => $startdate,
    'support' => ucfirst($center->support ?? ''),
    'sponsor_name' => $center->sponsor_name ?? '',
    'devices_count' => $center->devices_count ?? 0,
    'students_count' => $center->students_count ?? 0,
    'status' => !empty($center->status) ? get_string('statusactive', 'local_centermanagement') : get_string('statusinactive', 'local_centermanagement'),
    'description' => format_text($center->description ?? '', FORMAT_HTML),
    'image' => '',
    'timemodified' => $timemodified,
    'backurl' => new moodle_url('/local/centermanagement/index.php'),
    'editurl' => new moodle_url('/local/centermanagement/edit.php', ['id' => $center->id]),
    'canedit' => $canedit,
    'bannerimages' => $bannerimages,
    'plaqueimages' => $plaqueimages,
    'schoolphotos' => $schoolphotos,
    'sponsors' => array_values($sponsors),
];

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_centermanagement/center_details', $context_data);
echo $OUTPUT->footer();
