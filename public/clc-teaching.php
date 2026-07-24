<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP page generated from the original CLP theme (Source_code/theme/clc-teaching.html).
// Rendered as a self-contained page that matches the original theme exactly.

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/ourwork-helper.php');
$ourwork_slug = 'clc-teaching';
$ourwork_page = ourwork_get_page($ourwork_slug);
$ourwork_sections = $ourwork_page ? ourwork_get_sections($ourwork_page['id']) : [];
$ourwork_seo_title = $ourwork_page['seo_title'] ?? '';
$ourwork_seo_desc = $ourwork_page['seo_description'] ?? '';


$PAGE->set_context(context_system::instance());
$PAGE->set_url('/clc-teaching.php');
$PAGE->set_title($ourwork_page['title'] ?? 'Computer Literacy Center (CLC)');
$PAGE->set_heading($ourwork_page['title'] ?? 'Computer Literacy Center (CLC)');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title><?php echo htmlspecialchars($ourwork_seo_title ?: "CLP | Our Work"); ?></title>
    <link href="/theme/clp/assets/images/favicon-icon.png" rel="icon" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/theme/clp/style/style.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/style.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/responsive.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/jp-style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>

<?php
// Render the SAME navbar used site-wide (theme/clp/templates/navbar.mustache)
// so the menu (order, spacing, JOIN US on one line) and styling match the
// homepage and every other public page exactly. This replaces the previous
// hard-coded, out-of-date navbar copy that caused the inconsistency.
$navContext = [
    'output' => $OUTPUT,
    'sitename' => format_string($SITE->shortname, true, ['context' => context_system::instance(), 'escape' => false]),
    'config' => [
        'wwwroot' => '',
        'homeurl' => '/',
    ],
];
echo $OUTPUT->render_from_template('theme_clp/navbar', $navContext);
?>

<?php echo ourwork_render_sections($ourwork_sections); ?>
<?php echo ourwork_footer(); ?>



    <!-- CLP theme scripts (same as original theme) -->
    <script src="/theme/clp/assets/js/jquery.min.js"></script>
    <script src="/theme/clp/assets/js/jquery.js"></script>
    <script src="/theme/clp/assets/js/menu.js"></script>
    <script src="/theme/clp/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/theme/clp/assets/js/SmoothScroll.js"></script>
    <script src="/theme/clp/assets/js/bootstrap.min.js"></script>
    <script src="/theme/clp/assets/js/owl.carousel.min.js"></script>
    <script src="/theme/clp/assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Scroll Top  -->
<button class="scroll-top tran3s"><span class="fa fa-angle-up"></span></button>

<div class="preloader"></div>
<!-- End of preloader  -->

<div class="donate-popup" id="search-popup">
    <div class="close-donate theme-btn">
        <span class="fa fa-close"></span>
    </div>
    <div class="popup-inner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 donate-form-area">
                    <form class="subscribe-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search"
                                   onfocus="this.placeholder=''"
                                   onblur="this.placeholder='Search'">
                            <a href="#" class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
// nothing else



