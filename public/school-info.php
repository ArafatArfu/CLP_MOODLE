<?php
require_once(__DIR__ . '/config.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/school-info.php');
$PAGE->set_title('CLP | Your Sponsored Center(s)');
$PAGE->set_heading('CLP | Your Sponsored Center(s)');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>CLP | Your Sponsored Center(s)</title>
    <link href="/theme/clp/assets/images/favicon-icon.png" rel="icon" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/style.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/responsive.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/jp-style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .tableFixHead { font-family: 'Noto Serif', serif; font-size: 1em; border-collapse: collapse; color: black; }
        .tableFixHead thead th { position: sticky; top: 70px; }
        thead tr th { background-color: #f9cdb7; color: black; text-align: left; font-size: 1.3em; }
        tr:nth-child(even) { background-color: #EEE; }
        .district { font-size: 20px; font-weight: bold; }
        .center-filters { margin: 0 0 14px 0; }
        .center-filters .filter-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #333;
        }
        .center-filters .form-control { max-width: 100%; }
        #centers-tbody.is-loading { opacity: 0.5; }
    </style>
</head>
<body>

<?php
$navContext = [
    'output' => $OUTPUT,
    'config' => [
        'wwwroot' => '',
        'homeurl' => '/',
    ],
];
echo $OUTPUT->render_from_template('theme_clp/navbar', $navContext);
?>

<?php
global $DB;

$green = "#47c9a2";
$lightGreen = "#b4f1df";

$years = (int)date("Y") - 2005;

$totalClcCount = get_config('local_centermanagement', 'total_clc_count');
if ($totalClcCount === false || $totalClcCount === '') {
    $totalClcCount = 309;
}

$totalScrCount = get_config('local_centermanagement', 'total_scr_count');
if ($totalScrCount === false || $totalScrCount === '') {
    $totalScrCount = 209;
}

$searchQuery = isset($_GET['query']) ? trim((string)$_GET['query']) : '';
$filterDistrict = isset($_GET['district']) ? trim((string)$_GET['district']) : '';
$filterType = isset($_GET['center_type']) ? trim((string)$_GET['center_type']) : '';
if ($filterType !== '' && !in_array($filterType, ['clc', 'scr'], true)) {
    $filterType = '';
}

// Shared table-body renderer (reused by the AJAX filter endpoint so the markup
// stays identical between a full render and a dynamic refresh).
require_once($CFG->dirroot . '/local/centermanagement/public_view.php');

// Load the sponsored centres grouped by district. The data flow mirrors the
// Laravel WebsiteController::schoolInfo() method: fetch all active centres,
// group them by district and order them, then let the (already integrated)
// frontend render the table. The heavy lifting lives in the centre
// repository so it can be reused and tested independently of this page.
$schoolsByDistrict = [];

try {
    $schoolsByDistrict = \local_centermanagement\local\center_repository::get_sponsored_centers(
        $searchQuery,
        $filterDistrict,
        $filterType
    );
    $districts = \local_centermanagement\local\center_repository::get_distinct_districts();
} catch (dml_exception $e) {
    $districts = [];
    debugging('Error loading centers: ' . $e->getMessage(), DEBUG_DEVELOPER);
}
?>

<section class="content">
    <div class="container">
        <br>
        <h3 style="text-align:center;">Your Sponsored Center(s)</h3>
        <br>
        <p class="work_para">Computer Literacy Program Volunteers for the Underprivileged (CLP) has spent <?php echo $years; ?> years
            building and running <strong><a href="clc-teaching.php">Computer Literacy Centers
                    (CLCs)</a></strong> to develop a model for computer literacy of the underprivileged youths in rural
            Bangladesh.</p>
        <p class="work_para">Total number of <strong><a href="clc-teaching.php">Computer Literacy
                    Centers
                    (CLCs)</a></strong> established to date is
            <strong><?php echo $totalClcCount; ?></strong>.</p>
        <p class="work_para">Total number of <strong><a href="/theme/clp/assets/website.smartClassRoom">Smart Classrooms
                    (SCRs)</a></strong> to date is <strong><?php echo $totalScrCount; ?></strong>.</p>
        <p class="work_para">The maintained centers are highlighted with <strong style="color: <?php echo $green; ?>">light green
                color.</strong></p>
        <p class="work_para">The activated and reactivated centers are highlighted with <strong
                style="color: <?php echo $lightGreen; ?>">more
                lighther green color.</strong></p>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-header">
                    <!-- Dynamic filtering system (Center + Center Type). Triggers
                         an AJAX refresh of the table body without a full reload. -->
                    <div class="row center-filters">
                        <div class="col-md-3">
                            <label class="filter-label" for="filter-center">Center</label>
                            <select id="filter-center" class="form-control" style="width: 100%;">
                                <option value="">All Centers</option>
                                <?php foreach ($districts as $d): ?>
                                    <option value="<?php echo htmlspecialchars($d, ENT_QUOTES); ?>" <?php echo $filterDistrict === $d ? 'selected' : ''; ?>><?php echo htmlspecialchars($d, ENT_QUOTES); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="filter-label" for="filter-type">Center Type</label>
                            <select id="filter-type" class="form-control" style="width: 100%;">
                                <option value="">Both (CLC + SCR)</option>
                                <option value="clc" <?php echo $filterType === 'clc' ? 'selected' : ''; ?>>Only CLC</option>
                                <option value="scr" <?php echo $filterType === 'scr' ? 'selected' : ''; ?>>Only SCR</option>
                            </select>
                        </div>
                    </div>
                    <form id="center-search-form" style="margin-right: 20px;" action="school-info.php" method="GET">
                        <div class="row">
                            <div class="col" style="float: right">
                                <button id="reset-search" class="btn btn-warning" type="button">Reset</button>
                            </div>
                            <div class="col" style="float: right">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                            <div class="col-md-3" style="float: right">
                                <input type="text" id="center-search-input" class="form-control" placeholder="Search by Center Name" name="query"
                                       value="<?php echo htmlspecialchars($searchQuery, ENT_QUOTES); ?>" style="width: 100%">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-body">
                    <div class="tableFixHead">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th style="width: 1%;">Sl</th>
                                <th style="width: 32%;">Center Name</th>
                                <th style="width: 8%;">District</th>
                                <th style="width: 9%;">Start Date</th>
                                <th style="width: 18%;">Center Type</th>
                                <th style="width: 28%;">Sponsor</th>
                                <th colspan=2>School Link</th>
                            </tr>
                            </thead>
                            <?php echo local_centermanagement_render_sponsored_tbody($schoolsByDistrict); ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="donate-popup" id="donate-popup">
    <div class="close-donate theme-btn"><span class="fa fa-close"></span></div>
    <div class="popup-inner">
        <div class="container">
            <div class="donate-form-area">
                <div class="section-title center"><h2>Donate</h2></div>
                <div class="row">
                    <div class="col-sm-12">
                        <p style="margin:30px 0;"><strong style="color: #00140F; font-size: 24px; line-height: 32px; font-weight: bold;">Donate to CLP</strong></p>
                        <div class="row">
                            <div class="col-md-auto"></div>
                            <div class="col-sm-6 col-xs-12">
                                <div style="text-align: center; border: solid 1px #ccc; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px; color:black">
                                    <h5>All-Purpose</h5><br>
                                    <p><a href="sponsor-form.php"><img border="0" alt="" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" class="donate-img"></a></p>
                                </div>
                            </div>
                            <div class="col-md-auto"></div>
                            <div class="col-sm-6 col-xs-12">
                                <div style="text-align: center; border: solid 1px #ccc; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px; color:black">
                                    <h5>Sherpur Project</h5><br>
                                    <p><a href="https://na01.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.paypal.com%2Fdonate%3Fhosted_button_id%3DV6D3X44Q434VC&data=04%7C01%7C%7C55db0d88c5c0408b0deb08d8bbd957c2%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637465889434712419%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C1000&sdata=dBM7VYebTlhl%2BD9nki7ERXG9u3ajtdfduu0cNPJHauw%3D&reserved=0"><img border="0" alt="" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" class="donate-img"></a></p>
                                </div>
                            </div>
                        </div>
                        <div style="margin: 0 auto; padding-top:10px;">
                            <p style="font-size: 20px; margin-bottom: 10px; margin-top: 5px; text-align: center;">Or</p>
                            <div style="text-align: center; max-width: 196px; margin: 0 auto; border-radius: 10px; padding: 10px; line-height: 22px; color:black; font-weight:bold;">Mail Check payable to CLP, 6 Tharp Lane, Marlboro, NJ07746.</div>
                        </div>
                        <div style="margin: 0 auto; width: 100%; text-align: center; color:black;"><strong>Tax ID # 46-0646134</strong></div>
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
                    <li><a href="evaluation-report.php">INDEPENDENT EVALUATION REPORT</a></li>
                    <li><a href="formative-reports.php">FORMATIVE REPORT</a></li>
                    <li><a href="annual-report.php">ANNUAL REPORT</a></li>
                    <li><a href="magazines.php">MAGAZINES</a></li>
                    <li><a href="brochure.php">BROCHURE</a></li>
                </ul>
                <h3 class="footer-title">Contact Info</h3>
                <a style="color:black;" href="tel:+7329728362">(732) 972-8362</a> <br/>
                <a style="color:black;" href="mailto:clp@clpweb.org">clp@clpweb.org</a>
                <h3 class="footer-title">Mailing Address</h3>
                <p class="address">Computer Literacy Program (CLP)<br>6 Tharp Lane <br/> Marlboro, NJ 07746, USA</p>
            </div>
            <div class="col-sm-4 col-xs-12" style="height: 520px;">
                <h3 class="footer-title">CLP Mission</h3>
                <p style="line-height: 20px;">Empowering underprivileged youths through computer literacy training and technology-aided education.</p>
                <h3 class="footer-title">Follow Us</h3>
                <div class="row">
                    <div class="footer-social">
                        <a target="_blank" href="https://facebook.com/CLPUSAA" class="fa fa-facebook social-fb"></a>
                        <a target="_blank" href="https://www.instagram.com/clp_usa/" class="fa fa-instagram social-instagram"></a>
                        <a target="_blank" href="https://twitter.com/clp_usa" class="fa fa-twitter social-twitter"></a>
                        <a target="_blank" href="https://www.youtube.com/channel/UC3CIzUUXeDXspImUjubA19A" class="fa fa-youtube social-youtube"></a>
                        <a target="_blank" href="https://www.linkedin.com/company/computer-literacy-program-volunteers-for-underprivileged/" class="fa fa-linkedin social-linkedin"></a>
                    </div>
                </div>
                <h3 class="footer-title">Legal Info</h3>
                <ul class="footer-list-menu">
                    <li>IRS ID: <strong>46-0646134</strong></li>
                </ul>
            </div>
            <div class="col-sm-4 col-xs-12" style="background-color: #f7f1e3; height: 520px;">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-list-menu">
                    <li><a href="donation-online.php">DONATE ONLINE</a></li>
                    <li><a href="donation-mail.php">DONATE BY MAIL</a></li>
                    <li><a href="donation-amazon.php">DONATE BY AMAZON-SMILE</a></li>
                    <li><a href="sponsor-clc.php">SPONSOR A CLC</a></li>
                    <li><a href="sponsor-scr.php">SPONSOR A SCR</a></li>
                    <li><a href="sponsor-tokai.php">SPONSOR A TOKAI(টোকাই)-CLC</a></li>
                    <li><a href="sponsor-computer.php">SPONSOR A COMPUTER</a></li>
                    <li><a href="volunteer.php">BE A VOLUNTEER</a></li>
                    <li><a href="contact-us.php">CONTACT US</a></li>
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

    <script src="/theme/clp/assets/js/jquery.min.js"></script>
    <script src="/theme/clp/assets/js/jquery.js"></script>
    <script src="/theme/clp/assets/js/menu.js"></script>
    <script src="/theme/clp/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/theme/clp/assets/js/SmoothScroll.js"></script>
    <script src="/theme/clp/assets/js/bootstrap.min.js"></script>
    <script src="/theme/clp/assets/js/owl.carousel.min.js"></script>
    <script src="/theme/clp/assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var $tbody = $('#centers-tbody');
            var $searchInput = $('#center-search-input');
            var $centerFilter = $('#filter-center');
            var $typeFilter = $('#filter-type');
            var $resetBtn = $('#reset-search');

            function updateResetState() {
                var active = $searchInput.val().trim() !== '' ||
                    $centerFilter.val() !== '' ||
                    $typeFilter.val() !== '';
                $resetBtn.prop('disabled', !active);
            }

            function applyCenterFilters() {
                var params = {
                    query: $searchInput.val(),
                    district: $centerFilter.val(),
                    center_type: $typeFilter.val()
                };
                $tbody.addClass('is-loading');
                $.get('school-info-ajax.php', params, function (html) {
                    var $newBody = $(html);
                    if ($newBody.length && $newBody.is('tbody')) {
                        $tbody.replaceWith($newBody);
                        $tbody = $newBody;
                    } else {
                        $tbody.html(html);
                    }
                }, 'html').always(function () {
                    $tbody.removeClass('is-loading');
                    updateResetState();
                });
            }

            $centerFilter.on('change', applyCenterFilters);
            $typeFilter.on('change', applyCenterFilters);

            // Keep the existing search submission but refresh dynamically
            // (no full page reload) so the two filters stay in sync.
            $('#center-search-form').on('submit', function (e) {
                e.preventDefault();
                applyCenterFilters();
            });

            $resetBtn.on('click', function () {
                $searchInput.val('');
                $centerFilter.val('');
                $typeFilter.val('');
                applyCenterFilters();
            });

            updateResetState();
        });
    </script>
</body>
</html>
