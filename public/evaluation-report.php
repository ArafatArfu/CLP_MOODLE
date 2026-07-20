<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP page generated from the original CLP theme (Source_code/theme/evaluation-report.html).
// Rendered as a self-contained page that matches the original theme exactly.

require_once(__DIR__ . '/config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/evaluation-report.php');
$PAGE->set_title('CLP | Independent Evaluation Report');
$PAGE->set_heading('CLP | Independent Evaluation Report');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>CLP | Independent Evaluation Report</title>
    <link href="/theme/clp/assets/images/favicon-icon.png" rel="icon" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/style.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/responsive.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/jp-style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>

<!-- Navbar Start-->
<section class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-5">
                <ul class="social-icon">
                    <li>
                        <a href="https://www.facebook.com/CLPUSAA" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/clp_usa" target="_blank"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/channel/UC3CIzUUXeDXspImUjubA19A" target="_blank"><i
                                class="fa fa-youtube"></i></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/clp_usa/" target="_blank"><i class="fa fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-8 col-xs-7 text-right">
                <!--<button class="thm-btn donate-box-btn">donate</button>-->
                <a href="#" class="thm-btn donate-box-btn">
                    Donate
                </a>
            </div>
        </div>
    </div>
</section>
<!-- End of top-bar -->

<section class="theme_menu stricky">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="main-logo">
                    <a href="/">
                        <img alt="" src="/theme/clp/assets/images/logo/clp-logo-2022-4.png"/>
                    </a>
                </div>
            </div>
            <!--main nav start-->
            <div class="col-md-9 menu-column">
                <nav class="defaultmainmenu" id="main_menu">
                    <ul class="defaultmainmenu-menu">
                        <!--about us-->
                        <li>
                            <a href="team.php">ABOUT US</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="history.php">HISTORY</a>
                                </li>
                                <li>
                                    <a href="mission.php">MISSION</a>
                                </li>
                                <li>
                                    <a href="impact.php">IMPACT</a>
                                </li>
                                <li>
                                    <a href="partners.php">PARTNERS</a>
                                </li>
                                <li>
                                    <a href="team.php">OUR TEAM</a>
                                </li>
                                <li>
                                    <a href="faq.php">FAQ</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="local/clp/program.php?program=clc">DATABASE</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="local/clp/program.php?program=clc">CLC – Computer Literacy Center</a>
                                </li>
                            </ul>
                        </li>
                        <!--OUR WORK-->
                        <li>
                            <a href="#">OUR WORK</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="clc-teaching.php">COMPUTER LITERACY CENTER (CLC)</a>
                                </li>
                                <li>
                                    <a href="smart-classroom.php">SMART CLASSROOM (SCR)</a>
                                </li>
                                <li>
                                    <a href="remote-volunteer.php">
                                        REMOTE VOLUNTARY TEACHING
                                        (RVT)
                                    </a>
                                </li>
                                <li>
                                    <a href="connect-students.php">
                                        CONNECT STUDENTS AROUND THE
                                        WORLD
                                        (CSAW)
                                    </a>
                                </li>

                                <li>
                                    <a href="education-entertainment.php">EDUCATION THROUGH
                                        ENTERTAINMENT (EE)</a>
                                </li>

                                <li>
                                    <a href="success-stories.php">SUCCESS STORIES</a>
                                </li>

                                <li>
                                    <a href="#">MORE PROGRAMS</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a style="font-size: 12px;" href="tokai.php">Sponsor a
                                                TOKAI(টোকাই)-CLC</a>
                                        </li>

                                        <li>
                                            <a style="font-size: 12px;"
                                               href="five-dollar-graduate.php">5$
                                                CLP Graduate</a>
                                        </li>
                                        <li>
                                            <a style="font-size: 12px;"
                                               href="curriculum-development.php">Curriculum
                                                Development</a>
                                        </li>
                                        <li>
                                            <a style="font-size: 12px;"
                                               href="training-material.php">Develop
                                                Training
                                                Material</a>
                                        </li>
                                        <li>
                                            <a style="font-size: 12px;"
                                               href="teacher-training.php">Teacher
                                                Training
                                                Program</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Centers</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="#">BE A SPONSOR</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a style="text-transform: none;"
                                               href="sponsor-clc.php">Sponsor
                                                a CLC</a>
                                        </li>
                                        <li>
                                            <a style="text-transform: none;"
                                               href="sponsor-scr.php">Sponsor
                                                a SCR</a>
                                        </li>
                                        <li>
                                            <a style="text-transform: none;"
                                               href="sponsor-tokai.php">Sponsor a
                                                Tokai(টোকাই)-CLC</a>
                                        </li>

                                        <li>
                                            <a style="text-transform: none;"
                                               href="sponsor-computer.php">Sponsor
                                                a Computer</a>
                                        </li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="school-info.php">All CENTERS</a>
                                </li>
                                <li>
                                    <a href="search-center.php">SEARCH CENTERS</a>
                                </li>
                            </ul>
                        </li>
                        <!--SHERPUR PROJECT-->
                        <li>
                            <a style="text-transform: none;"
                               href="sherpurpr.php">SHERPUR PROJECT</a>
                        </li>
                        
                        <!--News and Reports-->
                        <li>
                            <a href="#">NEWS & REPORTS</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="news-coverage.php">NEWS COVERAGE</a>
                                </li>
                                <li>
                                    <a href="latest-news.php">CLP BLOG</a>
                                </li>
                                <li>
                                    <a href="#">REPORT</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a href="eos-evaluation-report-01.php">E. O. S.
                                                EVALUATION REPORT</a>
                                        </li>
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
                                    </ul>
                                </li>
                                <li>
                                    <a href="magazines.php">MAGAZINES</a>
                                </li>
                                <li>
                                    <a href="brochure.php">BROCHURE</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">BE A SPONSOR</a>
                            <ul class="dropdown">
                                <li>
                                    <a style="text-transform: none;" href="sponsor-clc.php">Sponsor a
                                        CLC</a>
                                </li>
                                <li>
                                    <a style="text-transform: none;" href="sponsor-scr.php">Sponsor a
                                        SCR</a>
                                </li>
                                <li>
                                    <a style="text-transform: none;" href="sponsor-tokai.php">Sponsor
                                        a
                                        Tokai(টোকাই)-CLC</a>
                                </li>
                                <li>
                                    <a style="text-transform: none;" href="sponsor-computer.php">Sponsor
                                        a
                                        Computer</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">JOIN US</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="sponsor-form.php">Donation Form</a>
                                </li>
                                <li>
                                    <a href="#">DONATE</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a href="donation-online.php">DONATE ONLINE</a>
                                        </li>
                                        <li>
                                            <a href="donation-mail.php">DONATE BY MAIL</a>
                                        </li>
                                        <li>
                                            <a href="donation-amazon.php">DONATE BY AMAZON SMILE</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="volunteer.php">BE A VOLUNTEER</a>
                                </li>
                                <li>
                                    <a href="contact-us.php">CONTACT US</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

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
    <section class="formative-reports-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-xs-12 amazonSmile-left">
                    <h4 class="mrg">An independent evaluation by a student from The Fletcher School of Law and
                        Diplomacy, Tufts University”, Boston, MA, USA</h4>

                    <p class="work_para">CLP (a successor organization of New Jersey chapter of the Volunteers
                        Association for Bangladesh (VAB-NJ) conceptualized the Computer Literacy Program as an
                        initiative through which CLCs would be established at educational institutions throughout
                        Bangladesh to help underprivileged youths learn computer usage. The CLP is a complete package
                        which includes the establishment of a computer lab at each CLC, development of a structured
                        hands-on curriculum, development of training manuals for both teachers and students, creation of
                        a pool of trained teachers, and providing the required technical support and monitoring to
                        ensure smooth operation of the computer labs. Each computer lab is equipped with a minimum of
                        four computers, one printer, necessary voltage regulator/stabilizers and other accessories. Dnet
                        implemented this vision. The on-the-ground tasks include site selection for CLCs, developing
                        curricula, preparing instruction manuals, training the teachers, supervising the smooth
                        operation of the centres, and technical support and maintenance. Dnet has the technical
                        expertise, innovative ideas for implementation, and the necessary motivation.</p>

                    <p class="work_para">Given the existence of a mature program management and operations capability on
                        the ground, a strong, proven basic curriculum, and well-functioning computer laboratories, Dnet
                        and CLP feel it is time to evaluate the impacts of CLCs as a precursor to considering
                        implementing value-added components. The study focus on the overall impact of CLCs and the CLP
                        course on the perceptions, attitudes and decision making processes for students, and the
                        assessment of this impact by teachers, head teachers and guardians. This study conducted by Mr.
                        Ashirul Amin, a Graduate Student (MALD) of “The Fletcher School of Law and Diplomacy, Tufts
                        University”, Boston, MA, USA.</p>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <img src="/theme/clp/assets/images/Angela.png" alt="img" class="img-responsive">
                </div>
                <div class="col-sm-12 col-xs-12 amazonSmile-left">
                    <h4>Computer Literacy Program has been selected for evaluating based on Gender Evaluation
                        Methodology (GEM) for rural ICT4D project by “Association for Progressive Communications” a
                        South Africa based international organization.</h4>
                    <p class="work_para">Gender gaps that are widespread in access to basic rights, access to and
                        control of resources, in economic opportunities and also in power and political voice are an
                        impediment to development. Technologies are socially constructed and thus have direct impacts on
                        Gender. A rural ICT4D project cannot automatically address the gender divide in access, use and
                        appropriation for changing lives in positive ways. Association for Progressive Communications
                        (www.apc.org) Women’s Networking Support Program (APC WNSP) selected an ongoing project
                        operating by Dnet titled “Empowering underprivileged youth in Bangladesh through computer
                        literacy (CLP)” for applying their adopted Gender Evaluation Methodology (GEM) for rural ICT4D
                        project for evaluating the project.</p>

                    <p class="work_para">As a GEM practitioner Dnet has been applying GEM for its ICT4D projects
                        gradually. This is a one year research project, financed by APC WNCP. The project output will be
                        a report analyzing the gender dimension of the Computer Literacy Program. The GEM adaptation
                        process aims at sensitizing the project operation stakeholders about gender issues to become
                        more effective in creating access to computer training for the underprivileged. The main
                        research question is whether application of GEM makes a project more effective for the
                        community. For the research work we selected 30 schools as of CLP program starting date for
                        selecting old and new schools, Geographical distribution of schools, Rural-urban schools, girls,
                        boys and coeducation schools. The data gathering strategy was defined after defining the
                        evolution indicators. We collected data by conducting Focus Group Discussion, Observation and
                        case study and interviewed students, teachers, parents by questionnaire fill up. After
                        completing the survey a report had been prepared and submitted the report to APC WNCP and
                        CLP.</p>
                    <p style="text-align: center;">
                        <a class="btn btn-primary btn-lg" data-toggle="modal"
                           data-target="#myModal"><strong>View the Report</strong></a>
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
                    <h4 class="modal-title">INDEPENDENT EVALUATION REPORT</h4>
                </div>
                <div class="modal-body">
                    <object data="/theme/clp/assets/fileupload/news/CLP-Research-Final-Copy.pdf" type="application/pdf"
                            frameborder="0"
                            width="100%" height="600px">
                        <p class="work_para">If you are unable to view the pdf on mobile browser then please click the
                            button below to download the pdf file </p>
                        <p style="text-align: center;"><a class="btn btn-primary btn-lg"
                                                          href="/theme/clp/assets/fileupload/news/CLP-Research-Final-Copy.pdf"><strong>Download
                                    the Report</strong></a></p>
                    </object>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of clp-footer -->
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
