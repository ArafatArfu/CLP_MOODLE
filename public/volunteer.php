<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP page generated from the original CLP theme (Source_code/theme/volunteer.html).
// Rendered as a self-contained page that matches the original theme exactly.

require_once(__DIR__ . '/config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/volunteer.php');
$PAGE->set_title('CLP | Volunteer');
$PAGE->set_heading('CLP | Volunteer');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>CLP | Volunteer</title>
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
                <h1>Be a Volunteer or Intern with CLP</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">BE A VOLUNTEER</a>
                        </li>
                        <li>
                            Volunteer
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
                    <p class="extr-mrg-btm work_para">CLP invites you to participate in various volunteer opportunities.
                        You can join the volunteer team on a physical or virtual assignment.Computer Literacy Program
                        Volunteers for Underprivileged (CLP) is an organization of the volunteers, by the volunteers,
                        for the underprivileged. Adult and young (young adult and teen) volunteers play complementary
                        roles in designing, developing, and executing the programs and activities to further the CLP
                        mission to empower underprivileged youths through computer literacy training and
                        technology-enhanced education.</p>
                    <p>
                        <a class="read-more" data-toggle="collapse" href="#collapseExample" role="button"
                           aria-expanded="false" aria-controls="collapseExample">
                            Read More
                        </a>
                    </p>

                    <div class="volunteers-collapes collapse" id="collapseExample" aria-expanded="true" style="">
                        <h4><strong>Adult volunteers:</strong></h4>
                        <p class="work_para">help design and develop programs; facilitate field implementation of those
                            programs, monitor established programs and suggest improvements, support office activities
                            and seek new directions. They also engage in publicity and fund raising. Some are involved
                            in distant instruction, such as, teaching a science course in a rural school in Bangladesh
                            from a living room in the US. CLP seeks new adult volunteers to sustain and expand its
                            activities.</p>
                        <h4><strong>Young volunteers:</strong></h4>
                        <p class="work_para">help with different CLP activities while developing their volunteering
                            experience and credentials. Currently they help with publicity and organization of fund
                            raising events. They make phone calls to invite guests to CLP events, manage the
                            registration desk, decorate the venue, and support activities associated with the annual
                            fund raising event. Some young volunteers are involved in enhancing CLP’s social media
                            (Facebook, website, etc.) presence. Some volunteers are teaching students in remote long
                            distance classes. Opportunities exist for developing contents for CLP programs, such as,
                            Education through Entertainment. CLP has options for college students interested in
                            conducting educational projects in Bangladesh. CLP encourages new ideas and initiatives from
                            volunteers. To sum up, CLP seeks young volunteers to help with annual events, distant
                            instruction, website editing, managing social media publicity, organizing mini fund raising
                            events, and conducting educational projects abroad.To recognize the contribution of young
                            volunteers CLP provides certificates for volunteering hours accumulated by a volunteer. CLP
                            is a certifying organization for President’s Volunteer Service Award (PVSA) Program* since
                            2019. This program specially recognizes those who spend more time and efforts. The
                            requirements that the PVSA sets for different achievement levels for the Teen and Young
                            Adult volunteers are shown in the Table below.</p>
                        <h4><strong>Volunteering hours required in a calendar year to earn awards in each age
                                group:</strong></h4>
                        <p class="work_para">
                        <table class="tblpage">
                            <tr>
                                <th>Age Group</th>
                                <th>Bronze</th>
                                <th>Silver</th>
                                <th>Gold</th>

                            </tr>
                            <tr>
                                <td>Teens (11–15 years)</td>
                                <td>50–74 hours</td>
                                <td>75–99 hours</td>
                                <td>100+ hours</td>
                            </tr>
                            <tr>
                                <td>Young Adults (16–25 years)</td>
                                <td>100–174 hours</td>
                                <td>175–249 hours</td>
                                <td>250+ hours</td>
                            </tr>
                        </table>
                        </p>
                        <p class="work_para">
                            *To find out more about PVSA, please visit: <a
                                href="https://www.presidentialserviceawards.gov/eligibility"></a>https://www.presidentialserviceawards.gov/eligibility.
                            <br>
                            ** (CLP) is a 501c (3)US charity organization<br>
                            If you are interested in joining our volunteer team, please contact vabnj@hotmail.com or
                            submit a form below. Thank you for your very kind gesture.
                        </p>

                    </div>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <p><h5 class="work_para"><b>Adult volunteers:</b></h5> help design and develop programs;
                            facilitate field implementation of those programs, monitor established programs and suggest
                            improvements, support office activities and seek new directions. They also engage in
                            publicity and fund raising. Some are involved in distant instruction, such as, teaching a
                            science course in a rural school in Bangladesh from a living room in the US. CLP seeks new
                            adult volunteers to sustain and expand its activities.
                            <h5 class="work_para"><b>Young volunteers:</b></h5> help with different CLP activities while
                            developing their volunteering experience and credentials. Currently they help with publicity
                            and organization of fund raising events. They make phone calls to invite guests to CLP
                            events, manage the registration desk, decorate the venue, and support activities associated
                            with the annual fund raising event. Some young volunteers are involved in enhancing CLP’s
                            social media (Facebook, website, etc.) presence. Some volunteers are teaching students in
                            remote long distance classes. Opportunities exist for developing contents for CLP programs,
                            such as, Education through Entertainment. CLP has options for college students interested in
                            conducting educational projects in Bangladesh. CLP encourages new ideas and initiatives from
                            volunteers. To sum up, CLP seeks young volunteers to help with annual events, distant
                            instruction, website editing, managing social media publicity, organizing mini fund raising
                            events, and conducting educational projects abroad.To recognize the contribution of young
                            volunteers CLP provides certificates for volunteering hours accumulated by a volunteer. CLP
                            is a certifying organization for President’s Volunteer Service Award (PVSA) Program* since
                            2019. This program specially recognizes those who spend more time and efforts. The
                            requirements that the PVSA sets for different achievement levels for the Teen and Young
                            Adult volunteers are shown in the Table below.
                            <h5 class="work_para">Volunteering hours required in a calendar year to earn awards in each
                                age group:</h5>
                            <br>
                            <table class="tblpage">
                                <tr>
                                    <th>Age Group</th>
                                    <th>Bronze</th>
                                    <th>Silver</th>
                                    <th>Gold</th>

                                </tr>
                                <tr>
                                    <td>Teens (11–15 years)</td>
                                    <td>50–74 hours</td>
                                    <td>75–99 hours</td>
                                    <td>100+ hours</td>
                                </tr>
                                <tr>
                                    <td>Young Adults (16–25 years)</td>
                                    <td>100–174 hours</td>
                                    <td>175–249 hours</td>
                                    <td>250+ hours</td>
                                </tr>
                            </table>
                            <br>
                            <p>
                                *To find out more about PVSA, please visit: <a
                                    href="https://www.presidentialserviceawards.gov/eligibility">presidential service
                                    awards eligibility</a>
                                <br>
                                ** (CLP) is a 501c (3)US charity organization<br>
                                If you are interested in joining our volunteer team, please contact vabnj@hotmail.com or
                                submit a form below. Thank you for your very kind gesture.</p>
                        </div>
                    </div>
                    <h4>Volunteer Form</h4>
                    

                    <form method="post" action="">
                        

                        <p style="text-align: right; font-size: small;"><i>* marked fields are required</i></p>
                        <div class="row donation-form">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="first_name" class="form-control" required
                                           placeholder="First Name*" onfocus="this.placeholder=''"
                                           onblur="this.placeholder='First Name*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="last_name" class="form-control" required
                                           placeholder="Last Name*" onfocus="this.placeholder=''"
                                           onblur="this.placeholder='Last Name*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="address_one" class="form-control" required
                                           placeholder="Address 1*" onfocus="this.placeholder=''"
                                           onblur="this.placeholder='Address 1*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="address_two" class="form-control" placeholder="Address 2"
                                           onfocus="this.placeholder=''" onblur="this.placeholder='Address 2'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="city" class="form-control" required placeholder="City*"
                                           onfocus="this.placeholder=''" onblur="this.placeholder='City*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="state" class="form-control" required
                                                   placeholder="State*" onfocus="this.placeholder=''"
                                                   onblur="this.placeholder='State*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="zip" class="form-control" required
                                                   placeholder="Zip*" onfocus="this.placeholder=''"
                                                   onblur="this.placeholder='Zip*'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="country" class="form-control" placeholder="Country*"
                                           required onfocus="this.placeholder=''" onblur="this.placeholder='Country*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" required placeholder="Email*"
                                           onfocus="this.placeholder=''" onblur="this.placeholder='Email*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone*" required
                                           onfocus="this.placeholder=''" onblur="this.placeholder='Phone'">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <textarea name="message" rows="6" class="form-control textarea"
                                              placeholder="Comments (Optional)" onfocus="this.placeholder=''"
                                              onblur="this.placeholder='Comments (Optional)'"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="examplecheck"
                                           id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Subscribe me to the email list
                                        so that I hear about upcoming events, volunteer opportunities, latest success
                                        stories and more.</label>
                                </div>
                            </div>

                            <h4>Verification</h4>
                            <div class="row donation-form">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="please-label">Please enter any two digits *</label>
                                        <input type="text" name="example" class="form-control" placeholder="Example: 12"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Example: 12'"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="row donation-form">
                                <div class="col-sm-4 col-xs-12">
                                    <button type="submit" class="read-more">Submit</button>
                                </div>
                                <div class="col-sm-8 col-xs-12">
                                    <p class="after-clicking work_para">A member of our volunteer team will reach out to
                                        you
                                        shortly for placement at the right volunteer opportunity for you.</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End of amazonSmile-wrap -->

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
                            <p style="margin:30px 0;"><strong
                                    style="color: #00140F; font-size: 24px; line-height: 32px; font-weight: bold;">Donate
                                    to CLP</strong></p>

                            <div class="row">
                                <div class="col-sm">
                                    <div
                                        style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px;">
                                        <!--  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank"><input name="cmd" type="hidden" value="_s-xclick" /><br /><input name="hosted_button_id" type="hidden" value="9NLRSFG7QPK78" /><input alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                 type="image" style="margin: 0 auto;" /><br /><img src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="" width="1" height="1" border="0" /><p style="color: Black">General-Purpose</p></form> -->
                                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post"
                                              target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick"/>
                                            <input type="hidden" name="hosted_button_id" value="HF57H5DMKZDTA"/>
                                            <input type="image"
                                                   src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                   type="image" style="margin: 0 auto;" border="0" name="submit"
                                                   title="PayPal - The safer, easier way to pay online!"
                                                   alt="Donate with PayPal button"/>
                                            <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif"
                                                 width="1" height="1"/>
                                        </form>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
