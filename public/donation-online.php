<?php
// This file is part of Moodle - http://moodle.org/
//
// CLP page generated from the original CLP theme (Source_code/theme/donation-online.html).
// Rendered as a self-contained page that matches the original theme exactly.

require_once(__DIR__ . '/config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/donation-online.php');
$PAGE->set_title('Donate Online');
$PAGE->set_heading('Donate Online');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Donate Online</title>
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
    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 amazonSmile-left donate">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#GiveMonthly">Give Monthly</a></li>
                        <li><a data-toggle="tab" href="#DonateOnce">Donate Once</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="GiveMonthly" class="tab-pane fade in active">
                            <h4 style="Font-size:20px; margin: 0; padding: 0;">Make a monthly donation.</h4>
                            <p class="work_para" style="margin: 0; padding: 0px;">When you make a monthly donation, you
                                are helping create stability in our budget so that we can plan for the future. Monthly
                                donations go into the general donation funds. We accept donations through PayPal and
                                major credit cards.</p>
                            <div class="row">
                                <div style="margin-top: 15px;" class="donate-form-area">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-md-auto">
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div
                                                    style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px; color:black;">
                                                    <h5>All-Purpose</h5><br>
                                                    <p>
                                                        <a href="https://na01.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.paypal.com%2Fdonate%3Fhosted_button_id%3DTLHRWB5UGFECW&data=04%7C01%7C%7Cf24ef802b2da4b07daad08d8bbd824e5%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637465884285128282%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C1000&sdata=rRTVMs1SaMJig5DNQlN4YJduXsaLxadqo7ynOyaopjQ%3D&reserved=0">
                                                            <img style="border: none;" alt="donation"
                                                                 src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                                 class="donate-img"/>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div
                                                    style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px; color:black;">
                                                    <h5>Sherpur Project</h5><br>
                                                    <p>
                                                        <a href="https://na01.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.paypal.com%2Fdonate%3Fhosted_button_id%3DV6D3X44Q434VC&data=04%7C01%7C%7C55db0d88c5c0408b0deb08d8bbd957c2%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637465889434712419%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C1000&sdata=dBM7VYebTlhl%2BD9nki7ERXG9u3ajtdfduu0cNPJHauw%3D&reserved=0">
                                                            <img style="border: none;" alt="donate"
                                                                 src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                                 class="donate-img">
                                                        </a>
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 0 auto; padding-top:10px;">
                                        <p style="font-size: 20px; margin-bottom: 10px; margin-top: 5px; text-align: center;">
                                            Or</p>
                                        <div
                                            style="text-align: center; max-width: 196px; margin: 0 auto; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 10px; line-height: 22px; color:black; font-weight:bold;">
                                            Mail Check payable to CLP, 6 Tharp Lane, Marlboro, NJ07746.
                                        </div>
                                    </div>
                                    <div style="margin: 0 auto; width: 100%; text-align: center; color:black;">
                                        <strong>Tax ID # 46-0646134</strong>
                                    </div>
                                </div>
                            </div>
                            <h4>Donor Information</h4>
                            <div class="row donation-form">
                                

                                <form method="post" action="">
                                    
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <select class="form-control" name="founds">
                                                <option value="general">General Funds</option>
                                                <option value="other">Other Funds</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="other" class="form-control" placeholder="Other"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Other'">
                                        </div>
                                    </div>
                                    <div class="row donation-form">
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="first_name"
                                                       placeholder="First Name*" onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='First Name*'">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="last_name"
                                                       placeholder="Last Name*" onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='Last Name*'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="address_one"
                                                       placeholder="Address 1*" onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='Address 1*'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="address_two"
                                                       placeholder="Address 2" onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='Address 2'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="city" placeholder="City*"
                                                       onfocus="this.placeholder=''" onblur="this.placeholder='City*'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="row">
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="state"
                                                               placeholder="State*" onfocus="this.placeholder=''"
                                                               onblur="this.placeholder='State*'">
                                                    </div>
                                                </div>
                                                <div class="col-sm-8 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="zip"
                                                               placeholder="Zip*"
                                                               onfocus="this.placeholder=''"
                                                               onblur="this.placeholder='Zip*'">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="country"
                                                       placeholder="Country*"
                                                       onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='Country*'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email"
                                                       placeholder="Email*"
                                                       onfocus="this.placeholder=''" onblur="this.placeholder='Email*'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone" placeholder="Phone"
                                                       onfocus="this.placeholder=''" onblur="this.placeholder='Phone'">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                        <textarea name="message" rows="6" class="form-control textarea"
                                                  placeholder="Special Instructions (Optional)"
                                                  onfocus="this.placeholder=''"
                                                  onblur="this.placeholder='Special Instructions (Optional)'"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="examplecheck"
                                                       id="exampleCheck">
                                                <label class="form-check-label work_para" for="exampleCheck">Subscribe
                                                    me to the
                                                    email list so that I hear about upcoming events, volunteer
                                                    opportunities,
                                                    latest success stories and more.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <h4>Verification</h4>
                                    <div class="row donation-form">
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="please-label">Please enter any two digits *</label>
                                                <input type="text" class="form-control" name="example"
                                                       placeholder="Example: 12"
                                                       onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='Example: 12'">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="read-more">Proceed</button>
                                </form>
                            </div>
                            <div id="DonateOnce" class="tab-pane fade">
                                <h4 style="Font-size:20px; margin: 0; padding: 0;">Make a one-time donation.</h4>
                                <p class="work_para" style="Font-Size:2vh; margin: 0; padding: 0px;">Your donation of
                                    any
                                    amount will help us with essentials like maintaining the technical field support
                                    team so
                                    that we can continue to do this work. You may choose to allocate your donation to
                                    the
                                    Sherpur Projects or to the general donation funds. We accept donations through
                                    PayPal
                                    and major credit cards.</p>

                                <!-- <h4>Donation Amount</h4> -->
                                <div style="margin-top: 15px;" class="donate-form-area">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!--<p style="margin:30px 0;"><strong style="color: #00140F; font-size: 24px; line-height: 32px; font-weight: bold;">Donate to CLP</strong></p>-->

                                            <div class="row">
                                                <div class="col-sm-6 col-xs-12">
                                                    <div
                                                        style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px;">
                                                        <h5>All Project</h5>
                                                        <form action="https://www.paypal.com/cgi-bin/webscr"
                                                              method="post"
                                                              target="_blank"><input name="cmd" type="hidden"
                                                                                     value="_s-xclick"/><br/><input
                                                                name="hosted_button_id" type="hidden"
                                                                value="9NLRSFG7QPK78"/><input
                                                                alt="PayPal - The safer, easier way to pay online!"
                                                                name="submit"
                                                                src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                                type="image" style="margin: 0 auto;"/><br/><img
                                                                src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                                                alt="" width="1" height="1" border="0"/></form>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-xs-12">
                                                    <div
                                                        style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px;">
                                                        <h5>Sherpur Project</h5>
                                                        <form action="https://www.paypal.com/cgi-bin/webscr"
                                                              method="post"
                                                              target="_top"><input name="cmd" type="hidden"
                                                                                   value="_s-xclick"/><input
                                                                name="hosted_button_id" type="hidden"
                                                                value="HF57H5DMKZDTA"/><br/><input
                                                                title="PayPal - The safer, easier way to pay online!"
                                                                alt="Donate with PayPal button"
                                                                name="submit"
                                                                src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                                type="image" style="margin: 0 auto;"/><br/><img
                                                                src="https://www.paypal.com/en_US/i/scr/pixel.gif"
                                                                alt=""
                                                                width="1"
                                                                height="1" border="0"/>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin: 0 auto; padding-top:10px;">
                                                <p style="font-size: 20px; margin-bottom: 10px; margin-top: 5px; text-align: center;">
                                                    Or</p>
                                                <div
                                                    style="text-align: center; max-width: 196px; margin: 0 auto; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 10px; line-height: 22px; color:black; font-weight:bold;">
                                                    Mail Check payable to CLP, 6 Tharp Lane, Marlboro, NJ07746.
                                                </div>
                                            </div>
                                            <div style="margin: 0 auto; width: 100%; text-align: center; color:black;">
                                                <strong>Tax ID # 46-0646134</strong>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <h4>Donor Information</h4>
                                <div class="row donation-form">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="First Name*"
                                                   onfocus="this.placeholder=''"
                                                   onblur="this.placeholder='First Name*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Last Name*"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Last Name*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Address 1*"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Address 1*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Address 2"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Address 2'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="City*"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='City*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="State*"
                                                           onfocus="this.placeholder=''"
                                                           onblur="this.placeholder='State*'">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Zip*"
                                                           onfocus="this.placeholder=''"
                                                           onblur="this.placeholder='Zip*'">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Country*"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Country*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Email*"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Email*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Phone"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Phone'">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <textarea name="form_message" rows="6" class="form-control textarea"
                                                  placeholder="Special Instructions (Optional)"
                                                  onfocus="this.placeholder=''"
                                                  onblur="this.placeholder='Special Instructions (Optional)'"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Subscribe me to the
                                                email
                                                list so that I hear about upcoming events, volunteer opportunities,
                                                latest
                                                success stories and more.</label>
                                        </div>
                                    </div>
                                </div>
                                <h4>Verification</h4>
                                <div class="row donation-form">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="please-label">Please enter any two digits *</label>
                                            <input type="text" class="form-control" placeholder="Example: 12"
                                                   onfocus="this.placeholder=''"
                                                   onblur="this.placeholder='Example: 12'">
                                        </div>
                                    </div>
                                </div>
                                <div class="row donation-form">
                                    <div class="col-sm-4 col-xs-12">
                                        <a href="#" class="read-more">Proceed to PayPal</a>
                                    </div>
                                    <div class="col-sm-8 col-xs-12">
                                        <p class="after-clicking work_para">After clicking this button, PayPal will give
                                            you
                                            the option to continue with PayPal or pay with a credit card.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of tab-content -->
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
