<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP page generated from the original CLP theme (Source_code/theme/education-entertainment.html).
// Rendered as a self-contained page that matches the original theme exactly.

require_once(__DIR__ . '/config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/education-entertainment.php');
$PAGE->set_title('Education Through Entertainment');
$PAGE->set_heading('Education Through Entertainment');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Education Through Entertainment</title>
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
                <h1>Education Through Entertainment</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Our WORK</a>
                        </li>
                        <li>
                            Education Through Entertainment (EE)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="education-through-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">Education through Entertainment (EE) is a new initiative of the Computer
                        Literacy Program that leverages the computer and multimedia facilities at the Computer Literacy
                        Centers (CLCs) and/or Smart Class Rooms (SCRs) to provide students with an entertaining platform
                        for acquiring knowledge. The objectives of the program are to instill knowledge and values, such
                        as tolerance, global awareness, environmental conscientiousness, entrepreneurship in students,
                        as well as to sharpen student’s communication skills through entertaining co-curricular
                        activities.</p>

                    <p class="work_para">Launched in 2016, the initiative was run as a pilot project in five schools
                        with SCRs. While we expect the scope and format of EE to evolve, in the current form it involves
                        use of engaging video(s) to draw students’ attention to interesting and important topics. The
                        topics intended to be covered and eventually collected in the EE content library may belong to
                        diverse areas, such as, general knowledge, science, literature, arts, nature, history,
                        geography, environment, personalities, current issues and events, health, medicine,
                        entrepreneurship to name a few.</p>
                </div>

                <div class="col-sm-5 col-xs-12">
                    <p class="work_para">Table 1.0. The content page of the current version of the CD listing the
                        contents and relevant features.</p>
                    <img src="/theme/clp/assets/images/education-through-entertainment/contentimage.jpg"
                         alt="img"
                         class="img-responsive"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <p class="work_para">The first step in the EE project involves selection of contents in the
                        above-mentioned areas. The videos pertaining to different contents are currently adapted from
                        those available in the open sources, such as, existing videos, You Tube, Internet, websites,
                        etc. In the pilot phase of the project, following 26 sessions were assembled: Visit Beautiful
                        Places in Bangladesh, Language Movement, Life Story of Bill Gates, Balanced Diet, We’ll Protect
                        Ourselves, Be Kind, How to Succeed, Environmental Conservation, Apocalyptic Natural Disaster,
                        Facts About Elephant, Global Fresh Water Challenge, and Do What You are Good at, Build Good
                        Habits, and Gain Wisdom from Stories. These video pieces, adapted from different open sources
                        have been organized in a CD (see Table 1.0).</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <p class="work_para">The topics and videos received enthusiastic acceptance from students and
                        teachers during the pilot project. Since then, the following 12 pieces have been added to the EE
                        repertoire: Rules and Manners, Unity, Physical Exercise, Wasfia’s Journey, Our Universe,
                        Tornado, Thunderstorm and Hail, Flood Safety, Earthquake Safety, Entrepreneurship, Cleanliness,
                        Active Listening, and Climate Change. Table 2.0 provides a complete list of contents developed
                        to date.</p>

                    <p class="work_para">Even a casual look at the above list of contents will reveal the intent of the
                        EE initiative. The piece entitled Language Movements provides a glimpse of the pivotal event in
                        our history; Balanced Diet is a lesson in food for good health; Global Fresh Water Challenge
                        draws attention to the importance of water in sustaining life and need for preserving this
                        precious resource; Build Good Habits, Be Kind, and Gain Wisdom from Stories are geared towards
                        self-improvement and developing moral values; Life Story of Bill Gates is an inspirational story
                        of what an entrepreneurial individual can accomplish from humble beginning, and so on.</p>

                    <p class="work_para">The next important step is presenting the above-mentioned contents to students.
                        Here a student-club model, such as, that of a debating society, or a science club has been
                        adopted. The EE project activity is organized in structured sessions. An EE session covers two
                        regular class periods (approximately 90 minutes). Typically, a session is run on a Thursday
                        after the regular classes are over. In a typical session one (or depending on the length, two)
                        videos are shown to students. Each video is accompanied by a lesson plan to guide the teacher on
                        how to conduct the session and steer students’ activities and discussions. After playing the
                        video(s), the teacher opens the floor for discussion on the topic(s) covered by the video
                        presentation. The optimization of students’ participation in the discussion, so that everyone
                        (as opposed to enthusiastic few) gets involved is emphasized, and the Lesson Plan provides
                        specific suggestions to that end. The discussions among the students are steered so that they
                        understand the intended teachings and develop action plans to translate their learning into
                        practice as appropriate. Students from classes VI through X are expected to benefit from the EE
                        Sessions.</p>

                    <p class="work_para">The anticipated benefits of this program include: (a) Providing an engaging and
                        enjoyable learning environment; (b) fostering listening and comprehension skills; (c) imparting
                        knowledge, building moral values and awareness through entertainment; and (d) sharpening
                        communication skills through participatory discussions.</p>

                    <p class="work_para">The EE project is still in its early stages of development. Present activities
                        include: (a) Improvement of initial 26 sessions with feedback from the pilot trials; (b)
                        Developing a second CD to include the other 12 sessions with corresponding lesson plans (and/or,
                        develop of a composite CD that includes all 26 videos and sessions); and (c) Implement the
                        project in other schools with CLC and/or SCR, which includes training teachers, providing the CD
                        with lesson plan, and monitoring progress.</p>

                    <p class="work_para">We are optimistic about the value and impact of the EE project. This optimism
                        derives from the reception that the EE Pilot phase has received.</p>
                </div>
            </div>
            <div class="section-title center extr-mrg-top">
                <h2>Education Through <span class="thm-color">Entertainment Name List</span></h2>
            </div>

            <div class="col-sm-12 col-xs-12">
                <h3 class="subtitle ">Beautiful Bangladesh</h3>
                <br>
                <p class="work_para">These resources show off the beautiful country of Bangladesh</p>
            </div>
        </div>
    </section>
    <!-- End of education-through-wrap -->

    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url(/theme/clp/assets/images/fact-counter-bg.jpg);">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div
                        style="background: url(/theme/clp/assets/images/education-through-entertainment/eecover2.png)"
                        class="about-video">
                        <a href="https://youtu.be/hRWYZNA_NJo" class="gallery_video">
                            <img src="/theme/clp/assets/images/play.svg" alt="youtube"/>
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Incredibly Beautiful Bangladesh - The School of Life [Full Version]</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of introduction-wrap -->
    <section class="education-through-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h3 class="subtitle">Language Movement</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- End of education-through-wrap -->

    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url(/theme/clp/assets/images/fact-counter-bg.jpg);">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="about-video"
                         style="background: url(/theme/clp/assets/images/education-through-entertainment/eecover1.png">
                        <a href="https://www.youtube.com/watch?v=FRoa1v6_ZQY" class="gallery_video">
                            <img src="/theme/clp/assets/images/play.svg" alt="youtube"/>
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>History of Shahid Minar 21 February</h2>
                            <h5 class="next-note">Next: Documentary International Mother Language Day</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of introduction-wrap -->

    <section class="education-through-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h3 class="subtitle mrg-top-remove">Life Story of Bill Gates</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- End of education-through-wrap -->

    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url(/theme/clp/assets/images/fact-counter-bg.jpg);">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="about-video"
                         style="background: url(/theme/clp/assets/images/education-through-entertainment/eecover3.png">
                        <a href="https://www.youtube.com/watch?v=t8mvgmO5XUE" class="gallery_video">
                            <img src="/theme/clp/assets/images/play.svg" alt="youtube">
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Life Story of Bill Gates - Documentary Bengali</h2>
                            <h5 class="next-note">Next: Bill Gates Speech at Harvard Part 1 - [English sub]</h5>
                        </div>
                    </div>
                </div>
                <!-- End of welcome-content -->
            </div>
        </div>
    </section>
    <!-- End of introduction-wrap -->

    <section class="education-through-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <p class="work_para">NOTE: There are several other sections of videos included on this page:
                        Balanced Diet, We’ll Protect Ourselves, Be Kind, Failure is the Pillar of Success, Environmental
                        Conservation, Apocalyptic Natural Disaster, Elephants are Smart, Global Fresh Water Crisis.
                        Follow the same pattern exemplified in the three resource lists above.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of education-through-wrap -->
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
