<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP page generated from the original CLP theme (Source_code/theme/sponsor-tokai.html).
// Rendered as a self-contained page that matches the original theme exactly.

require_once(__DIR__ . '/config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/sponsor-tokai.php');
$PAGE->set_title('Sponsor a Tokai-CLC');
$PAGE->set_heading('Sponsor a Tokai-CLC');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Sponsor a Tokai-CLC</title>
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
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Be a Sponsor</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Get
                                Involved</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Be a Sponsor</a>
                        </li>
                        <li>
                            Sponsor a Tokai(টোকাই)-CLC
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            
            <div class="row">
                <div class="col-sm-12 col-xs-12 amazonSmile-left donate">
                    <h4 class="mrg-top-remove">Sponsor a <a href="tokai.php">Tokai(টোকাই)-CLC</a>
                        today!</h4>
                    <p class="work_para">Starting in 2005, CLP has built  CLC to date <a
                            target="_blank" href="school-info.php">(see tokai clc center list)</a>.
                        Out of these,  centers are being supported by the
                        sponsors and CLP is ensuring smooth operation of these centers to produce digitally literate
                        graduates when schools are in session. 8 Tokai CLCs have resurrected till now and you can
                        sponsor an unsupported center that remained uncared for and gradually ceased digital literacy
                        training program.</p>
                    <p class="work_para">*Your donation may be considered US tax-deductible.</p>
                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                            data-target="#collapseWidthDetails" aria-expanded="false"
                            aria-controls="collapseWidthDetails">
                        Know More
                    </button>
                    <div class="collapse width mt-5" id="collapseWidthDetails">
                        <div class="row sponsor-clc-scr">
                            <div class="col-sm-12 col-xs-12">
                                <div class="inner tokai">
                                    <h4>Sponsor a Tokai (টোকাই) CLC center for <strong>
                                            
                                        </strong> and bring the following resources to your school:</h4>
                                    <ul class="work_para">
                                        <li>Resurrection of tokai CLC center</li>
                                        <li>Structured curriculum</li>
                                        <li>Teachers’ guide</li>
                                        <li>Training of one teacher</li>
                                        <li>Incentive remuneration for teachers with every month activity for 12 months*
                                        </li>
                                        <li>One year maintenance contract</li>
                                    </ul>
                                    <p class="notes work_para"><i>*Teacher remuneration and equipment maintenance will
                                            continue if the donor continues to support center maintenance by donating
                                            0/year.</i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Tokai-CLC Online Pledge Form</h4>
                    <p style="text-align: right; font-size: small;"><i>* marked fields are required</i></p>
                    <div class="row donation-form">
                        <!--form starts here-->
                        <div class="row donation-form">
                            <form method="post" action="sponsor-form.html">
                                
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="full_name" class="form-control"
                                               placeholder="Full Name*" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='Full Name*'" value=""
                                               required>
                                        <div style="color:red;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="address_one" class="form-control"
                                               placeholder="Address 1*" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='Address 1'" value=""
                                               required>
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="address_two" class="form-control"
                                               placeholder="Address 2" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='Address 2'" value="">
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="city" class="form-control" placeholder="City*"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='City'"
                                               value="" required>
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" name="state" class="form-control"
                                                       placeholder="State*" onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='State'" value=""
                                                       required>
                                                <div
                                                    style="color:red; padding: 2px;"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" name="zip" class="form-control" placeholder="Zip*"
                                                       onfocus="this.placeholder=''" onblur="this.placeholder='Zip'"
                                                       value="" required>
                                                <div style="color:red; padding: 2px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="country" class="form-control" placeholder="Country*"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Country'"
                                               value="" required>
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="Email*"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Email*'"
                                               value="" required>
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="number" name="phone" class="form-control" placeholder="Phone*"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Phone*'"
                                               value="" required>
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="instituition" class="form-control"
                                               placeholder="Name of the Institution" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='Name of the Institution'"
                                               value="">
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="location" class="form-control" placeholder="Location"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Location'"
                                               value="">
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="contact" class="form-control"
                                               placeholder="Contact Person" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='Contact Person'" value="">
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="phone2" class="form-control" placeholder="Phone"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Phone'"
                                               value="">
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="donateBy" class="form-control" placeholder="Donated By"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Donated By'"
                                               value="">
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="memory" class="form-control"
                                               placeholder="In Memory Of (please specify)" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='In Memory Of (please specify)'"
                                               value="">
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <textarea name="instruction" rows="6" class="form-control textarea"
                                                  placeholder="Special Instructions (Optional)"
                                                  onfocus="this.placeholder=''"
                                                  onblur="this.placeholder='Special Instructions (Optional)'"
                                                  value=""></textarea>
                                        <div style="color:red; padding: 2px;"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="exampleCheck3" class="form-check-input"
                                               id="exampleCheck3" value="1">
                                        <label class="form-check-label work_para" for="exampleCheck3">Subscribe me to
                                            the email list so that I hear about upcoming events, volunteer
                                            opportunities, latest success stories and more.</label>
                                    </div>
                                </div>
                                <h4>Verification</h4>
                                <div class="row donation-form">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="please-label">Please enter any two digits *</label>
                                            <input type="text" name="valid" class="form-control"
                                                   placeholder="Example: 12"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Example: 12'"
                                                   required>
                                            <div style="color:red; padding: 2px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <input type="submit" name="pledge" class="read-more" value="Submit"/>
                                </div>
                            </form>
                            
                        </div>
                        <!--form ends here-->
                        <div class="row donation-form">
                            <div class="col-sm-8 col-xs-12">
                                <p class="after-clicking work_para">After clicking this button, PayPal will give you the
                                    option to continue with PayPal or pay with a credit card.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
