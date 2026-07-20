<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP page generated from the original CLP theme (Source_code/theme/tokai.html).
// Rendered as a self-contained page that matches the original theme exactly.

require_once(__DIR__ . '/config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/tokai.php');
$PAGE->set_title('Sponsor-a-Tokai-CLC');
$PAGE->set_heading('Sponsor-a-Tokai-CLC');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Sponsor-a-Tokai-CLC</title>
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
    <!-- End of theme_menu -->
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Sponsor-a-Tokai(টোকাই)-CLC</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Our WORK</a>
                        </li>
                        <li>
                            Sponsor-a-Tokai(টোকাই)-CLC
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->
    <section class="history-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">CLP (Computer Literacy Program) for underprivileged youth provides <a
                            href="clc-teaching.php">CLC (Computer Literacy Center)</a> to allow
                        students to receive digital literacy training through a structured curriculum. These centers are
                        established with two-thirds support from a sponsor enabling him/her to give back to the
                        underprivileged students of his/her community. CLP also ensures smooth operation of the CLC on
                        an on-going basis when the sponsor pays 50% (USD 300) of the yearly operation cost (0.00).
                    </p>
                    <p class="work_para">Starting in 2005, CLP has built  CLCs to date.
                        Out of these,  centers are being supported by the
                        sponsors and CLP is ensuring smooth operation of these centers to produce digitally literate
                        graduates when schools are in session. The unsupported centers remained uncared for and
                        gradually ceased digital literacy training program. We are dubbing each unsupported CLC, as a
                        <strong>‘Tokai (টোকাই) CLC’</strong>. All <strong>‘Tokai’</strong> CLCs are identified on the <a
                            href="school-info.php" target="_blank">CLP website</a>.</p>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <p>
                        <img src="/theme/clp/assets/images/tokai/tokai.webp" alt="img" class="img-responsive"/>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="history-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <div class="card-columns literacy-columns">
                        <div class="card partner-items literacy mrg">
                            <div class="img-col">
                                <h4>$</h4>
                                <p style="font-size: 15px">is the total cost for sponsoring a Tokai(টোকাই) Center. CLP
                                    also expects annual 0 maintenance support to ensure full operation year over
                                    year. <br></p>
                            </div>
                            <div class="text-col">
                                <div class="inner">
                                    <h4>For this we include:</h4>
                                    <ul class="work_para">
                                        <li>Rejuvenate a 'Tokai' CLC center</li>
                                        <li>Resurrect a computer lab with more than 4 computers</li>
                                        <li>Introduce structured Digital Literacy training</li>
                                        <li>Provide teacher training and the Teachers’ Guide</li>
                                        <li>Provide incentive remuneration to CLP teacher after completion of a batch
                                            training
                                        </li>
                                        <li>One-year maintenance contract</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End of partner-items -->
                    </div>
                </div>
                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">We recognize that these centers still retain limited capabilities to reinitiate
                        CLP’s digital literacy curriculum. As a result, CLP has introduced a new opportunity called
                        ‘Sponsor-a-Tokai CLC’ for a sponsor to bring these abandoned CLCs to lively operation condition
                        again.
                    </p>
                    <p class="work_para">A sponsor can pick an abandoned CLC from the <a
                            href="school-info.php" target="_blank">CLP website</a> or CLP would be able
                        to choose one or more CLCs according to guidance from a potential sponsor.
                    </p>

                    <div class="card-columns literacy-columns">
                        <div class="card partner-items literacy mrg">
                            <div class="text-col">
                            </div>
                        </div>
                        <!-- End of partner-items -->
                    </div>
                </div>

    </section>

    <section class="sponsorship-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="section-title center">
                        <h2>Sponsorship <span class="thm-color">Benefits</span></h2>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <ul class="spns-benefits-list work_para">
                        <li>Opportunity to empower youths from sponsor’s locality</li>
                        <li>Opportunity to choose the site</li>
                        <li>Honored by a plaque at the site</li>
                        <li>Option to dedicate the center in the memory of someone the sponsor chooses</li>
                    </ul>
                    <p class="btn-area donate-now text-left">
                        <a style="max-width: 300px" href="sponsor-tokai.php" target="_blank"
                           class="thm-btn">Sponsor a
                            Tokai CLC</a>
                    </p>
                    <p class="work_para"><strong>For the list of Tokai CLCs, <a target="_blank"
                                                                                href="school-info.php">click
                                here</a>.</strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p><img src="" alt="img" class="img-responsive"></p>
                    <p class="work_para">Example of plaque onsite at a CLC.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of our-partners-wrap -->
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
