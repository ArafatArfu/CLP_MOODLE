<?php
// Shared helpers for the CLP CLC database management.
//
// The public program page lists CLC enrolment records from {clp_clc_participants}.
// The dashboard lets administrators manage those records.

defined('MOODLE_INTERNAL') || die();

/**
 * Program metadata.
 *
 * @return array
 */
function local_clp_programs(): array {
    return [
        'clc' => [
            'key' => 'clc',
            'name' => 'CLC – Computer Literacy Center',
            'fullname' => 'CLC – Computer Literacy Center',
            'description' => 'Manage Computer Literacy Center enrolment records.',
            'settings' => ['clc_description', 'clc_centers', 'clc_smart_classrooms'],
            'stats' => [
                ['config' => 'clc_centers', 'label' => 'Computer Literacy Centers (CLCs)'],
                ['config' => 'clc_smart_classrooms', 'label' => 'Smart Classrooms (SCRs)'],
            ],
        ],
    ];
}

/**
 * Require an authenticated site administrator.
 */
function local_clp_require_manager(): void {
    require_login();
    if (!is_siteadmin()) {
        print_error('accessdenied', 'admin');
    }
}

/**
 * Page setup shared by every dashboard screen.
 *
 * @param string $program
 * @param string $title
 */
function local_clp_dashboard_page_setup(string $program, string $title): void {
    global $PAGE;

    $PAGE->set_url(new moodle_url('/local/clp/dashboard.php', ['program' => $program]));
    $PAGE->set_context(context_system::instance());
    $PAGE->set_pagelayout('base');
    $PAGE->add_body_class('sc-dash-page');
    $PAGE->set_title($title);
    $PAGE->set_heading($title);
    $PAGE->requires->css(new moodle_url('/local/clp/dashboard.css'));
}

/**
 * Records per page on the dashboard list.
 *
 * @return int
 */
function local_clp_dash_per_page(): int {
    return 20;
}

/**
 * Distinct school names across the program.
 *
 * @return array
 */
function local_clp_distinct_schools(): array {
    global $DB;

    return $DB->get_fieldset_sql(
        "SELECT DISTINCT school FROM {clp_clc_participants} WHERE school <> '' ORDER BY school ASC"
    );
}

/**
 * Render the dashboard shell (sidebar + main content region).
 *
 * @param string $content
 * @param string $activeprogram
 * @return string
 */
function local_clp_dashboard_shell(string $content, string $activeprogram): string {
    global $OUTPUT, $SITE;

    $programs = local_clp_programs();
    $nav = [];
    foreach ($programs as $key => $p) {
        $nav[] = [
            'key' => $key,
            'name' => $p['name'],
            'url' => (new moodle_url('/local/clp/dashboard.php', ['program' => $key]))->out(false),
            'active' => $key === $activeprogram,
        ];
    }

    $context = [
        'sitename' => format_string($SITE->shortname),
        'programs' => $nav,
        'liveurl' => (new moodle_url('/local/clp/program.php', ['program' => $activeprogram]))->out(false),
        'siteurl' => (new moodle_url('/'))->out(false),
        'content' => $content,
    ];

    return $OUTPUT->render_from_template('local_clp/dashboard', $context);
}

/**
 * Render dashboard pagination controls.
 *
 * @param string $programkey
 * @param int $page
 * @param int $totalpages
 * @param int $total
 * @return string
 */
function local_clp_dashboard_pagination(string $programkey, int $page, int $totalpages, int $total): string {
    $perpage = local_clp_dash_per_page();
    $start = $total === 0 ? 0 : (($page - 1) * $perpage) + 1;
    $end = min($page * $perpage, $total);

    $info = html_writer::div(
        'Showing ' . $start . '&ndash;' . $end . ' of ' . $total
            . ' record' . ($total === 1 ? '' : 's'),
        'sc-dash-pg-info'
    );

    if ($totalpages <= 1) {
        return html_writer::div($info, 'sc-dash-pagination');
    }

    $buttons = '';
    $buttons .= html_writer::link(
        new moodle_url('/local/clp/dashboard.php', ['program' => $programkey, 'page' => max(1, $page - 1)]),
        '&lsaquo; Prev',
        ['class' => 'sc-dash-pg-btn' . ($page <= 1 ? ' is-disabled' : '')]
    );

    $window = 2;
    for ($p = 1; $p <= $totalpages; $p++) {
        if ($p === 1 || $p === $totalpages || ($p >= $page - $window && $p <= $page + $window)) {
            $class = 'sc-dash-pg-btn' . ($p === $page ? ' is-active' : '');
            $buttons .= html_writer::link(
                new moodle_url('/local/clp/dashboard.php', ['program' => $programkey, 'page' => $p]),
                (string) $p,
                ['class' => $class]
            );
        } else if ($p === $page - $window - 1 || $p === $page + $window + 1) {
            $buttons .= html_writer::tag('span', '&hellip;', ['class' => 'sc-dash-pg-ellipsis']);
        }
    }

    $buttons .= html_writer::link(
        new moodle_url('/local/clp/dashboard.php', ['program' => $programkey, 'page' => min($totalpages, $page + 1)]),
        'Next &rsaquo;',
        ['class' => 'sc-dash-pg-btn' . ($page >= $totalpages ? ' is-disabled' : '')]
    );

    return html_writer::div($info . html_writer::div($buttons, 'sc-dash-pg-buttons'), 'sc-dash-pagination');
}
