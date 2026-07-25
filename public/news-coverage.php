<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP News Coverage page - dynamically loaded from CMS database.

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/ourwork-helper.php');

global $DB;

$PAGE->set_context(context_system::instance());

// Get video section
$video = $DB->get_record('clp_news_coverage_video', ['status' => 'published'], '*', IGNORE_MULTIPLE);

// Get all published news coverage items grouped by category
$categories = ['print_media', 'article', 'research_paper'];
$news_by_category = [];
foreach ($categories as $cat) {
    $records = $DB->get_records_sql(
        "SELECT * FROM {clp_news_coverage} WHERE category = :cat AND status = 'published' ORDER BY display_order ASC, id ASC",
        ['cat' => $cat]
    );
    $news_by_category[$cat] = array_map(function($r) { return (array)$r; }, $records);
}

$page_title = 'CLP | News Coverage';
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
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>News Coverage</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">News</a>
                        </li>
                        <li>
                            News Coverage
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End of inner-banner -->

    <?php if (!empty($news_by_category['print_media'])): ?>
    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            <div class="row row-eq-height">
                <h2 style="text-align: center; padding-bottom: 1em;">Print Media</h2>
                <?php foreach ($news_by_category['print_media'] as $item): ?>
                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="<?php echo htmlspecialchars($item['image_path'], ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES); ?>">
                        <div class="caption">
                            <p class="newsDate">
                                <?php if (!empty($item['date_info'])): ?><i class="fa fa-calendar"></i> <?php echo htmlspecialchars($item['date_info'], ENT_QUOTES); ?><?php endif; ?>
                                <?php if (!empty($item['date_info']) && !empty($item['source'])): ?> <?php endif; ?>
                                <?php if (!empty($item['source'])): ?><i class="fa fa-newspaper-o"></i> <?php echo htmlspecialchars($item['source'], ENT_QUOTES); ?><?php endif; ?>
                            </p>
                            <p><h4><?php echo htmlspecialchars($item['title'], ENT_QUOTES); ?></h4></p>
                            <?php if (!empty($item['pdf_link'])): ?>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="<?php echo htmlspecialchars($item['pdf_link'], ENT_QUOTES); ?>"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($video): ?>
    <section class="<?php echo htmlspecialchars($video->section_class, ENT_QUOTES); ?>"
             style="<?php echo !empty($video->background_image) ? 'background-image: url(' . htmlspecialchars($video->background_image, ENT_QUOTES) . ');' : ''; ?>">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="newsCover-video">
                        <a href="<?php echo htmlspecialchars($video->youtube_url, ENT_QUOTES); ?>" class="gallery-video">
                            <img src="<?php echo htmlspecialchars($video->play_image, ENT_QUOTES); ?>" alt="">
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2><?php echo htmlspecialchars($video->heading, ENT_QUOTES); ?></h2>
                            <?php if (!empty($video->description)): ?>
                            <p class="description work_para"><?php echo s($video->description); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of introduction-wrap -->
    <?php endif; ?>

    <?php if (!empty($news_by_category['article'])): ?>
    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            <div class="row row-eq-height">
                <h2 style="text-align: center; padding-bottom: 1em;">Articles</h2>
                <?php foreach ($news_by_category['article'] as $item): ?>
                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="<?php echo htmlspecialchars($item['image_path'], ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES); ?>">
                        <div class="caption">
                            <p class="newsDate">
                                <?php if (!empty($item['date_info'])): ?><i class="fa fa-calendar"></i> <?php echo htmlspecialchars($item['date_info'], ENT_QUOTES); ?><?php endif; ?>
                                <?php if (!empty($item['date_info']) && !empty($item['source'])): ?> <?php endif; ?>
                                <?php if (!empty($item['source'])): ?><i class="fa fa-user-circle"></i> <?php echo htmlspecialchars($item['source'], ENT_QUOTES); ?><?php endif; ?>
                            </p>
                            <p><h4><?php echo htmlspecialchars($item['title'], ENT_QUOTES); ?></h4></p>
                            <?php if (!empty($item['pdf_link'])): ?>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="<?php echo htmlspecialchars($item['pdf_link'], ENT_QUOTES); ?>"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($news_by_category['research_paper'])): ?>
    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            <div class="row row-eq-height">
                <h2 style="text-align: center; padding-bottom: 1em;">Research Paper</h2>
                <div style="display: flex;align-content: center;justify-content: space-around;">
                    <?php foreach ($news_by_category['research_paper'] as $item): ?>
                    <div class="col-sm-12 col-md-6 col-xs-12">
                        <div class="thumbnail newsCard">
                            <img style=" width: 100%; height: 200px; object-fit: cover;"
                                 src="<?php echo htmlspecialchars($item['image_path'], ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES); ?>">
                            <div class="caption">
                                <p class="newsDate">
                                    <?php if (!empty($item['date_info'])): ?><i class="fa fa-calendar"></i> <?php echo htmlspecialchars($item['date_info'], ENT_QUOTES); ?><?php endif; ?>
                                    <?php if (!empty($item['date_info']) && !empty($item['source'])): ?> <?php endif; ?>
                                    <?php if (!empty($item['source'])): ?><i class="fa fa-user-circle"></i> <?php echo htmlspecialchars($item['source'], ENT_QUOTES); ?><?php endif; ?>
                                </p>
                                <p><h4><?php echo htmlspecialchars($item['title'], ENT_QUOTES); ?></h4></p>
                                <?php if (!empty($item['pdf_link'])): ?>
                                <p style="text-align: center; margin: 10px;"><a
                                        href="<?php echo htmlspecialchars($item['pdf_link'], ENT_QUOTES); ?>"
                                        class="btn btn-primary newsBtn" role="button">Read More</a></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php echo ourwork_footer(); ?>
    
    <!-- End of content-wrapper -->
    <!-- Scroll Top  -->
