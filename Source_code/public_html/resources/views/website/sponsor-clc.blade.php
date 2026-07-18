@extends('layouts.website')
@section('title', 'Sponsor a Computer Literacy Center (CLC)')

@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Be a Sponsor</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Get Involved</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Be a Sponsor</a>
                        </li>
                        <li>
                            Sponsor a Computer Literacy Center (CLC)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="row">
                <div class="col-sm-12 col-xs-12 amazonSmile-left donate">
                    <h4 class="mrg-top-remove">Sponsor a <a href="{{ route('website.clcTeaching') }}">Computer Literacy
                            Center
                            (CLC)</a> today!</h4>
                    <p class="work_para">You can sponsor a
                        <a href="{{ route('website.clcTeaching') }}">
                            <u>Computer Literacy Center (CLC) </u>
                        </a>
                        at your favorite childhood school
                        or any other school of your choice. We ask donors to pledge to finance at least 75% of the cost.
                        We’ll take care of all the details, and you’ll get a plaque onsite to recognize the donor and to
                        memorialize a chosen person by the donor. Read on for more information about what is included in
                        each option.</p>
                    <p class="work_para">*Your donation may be considered US tax-deductible.</p>
                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                            data-target="#collapseWidthDetails" aria-expanded="false"
                            aria-controls="collapseWidthDetails">
                       Know More
                    </button>
                    <div class="collapse width mt-5" id="collapseWidthDetails">
                        <div class="row sponsor-clc-scr">
                            <div class="col-sm-12 col-xs-12">
                                <div class="inner clc">
                                    <h4>Sponsor a CLC for <strong>${{ $general->clc_sponsorship_price }}
                                        </strong> and bring the following resources to your selected school:
                                    </h4>
                                    <ul class="work_para">
                                        <li>Four new brand laptop computers/desktops</li>
                                        <li>One printer</li>
                                        <li>Internet Modem and other computer peripherals</li>
                                        <li>Teachers’ guide & training</li>
                                        <li>Teaching with structured curriculums of "Esho Computer Shiki" book</li>
                                        <li>Incentive remuneration for teachers with every month activity for 12 months*
                                        </li>
                                        <li>One-year maintenance contract</li>
                                    </ul>
                                    <p style="color: white" class="work_para notes">*<i>Teacher remuneration and
                                            equipment
                                            maintenance will continue if
                                            the donor continues to support center maintenance by donating $350/year.</i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4>CLC Online Pledge Form</h4>
                    <p style="text-align: right; font-size: small;"><i>* marked fields are required</i></p>
                    <div class="row donation-form">
                        <!--form starts here-->
                        <div class="row donation-form">
                            @include('website.form.sponsor-form', ['formAction' => route('sponsor.mail')])
                        </div>
                    </div>
                    <!--form ends here-->
                    <div class="row donation-form">
                        <div class="col-sm-8 col-xs-12">
                            <p class="after-clicking work_para">After clicking this button, PayPal will give you the
                                option
                                to continue with PayPal or pay with a credit card.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of amazonSmile-wrap -->

    <!--<section class="amazonSmile-ftr-banner">-->
    <!--    <div class="container-fluid cstm-padd">-->
    <!--        <div class="row">-->
    <!--            <div class="col-sm-12 col-xs-12 cstm-padd">-->
    <!--                <img src="assets/images/amazonSmile-ftr-banner-img.png" alt="img" class="img-responsive">-->
    <!--            </div>                     -->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- End of amazonSmile-ftr-banner -->

    <!-- End of clp-footer-Copyright -->

    <!-- Scroll Top  -->
    <button class="scroll-top tran3s"><span class="fa fa-angle-up"></span></button>

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
    <!-- End of search-popup -->
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
                                    to
                                    CLP</strong></p>

                            <div class="row">
                                <div class="col-sm">
                                    <div
                                        style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px;">
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
    @include('website.partials.actions')
@endsection
