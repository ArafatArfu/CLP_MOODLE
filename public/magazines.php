<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP Magazines page - dynamically loaded from CMS database.

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/ourwork-helper.php');

global $DB;

$PAGE->set_context(context_system::instance());

// Get all published magazines ordered by display_order ASC, year DESC
$magazines = $DB->get_records_sql(
    "SELECT * FROM {clp_magazines} WHERE status = 'published' ORDER BY display_order ASC, year DESC"
);

$page_title = 'CLP | Magazines';
$PAGE->set_title($page_title);
$PAGE->set_heading($page_title);

echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title><?php echo htmlspecialchars($page_title, ENT_QUOTES); ?></title>
    <link href="/theme/clp/assets/images/favicon-icon.png" rel="icon" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/style.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/responsive.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/jp-style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>

<?php
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

<section class="content">
    <!--Start Main Content Area-->
    <!-- End of theme_menu -->

    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Magazines</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">News & Publication</a>
                        </li>
                        <li>
                            Magazines
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="cards-wrapper">
        <?php foreach ($magazines as $mag): ?>
        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="<?php echo htmlspecialchars($mag->pdf_path, ENT_QUOTES); ?>" style="--bg-img: url(<?php echo htmlspecialchars($mag->cover_image, ENT_QUOTES); ?>)">
                <div class="ribbon-wrapper">
                    <div class="ribbon"><?php echo (int)$mag->year; ?></div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </section>

    <?php echo ourwork_footer(); ?>
    
    <!-- Scroll Top  -->
<button class="scroll-top tran3s"><span class="fa fa-angle-up"></span></button>

<!-- CLP theme scripts -->
<script src="/theme/clp/assets/js/jquery.min.js"></script>
<script src="/theme/clp/assets/js/jquery.js"></script>
<script src="/theme/clp/assets/js/menu.js"></script>
<script src="/theme/clp/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/theme/clp/assets/js/SmoothScroll.js"></script>
<script src="/theme/clp/assets/js/bootstrap.min.js"></script>
<script src="/theme/clp/assets/js/owl.carousel.min.js"></script>
<script src="/theme/clp/assets/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
<?php
// nothing else
