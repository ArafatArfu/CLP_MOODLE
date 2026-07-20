<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP page generated from the original CLP theme (Source_code/theme/magazines.html).
// Rendered as a self-contained page that matches the original theme exactly.

require_once(__DIR__ . '/config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/magazines.php');
$PAGE->set_title('CLP | Magazines');
$PAGE->set_heading('CLP | Magazines');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>CLP | Magazines</title>
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

    <!--data-toggle="modal" data-target="#pdf_modal" -->
    <section class="cards-wrapper">
        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="/theme/clp/assets/fileupload/magazines/Magazine-2025.pdf"  style="--bg-img: url(/theme/clp/assets/images/magazine/magazine-2024.jpg)">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2025</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>
            </a>
        </div>
        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="/theme/clp/assets/fileupload/magazines/Magazine-2024.pdf"  style="--bg-img: url(/theme/clp/assets/images/magazine/magazine-2024.jpg)">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2024</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>
            </a>
        </div>
        <div class="card-grid-space">
           <a class="card-magazine" target="_blank" href="/theme/clp/assets/fileupload/magazines/CLP_Magazine_2023.pdf"  style="--bg-img: url(/theme/clp/assets/images/magazine/mg_cover_2022.png)">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2023</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>
            </a>
        </div>
        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="/theme/clp/assets/fileupload/magazines/CLP_Magazine_2022.pdf"  style="--bg-img: url(/theme/clp/assets/images/magazine/mg_cover_2022.png">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2022</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>

            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="/theme/clp/assets/fileupload/magazines/CLP_Magazine_2021.pdf"  style="--bg-img: url(/theme/clp/assets/images/magazine/mg_cover_2021.png">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2021</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>

            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="/theme/clp/assets/fileupload/magazines/CLP_Magazine 2020.pdf"  style="--bg-img: url(/theme/clp/assets/images/magazine/2020.webp">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2020</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>

            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2019" href="/theme/clp/assets/fileupload/magazines/2019-CLP-Magazine.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2019.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2019</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2018" href="/theme/clp/assets/fileupload/magazines/VAB_2018_CLP-Magazine-Final.pdf"  style="--bg-img: url(/theme/clp/assets/images/magazine/2019.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2018</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2017" href="/theme/clp/assets/fileupload/magazines/2017CLPMagazine(2017-07-20)0819AM.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2017.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2017</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2016" href="/theme/clp/assets/fileupload/magazines/18-July-2016-6-PM-2016-UPDATED-CLP-Magazine.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2017.webp)">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2016</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2015" href="/theme/clp/assets/fileupload/magazines/CLP-Magazine-2015.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2015.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2015</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2014" href="/theme/clp/assets/fileupload/magazines/2014-Magazine-Status-1August2014-Version-3.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2014.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2014</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2013" href="/theme/clp/assets/fileupload/magazines/2013-CLP-Magazine.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2013.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2013</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2012" href="/theme/clp/assets/fileupload/magazines/2012-CLP-Magazine.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2012.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2012</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2011" href="/theme/clp/assets/fileupload/magazines/2011-CLP-Magazine.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2011.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2011</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2010" href="/theme/clp/assets/fileupload/magazines/2010-CLP-Magazine.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2010.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2010</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2009" href="/theme/clp/assets/fileupload/magazines/2009-CLP-Magazine.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2009.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2009</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2008" href="/theme/clp/assets/fileupload/magazines/2008-CLP-Magazine.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2008.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2008</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2007" href="/theme/clp/assets/fileupload/magazines/2007-CLP-Magazine.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2007.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2007</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2006" href="/theme/clp/assets/fileupload/magazines/2006-CLP-Magazine.pdf" style="--bg-img: url(/theme/clp/assets/images/magazine/2006.webp">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2006</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>
    </section>

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
