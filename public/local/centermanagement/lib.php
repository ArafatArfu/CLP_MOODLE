<?php
defined('MOODLE_INTERNAL') || die();

function local_centermanagement_require_manager(): void {
    require_login();
    $context = \context_system::instance();
    if (!\local_centermanagement\local\center_manager::can_manage_centers() &&
        !\local_centermanagement\local\center_manager::can_view_centers()) {
        print_error('noaccess', 'local_centermanagement');
    }
}

function local_centermanagement_dashboard_page_setup(string $url, string $title): void {
    global $PAGE;
    $PAGE->set_url(new moodle_url($url));
    $PAGE->set_context(\context_system::instance());
    $PAGE->set_pagelayout('base');
    $PAGE->set_title($title);
    $PAGE->set_heading($title);
    $PAGE->requires->css(new moodle_url('/local/centermanagement/styles.css'));
}

function local_centermanagement_pluginfile($course, $cm, context $context, $filearea, $args, $forcedownload, array $options = []) {
    global $DB;

    $itemid = array_shift($args);
    if (!$itemid) {
        return false;
    }

    $allowedareas = ['banner_images', 'plaque_images', 'school_photos'];
    if (!in_array($filearea, $allowedareas, true)) {
        return false;
    }

    $center = $DB->get_record('local_centermanagement_centers', ['id' => (int)$itemid, 'status' => 1], '*', MUST_EXIST);
    if (!$center) {
        return false;
    }

    $filename = array_pop($args);
    $filepath = '/';

    $fs = get_file_storage();
    $file = $fs->get_file($context_system::instance()->id, 'local_centermanagement', $filearea, $center->id, $filepath, $filename);
    if (!$file || $file->is_directory()) {
        return false;
    }

    send_stored_file($file, 0, 0, false, $options);
}

function local_centermanagement_extend_navigation(global_navigation $navigation) {
    if (!isloggedin() || isguestuser()) {
        return;
    }
    $context = \context_system::instance();
    if (!has_capability('local/centermanagement:view', $context)) {
        return;
    }
    $centername = $navigation->find('centermaingroup', global_navigation::TYPE_CONTAINER);
    if (!$centername) {
        $centername = $navigation->add(
            get_string('pluginname', 'local_centermanagement'),
            new moodle_url('/local/centermanagement/index.php'),
            global_navigation::TYPE_CONTAINER,
            null,
            'centermaingroup',
            new pix_icon('t/managecategories', get_string('pluginname', 'local_centermanagement'))
        );
    }
    if ($centername && !$centername->find('centermanagement-centerlist', global_navigation::TYPE_CUSTOM)) {
        $centername->showinflatnavigation = true;
        $centername->display = true;
        $pages = [
            'centermanagement-centerlist' => ['url' => '/local/centermanagement/index.php', 'string' => 'centerlist'],
            'centermanagement-addcenter' => ['url' => '/local/centermanagement/add.php', 'string' => 'addcenter'],
            'centermanagement-schoolmgmt' => ['url' => '/local/centermanagement/index.php', 'string' => 'schoolinformationmanagement'],
        ];
        foreach ($pages as $key => $item) {
            $text = get_string($item['string'], 'local_centermanagement');
            $centername->add($text, new moodle_url($item['url']), global_navigation::TYPE_CUSTOM, null, $key);
        }
    }
}
