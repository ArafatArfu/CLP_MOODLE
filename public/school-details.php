<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP page generated from the original CLP theme (Source_code/theme/school-details.html).
// Rendered as a self-contained page that matches the original theme exactly.

require_once(__DIR__ . '/config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/school-details.php');
$PAGE->set_title('CLP | School Details');
$PAGE->set_heading('CLP | School Details');

// ---------------------------------------------------------------------------
// Backend logic for the "School / Center Details" page.
//
// Mirrors the Laravel WebsiteController::schoolDetails() data flow
// (Source_code/public_html/app/Http/Controllers/WebsiteController.php).
// In Laravel the page is fed by a SchoolInfo record (with a related School)
// loaded via findOrFail($request->schoolInfo). In Moodle the centre data lives
// in the denormalised local_centermanagement_centers table, so we load the
// single centre by id and derive the same display values.
//
// Field mapping follows school-details.blade.php. Where a Laravel column has no
// equivalent in the Moodle centre table (mail, history, accomplish, scr, ds,
// csaw, hardware, school_des and the multiple plaque/photo files) the value is
// left empty - the Laravel blade only renders those blocks when the value is
// set / not "no image", so an empty value is the faithful Moodle equivalent.
// ---------------------------------------------------------------------------
$schoolInfoId = optional_param('schoolInfo', 0, PARAM_INT);

$center = null;
if ($schoolInfoId) {
    try {
        $center = \local_centermanagement\local\center_repository::get_center_by_id($schoolInfoId);
    } catch (dml_exception $e) {
        $center = null;
    }
}

// Helper that reproduces the Laravel blade "{!! nl2br($value) !!}" output while
// staying safe in Moodle (escape HTML, preserve line breaks).
$clp_text = function ($value) {
    return nl2br(htmlspecialchars((string) $value, ENT_QUOTES));
};

// Derive the display values the (already integrated) frontend expects.
$institutionName = $center ? (string) ($center->center_name ?? '') : '';
$centerTypeLabel = '';
if ($center) {
    $ct = strtolower((string) ($center->center_type ?? 'clc'));
    $centerTypeLabel = ($ct === 'scr') ? 'Smart Classroom' : 'Computer Literacy Center';
}
$mailingAddress = $center ? (string) ($center->address ?? '') : '';
$descriptionText = $center ? (string) ($center->description ?? '') : '';
$contactInfo = '';
if ($center) {
    $parts = [];
    if (isset($center->contact_person) && $center->contact_person !== '') {
        $parts[] = $center->contact_person;
    }
    if (isset($center->contact_number) && $center->contact_number !== '') {
        $parts[] = $center->contact_number;
    }
    if (isset($center->email) && $center->email !== '') {
        $parts[] = $center->email;
    }
    $contactInfo = implode("\n", $parts);
}
$sponsorName = $center ? (string) ($center->sponsor_name ?? '') : '';

// Single centre image (Laravel stores up to three plaque/photo files; the
// Moodle centre table keeps one image column served via the pluginfile area).
$centerImageUrl = '';
if ($center && !empty($center->image)) {
    $syscontext = \context_system::instance();
    $centerImageUrl = (string) \moodle_url::make_pluginfile_url(
        $syscontext->id,
        'local_centermanagement',
        'center_image',
        $center->id,
        '/',
        $center->image
    );
}

echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>CLP | School Details</title>
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
// Render the SAME navbar used site-wide (theme/clp/templates/navbar.mustache)
// so the menu order, spacing and styling match the homepage and every other
// public page exactly. Replaces the previous hard-coded navbar copy.
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
    <div class="container" style="margin-top: 30px; margin-bottom: 150px;">
        <div style="margin: 10px;" class="panel panel-default">
            <div class="panel-body">
                <div class="card">
                    <div class="card-body">
                        <!---->
                        <h4 class="card-title"><strong>Name of Institution:</strong></h4>
                        <p class="card-text work_para2"><?php echo $center ? $clp_text($institutionName) : 'Center not found.'; ?></p>
                        
                        <h4 class="card-title"><strong>Center Type:</strong></h4>
                        <p class="card-text work_para2">
                            <?php echo $center ? htmlspecialchars($centerTypeLabel, ENT_QUOTES) : ''; ?>
                        </p>
                        <h4 class="card-title"><strong>Mailing Address:</strong></h4>
                        <p class="card-text work_para2"><?php echo $center ? $clp_text($mailingAddress) : ''; ?></p>
                        <h4 class="card-title"><strong>History of the Center:</strong></h4>
                        <p class="card-text work_para2"></p>
                        <h4 class="card-title"><strong>Description of the Center:</strong></h4>
                        <p class="card-text work_para2">
                            <?php echo $center ? $clp_text($descriptionText) : ''; ?>
                        </p>
                        <h4 class="card-title"><strong>Contact Person with Phone & email:</strong></h4>
                        <p class="card-text work_para2"><?php echo $center ? nl2br(htmlspecialchars($contactInfo, ENT_QUOTES)) : ''; ?></p>
                        <h4 class="card-title"><strong>Sponsor name:</strong></h4>
                        <p class="card-text work_para2"><?php echo $center ? $clp_text($sponsorName) : ''; ?></p>
                        <h4 class="card-title"><strong>Accomplishment:</strong></h4>
                        <p class="card-text work_para2"></p>
                        <h4 class="card-title"><strong>Number Of Visit:</strong></h4>
                        <p class="card-text work_para2"></p>
                        <h4 class="card-title"><strong>Flow Up Over Phone:</strong></h4>
                        <p class="card-text work_para2"></p>
                        <h4 class="card-title"><strong>Number Of CLC Graduate Students Or SCR Benefited
                                Students:</strong></h4>
                        <p class="card-text work_para2"></p>
                        <h4 class="card-title"><strong>Hardware Status:</strong></h4>
                        <p class="card-text work_para2"></p>
                        
                        <!-- Plaque Photo Section -->
                        <div class="row">
                            <?php if ($centerImageUrl !== ''): ?>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img style="width: 100%; height: 300px; object-fit: cover;"
                                             src="<?php echo htmlspecialchars($centerImageUrl, ENT_QUOTES); ?>"
                                             alt="Plaque">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!--  Photo File Section -->
                        <div class="row">
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Main Content Area-->
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
                <!-- <h4>How much would you like to donate:</h4> -->
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
                        <a href="sponsor-tokai.php">SPONSOR A TOKAI(টোকাই)-CLC</a>
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
