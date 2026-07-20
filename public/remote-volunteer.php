<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP page generated from the original CLP theme (Source_code/theme/remote-volunteer.html).
// Rendered as a self-contained page that matches the original theme exactly.

require_once(__DIR__ . '/config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/remote-volunteer.php');
$PAGE->set_title('Remote Voluntary Teaching (RVT)');
$PAGE->set_heading('Remote Voluntary Teaching (RVT)');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Remote Voluntary Teaching (RVT)</title>
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
                <h1>Remote Voluntary Teaching (RVT) </h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Our WORK</a>
                        </li>
                        <li>
                            Remote Voluntary Teaching (RVT)
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
                    <p class="work_para">How effective is remote teaching? How does a remote class experience compare
                        with that of a face-to-face class? These questions have been raised many times from many
                        different pulpits and platforms ever since advances in instructional technology made online,
                        distant instruction feasible; and more so during this pandemic that shut down schools and put
                        in-person classes on hold around the globe. While the jury is still out, one observation is
                        clear that there may be no all-encompassing single answer. Answers to the questions will depend
                        on many factors that include resources of the institution, socio-economic background of the
                        students attending the school, availability of trained teachers and aspects of interpersonal
                        communications.
                    </p>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <p><img src="/theme/clp/assets/images/remote-volunteer/ds2.webp" alt="img"
                            class="img-responsive"/></p>
                </div>
            </div>
        </div>
    </section>

    <section class="history-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <div class="card-columns literacy-columns">
                        <p><img src="/theme/clp/assets/images/remote-volunteer/ds1.webp" alt="img"
                                class="img-responsive"/></p>
                    </div>
                </div>

                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">The Computer Literacy Program (CLP) initiated remote voluntary teaching on a
                        limited scale few years ago. Volunteer teachers from the US and other countries have been
                        teaching primary and high school students in rural Bangladesh. The project uses the
                        infrastructure of a <a href="smart-classroom.php">Smart Class Room (SCR)</a>,
                        with
                        some improvisations, for distant instruction. The experiment has generated considerable interest
                        among students, teachers of those students, parents and volunteers of different age groups eager
                        to teach. This article features the experiences and observations of four individuals engaged in
                        this experiment.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url(/theme/clp/assets/images/fact-counter-bg.jpg);">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="rvt1_video">
                        <a target="_blank" href="https://youtu.be/pqdkhrvmrkA" class="gallery_video">
                            <img src="/theme/clp/assets/images/play.svg" alt="play">
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Shirin Siddiqui talking about CLP and RVT</h2>
                            <p class="description work_para">Shirin Siddiqui, a professor of Chemistry at Elizabeth City
                                State University in North Carolina, shares about her teaching of Chemistry to high
                                school students of the <a href="school-details.html?13"
                                                          target="_blank">Uddipan
                                    Badar-Shamsu Bidya Niketan (UBSBN)</a> at Boitpur, Bagerhat. Not only does she bring
                                her knowledge of chemistry and teaching skills honed over the years to the class, but
                                also her background of growing up in a similar rural setting and her life experience.
                                She naturally becomes a role model for her students.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="history-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="work_para">The objective of each of these classes are teaching grammar, vocabulary,
                            communication, writing, etc. Learning English from native speakers of the language enhances
                            ability of the Bangladeshi students to communicate with peers in the outside world. In
                            addition, the school hosts RVT classes in Chemistry, Physics and Mathematics to students in
                            different grade levels.</p>
                    </div>
                </div>
                <p class="work_para">CLP is pursuing to implement this popular program in additional CLP schools.</p>
            </div>
        </div>
    </section>

    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url(/theme/clp/assets/images/fact-counter-bg.jpg);">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="rvt2_video">
                        <a target="_blank" href="https://youtu.be/FzpQT6Gx33Y" class="gallery_video">
                            <img src="/theme/clp/assets/images/play.svg" alt="">
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Partnership between CLP and FERA Foundation</h2>
                            <p class="description work_para">CLP has developed a professional collaboration relationship
                                with Fera Foundation in 2021.
                                With a synergy between CLP-provided hardware & logistic support and volunteer
                                recruitment by Fera Foundation, it is anticipated that Distance Teaching will be
                                launched at many CLP sponsored <a target="_blank"
                                                                  href="smart-classroom.php">Smart
                                    Classroom
                                    (SCR).</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="history-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="work_para">Nashwaan Ali Khan, a high school senior from Cerritos, California wanted to
                            obtain some volunteering experience as high school students in the US commonly do. His
                            fascinating piece tells how that pursuit made him raise funds to help establish a SCR at an
                            orphanage in Gazipur, organize his friends to participate, bring out the leader in him and
                            of course teach English to the students at the orphanage. He garners a US President's
                            Volunteer Service Award (PVSA) Gold medal for his exemplary activities.</p>
                    </div>
                </div>
                <div class="row">
                    <table class="tblpage work_para">
                        <caption style="text-align:center; font-size: 18px; font-weight:bold;" class="work_para">List of
                            volunteer teachers
                        </caption>
                        <tr>
                            <th>Volunteer Teacher Name</th>
                            <th>Grade Level</th>
                            <th>Class Frequency</th>
                            <th>What Subject</th>
                            <th>Book Title</th>

                        </tr>
                        <tr>
                            <td>Aleaya Hajra, NY City</td>
                            <td>Four</td>
                            <td>Weekly</td>
                            <td>English Story Book</td>
                            <td>The Pied Piper of Hamelin-John Holder (Level 4)</td>

                        </tr>
                        <tr>
                            <td>Keean Saadi, NJ</td>
                            <td>Five</td>
                            <td>Weekly</td>
                            <td>English Story Book</td>
                            <td>Stella & Roy Go Camping-Ashley wolff</td>
                        </tr>
                        <tr>
                            <td>Samhita Tatavarty, NJ</td>
                            <td>SiX + Seveen</td>
                            <td>Weekly</td>
                            <td>English Story Book</td>
                            <td>The Adventures of Sherlock Holmes</td>
                        </tr>
                        <tr>
                            <td>Shroyo Rafiq, Australia</td>
                            <td>Eight</td>
                            <td>Weekly</td>
                            <td>English Grammar</td>
                            <td>Creative Writing</td>
                        </tr>

                        <tr>
                            <td>Nashwaan Ali Khan, NJ, USA</td>
                            <td>Five + Six + Seven</td>
                            <td>Weekly</td>
                            <td>English Story</td>
                            <td>English for Today</td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <div style="margin: 0 auto; text-align: center;">
                            <a style="margin: 0 auto;" href="volunteer.php" target="_blank"
                               class="read-more">Be a Volunteer</a>
                        </div>
                        <br>
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
