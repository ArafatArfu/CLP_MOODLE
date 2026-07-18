<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP inner page layout (used by About Us sub-pages).

defined('MOODLE_INTERNAL') || die();

$bodyattributes = $OUTPUT->body_attributes();

// Add CLP theme JS files.
$PAGE->requires->js('/theme/clp/assets/js/jquery.min.js', true);
$PAGE->requires->js('/theme/clp/assets/js/bootstrap.min.js', true);
$PAGE->requires->js('/theme/clp/assets/js/menu.js', true);
$PAGE->requires->js('/theme/clp/assets/js/custom.js', true);

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), 'escape' => false]),
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
    'currentyear' => date('Y'),
    'title' => !empty($PAGE->title) ? $PAGE->title : '',
    'heading' => !empty($PAGE->heading) ? $PAGE->heading : '',
    'breadcrumbparent' => !empty($GLOBALS['clp_breadcrumb_parent']) ? $GLOBALS['clp_breadcrumb_parent'] : 'About Us',
    'content' => !empty($GLOBALS['clp_page_content']) ? $GLOBALS['clp_page_content'] : '',
];

echo $OUTPUT->render_from_template('theme_clp/innerpage', $templatecontext);

echo $OUTPUT->main_content();
?>
</body>
</html>
