<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP page generated from the original CLP theme (Source_code/theme/smart-classroom.html).
// Rendered as a self-contained page that matches the original theme exactly.

require_once(__DIR__ . '/config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/smart-classroom.php');
$PAGE->set_title('CLP | Smart Class Room');
$PAGE->set_heading('CLP | Smart Class Room');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>CLP | Smart Class Room</title>
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
                <h1>Smart Class Room (SCR)</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">OUR WORK</a>
                        </li>
                        <li>
                            Smart Classroom (SCR)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="SCRs-cont-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <p class="work_para">In 2009, CLP introduced Smart Class Room (SCR) concept to bring the educational
                        opportunities provided by advances in personal computers, Internet, educational CDs, and
                        ICT-based interactive learning materials to secondary school students in rural Bangladesh. In a
                        SCR, students learn through the use of interactive educational CDs and the Internet. Every SCR
                        is equipped with a laptop, a large screen television, an IPS or Solar, and interactive CDs. The
                        students learn using these educational CDs and the Internet. These audio-visual and interactive
                        learning materials enhance students’ learning experience, and serve as useful tools for
                        teachers.</p>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <div id="carousel" style="border: 10px solid #e0e0e345;" class="carousel slide"
                         data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel" data-slide-to="1"></li>
                            <li data-target="#carousel" data-slide-to="2"></li>
                            <li data-target="#carousel" data-slide-to="3"></li>
                            <li data-target="#carousel" data-slide-to="4"></li>
                        </ol>

                        <div class="carousel-inner carousel-zoom">
                            <div class="active item slider-inner-img"><img class="img-responsive"
                                                                           src="/theme/clp/assets/images/slider/scr_slider/scr_slider_1.webp"
                                                                           alt="img"/>
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="/theme/clp/assets/images/slider/scr_slider/scr_slider_2.jpg"
                                                                    alt="img"/>
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="/theme/clp/assets/images/slider/scr_slider/scr_slider_3.webp"
                                                                    alt="img"/>
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="/theme/clp/assets/images/slider/scr_slider/scr_slider_4.webp"
                                                                    alt="img"/>
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="/theme/clp/assets/images/slider/scr_slider/scr_slider_5.webp"
                                                                    alt="img"/>
                            </div>

                        </div>

                        <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <p><img src="/theme/clp/assets/images/scr/Table1.jpg" alt="img" class="img-responsive"/></p>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <p class="work_para">While it is desirable to teach every subject in a SCR, the initial focus was on
                        four subjects: Everyday English, Geography, Mathematics and Science. This is because
                        student-experience-sensitive educational CDs were available on those subjects. However, the need
                        and demand for contents and lesson plans that can accompany the NCTB (National Curriculum and
                        Textbook Board) curricula for different grade levels was always high. In 2011 the CLP
                        arranged a workshop for selected high school teachers to seek their input on the topical areas
                        that they would prefer to teach using multi-media contents. With feedback from participants in
                        the workshop, multimedia contents consisting of an assortment of videos, animated games, flash
                        animations and power-point slides were developed with the help of experts for nine NCTB books
                        covering four subjects and English Grammar for different grade levels (detailed in the table
                        below).</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <div class="row scrs-data-row">
                        <div class="col-sm-4 col-xs-12 item per30">
                            <h4>13</h4>
                            <p>June-2020 –June 2021</p>
                        </div>
                        <div class="col-sm-4 col-xs-12 item per60">
                            <h4>14</h4>
                            <p>June-2019 –June 2020</p>
                        </div>
                        <div class="col-sm-4 col-xs-12 item per100">
                            <h4>19</h4>
                            <p>June-2018 –June 2019</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <div class="impact-count-blk teachers">
                        <h4></h4>
                        <p>Smart Class Rooms established in Bangladesh to date.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End of SCRs-cont-wrap -->

    <section class="table-cont-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <p class="work_para">Later, the National Curriculam and the text books were revised and a good
                        portion of the originally developed contents did not correlate with the new text books. The need
                        for new contents became apparent. Consequently, a research team from the Institute of Education
                        and Research (IER) of the University of Dhaka was consulted in 2015 to map out the existing NCTB
                        books and determine how many modules originally developed in 2011 were still useable and
                        delineate the need for new modules. Guided by this need analysis the team produced the required
                        new multimedia teaching modules (some developed in-house and most others adapted from open
                        source)</p>
                </div>
                <div class="col-sm-8 col-xs-12">
                    <p><img src="/theme/clp/assets/images/scr/Table2.jpg" alt="img" class="img-responsive"/></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of table-cont-wrap -->

    <section class="content-disk-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <p class="content-disk-img"><img src="/theme/clp/assets/images/scr/SCR-Content-Disk.png"
                                                     alt="img"
                                                     class="img-responsive"/></p>
                </div>
                <div class="col-sm-6 col-xs-12 team-also">
                    <div class="inner">
                        <p class="work_para">The team also developed detailed step-by-step lesson plans for each period
                            for each of the nine subjects to guide the teachers on how to conduct the class and to
                            communicate with the students. Some lesson plans contain more-than-one multimedia content
                            and some do not contain any. A computer CD containing teaching contents encompassing four
                            regular subjects covering multiple classes as well as lesson plans for each textbook as
                            described in the table has been produced for use by the teachers. This CD (pictured right)
                            was mailed in 2016 to all schools with SCRs. CLP also trains the teachers to browse Internet
                            and collect contents from the open sources and /or prepare teaching content themselves in
                            the PowerPoint.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of content-disk-wrap -->

    <section class="our-partners-wrap sec-padd">
        <div class="container literacy-container">
            <div class="card-columns literacy-columns">
                <div class="card partner-items literacy mrg">
                    <p class="work_para">Recently CLP developed a plan to expanded the SCR with appropriate hardware to
                        include remote conferencing and/or volunteering capabilities allowing introduction of two new
                        programs (Connect Students Around the World and the Remote Volunteering Teaching) for overall
                        development of the underprivileged students.</p>
                    <div class="img-col">
                        <h4>$</h4>
                        <p>is the total cost for establishing one Smart Class Room.</p>
                    </div>
                    <div class="text-col">
                        <div class="inner work_para">
                            <h4>For this we include:</h4>
                            <ul>
                                <li>A 55 inch or larger LED Smart TV in the classroom</li>
                                <li>IPS (for the monitor) for uninterrupted power</li>
                                <li>A laptop with extended-charge battery</li>
                                <li>Interactive CDs for English, Geometry, Geography and Science lessons</li>
                                <li>Training of the teachers (four or more)</li>
                                <li>One-year maintenance contract</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End of partner-items -->
            </div>
        </div>
    </section>
    <!-- End of our-partners-wrap -->

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
                        <a href="sponsor-scr.php" class="thm-btn">Sponsor a SCR</a>
                    </p>
                    <p class="work_para"><strong>For the list of schools with sponsored SCRs, <a
                                href="/theme/clp/assets/fileupload/List-of-schools-with-sponsored-SCRs.pdf" target="_blank">click
                                here</a>.</strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p><img src="/theme/clp/assets/images/scr/sponsor-scr.jpg" alt="img" class="img-responsive">
                    </p>
                    <p class="work_para">Example of plaque onsite at a SCR.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of sponsorship-wrap -->
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
