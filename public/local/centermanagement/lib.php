<?php
defined('MOODLE_INTERNAL') || die();

function local_centermanagement_require_manager(): void {
    require_login();
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
}
