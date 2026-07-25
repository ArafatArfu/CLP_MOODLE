<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP Independent Evaluation Report page - dynamically loaded from CMS database.

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/ourwork-helper.php');

global $DB;

$PAGE->set_context(context_system::instance());

// Get the published evaluation report (only one expected)
$report = $DB->get_record('clp_evaluation_reports', ['status' => 'published'], '*', IGNORE_MULTIPLE);

$page_title = 'CLP | Independent Evaluation Report';
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
                <h1>Independent Evaluation Report</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">News</a>
                        </li>
                        <li>
                            Independent Evaluation Report
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <?php if ($report): ?>
    <section class="formative-reports-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-xs-12 amazonSmile-left">
                    <?php echo $report->content_left; ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <?php if (!empty($report->image_path)): ?>
                    <img src="<?php echo htmlspecialchars($report->image_path, ENT_QUOTES); ?>" alt="img" class="img-responsive">
                    <?php endif; ?>
                </div>
                <div class="col-sm-12 col-xs-12 amazonSmile-left">
                    <?php echo $report->content_right; ?>
                    <p style="text-align: center;">
                        <a class="btn btn-primary btn-lg" data-toggle="modal"
                           data-target="#myModal" href="javascript:void(0)"><strong><?php echo htmlspecialchars($report->button_text, ENT_QUOTES); ?></strong></a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of formative-reports-wrap -->

    <!-- Modal -->
    <div style="padding: 90px;" class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button style="font-size:30px;" type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo htmlspecialchars($report->modal_title, ENT_QUOTES); ?></h4>
                </div>
                <div class="modal-body">
                    <?php if (!empty($report->pdf_path)): ?>
                    <object data="<?php echo htmlspecialchars($report->pdf_path, ENT_QUOTES); ?>" type="application/pdf"
                            frameborder="0"
                            width="100%" height="600px">
                        <p class="work_para">If you are unable to view the pdf on mobile browser then please click the
                            button below to download the pdf file </p>
                        <p style="text-align: center;"><a class="btn btn-primary btn-lg"
                                                           href="<?php echo htmlspecialchars($report->pdf_path, ENT_QUOTES); ?>"><strong>Download
                                    the Report</strong></a></p>
                    </object>
                    <?php else: ?>
                    <p class="work_para">No PDF report is currently available.</p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <section class="formative-reports-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 amazonSmile-left">
                    <h4>Independent Evaluation Report</h4>
                    <p class="work_para">No report is currently available. Please check back later.</p>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <!-- End of formative-reports-wrap -->

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
</body>
</html>
<?php
// nothing else