<button class="scroll-top tran3s"><span class="fa fa-angle-up"></span></button>

<div class="preloader"></div>
<script>
    (function() {
        var timeout = setTimeout(function() {
            var preloader = document.querySelector('.preloader');
            if (preloader) {
                preloader.style.transition = 'opacity 0.5s ease';
                preloader.style.opacity = '0';
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }
        }, 3000);
        window.addEventListener('load', function() {
            clearTimeout(timeout);
            var preloader = document.querySelector('.preloader');
            if (preloader) {
                preloader.style.transition = 'opacity 0.5s ease';
                preloader.style.opacity = '0';
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }
        });
    })();
</script>

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
</section>
<!-- End of content-wrapper -->

<!--Start Footer Area-->

<div class="donate-popup" id="donate-popup">
    <div class="close-donate theme-btn">
        <span class="fa fa-close"></span>
    </div>

    <div class="popup-inner">
        <div class="container">
            <div class="donate-form-area">
                <div class="section-title center">
                    <h2>Donate</h2>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p style="margin:30px 0;"><strong style="color: #00140F; font-size: 24px; line-height: 32px; font-weight: bold;">Donate to CLP</strong></p>

                        <div class="row">
                            <div class="col-md-auto">
                            </div>

                            <div class="col-sm-6 col-xs-12">
                                <div style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px; color:black">
                                    <h5>All-Purpose</h5><br>
                                    <p>
                                        <a href="sponsor-form.php">
                                            <img border="0" alt="" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" class="donate-img">
                                        </a>
                                    </p>
                                </div>

                            </div>

                            <div class="col-md-auto">
                            </div>

                            <div class="col-sm-6 col-xs-12">
                                <div style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px; color:black">
                                    <h5>Sherpur Project</h5><br>
                                    <p>
                                        <a href="https://na01.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.paypal.com%2Fdonate%3Fhosted_button_id%3DV6D3X44Q434VC&data=04%7C01%7C%7C55db0d88c5c0408b0deb08d8bbd957c2%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637465889434712419%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C1000&sdata=dBM7VYebTlhl%2BD9nki7ERXG9u3ajtdfduu0cNPJHauw%3D&reserved=0">
                                            <img border="0" alt="" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" class="donate-img">
                                        </a>
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div style="margin: 0 auto; padding-top:10px;">
                            <p style="font-size: 20px; margin-bottom: 10px; margin-top: 5px; text-align: center;">Or</p>
                            <div style="text-align: center; max-width: 196px; margin: 0 auto; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 10px; line-height: 22px; color:black; font-weight:bold;">Mail Check payable to CLP, 6 Tharp Lane, Marlboro, NJ07746.</div>
                        </div>
                        <div style="margin: 0 auto; width: 100%; text-align: center; color:black;">
                            <strong>Tax ID # 46-0646134</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="clp-footer">
    <section class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-xs-12" style="background-color: #f7f1e3; height: 520px;">
                <h3 class="footer-title">Resources</h3>
                <ul class="footer-list-menu">
                    <li>
                        <a href="evaluation-report.php">INDEPENDENT
                            EVALUATION REPORT</a>
                    </li>
                    <li>
                        <a href="formative-reports.php">FORMATIVE REPORT</a>
                    </li>
                    <li>
                        <a href="annual-report.php">ANNUAL REPORT</a>
                    </li>
                    <li>
                        <a href="magazines.php">MAGAZINES</a>
                    </li>
                    <li>
                        <a href="brochure.php">BROCHURE</a>
                    </li>
                </ul>
                <h3 class="footer-title">Contact Info</h3>
                <a style="color:black;" href="tel:+7329728362">(732) 972-8362</a> <br/>
                <a style="color:black;" href="mailto:clp@clpweb.org">clp@clpweb.org</a>

                <h3 class="footer-title">Mailing Address</h3>
                <p class="address">Computer Literacy Program (CLP)<br>6 Tharp Lane <br/> Marlboro, NJ 07746, USA</p>
            </div>

            <div class="col-sm-4 col-xs-12" style="height: 520px;">
                <h3 class="footer-title">CLP Mission</h3>
                <p style="line-height: 20px;">Empowering underprivileged youths through computer literacy training and
                    technology-aided education.</p>
                <h3 class="footer-title">Follow Us</h3>
                <div class="row">
                    <div class="footer-social">
                        <a target="_blank" href="https://facebook.com/CLPUSAA" class="fa fa-facebook social-fb"></a>
                        <a target="_blank" href="https://www.instagram.com/clp_usa/"
                           class="fa fa-instagram social-instagram"></a>
                        <a target="_blank" href="https://twitter.com/clp_usa" class="fa fa-twitter social-twitter"></a>
                        <a target="_blank" href="https://www.youtube.com/channel/UC3CIzUUXeDXspImUjubA19A"
                           class="fa fa-youtube social-youtube"></a>
                        <a target="_blank" href="https://www.linkedin.com/company/computer-literacy-program-volunteers-for-underprivileged/" class="fa fa-linkedin social-linkedin"></a>
                    </div>
                </div>

                <h3 class="footer-title">Legal Info</h3>
                <ul class="footer-list-menu">
                    <li>
                        IRS ID: <strong>46-0646134</strong>
                    </li>
                </ul>
            </div>
            <div class="col-sm-4 col-xs-12" style="background-color: #f7f1e3; height: 520px;">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-list-menu">
                    <li>
                        <a href="donation-online.php">DONATE ONLINE</a>
                    </li>
                    <li>
                        <a href="donation-mail.php">DONATE BY MAIL</a>
                    </li>
                    <li>
                        <a href="donation-amazon.php">DONATE BY AMAZON-SMILE</a>
                    </li>
                    <li>
                        <a href="sponsor-clc.php">SPONSOR A CLC</a>
                    </li>
                    <li>
                        <a href="sponsor-scr.php">SPONSOR A SCR</a>
                    </li>
                    <li>
                        <a href="sponsor-tokai.php">SPONSOR A TOKAI(টোকAI)-CLC</a>
                    </li>
                    <li>
                        <a href="sponsor-computer.php">SPONSOR A COMPUTER</a>
                    </li>
                    <li>
                        <a href="volunteer.php">BE A VOLUNTEER</a>
                    </li>
                    <li>
                        <a href="contact-us.php">CONTACT US</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="background-color: #232121;">
                <p class="text-center" style="color: #FFF; padding: 5px;">Copyright &copy; CLP, 2026</p>
            </div>
        </div>
    </section>
</footer>



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
</body>
</html>
<?php
// nothing else
