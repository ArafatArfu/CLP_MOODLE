@extends('layouts.website')
@section('title', 'CLP | Donate By Mail')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Donate By Mail</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Get Involved</a>
                        </li>
                        <li>
                            Donate By Mail
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
                <div class="col-sm-12 col-xs-12 amazonSmile-left">
                    <p class="work_para">We rely on your donations for essentials like maintaining the technical field
                        support team and subsidizing the establishment of new computer literacy centers. You can donate
                        any amount by mail at the following address. You will receive a tax receipt for your donation in
                        the mail.</p>

                    <p class="work_para">CLP <br/>
                        6 Tharp Lane<br/>
                        Marlboro, NJ 07746, USA</p>
                    @include('website.partials.donation-links')
                </div>
            </div>
        </div>
    </section>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <p style="margin:30px 0;"><strong
                                    style="color: #00140F; font-size: 24px; line-height: 32px; font-weight: bold;">Donate
                                    to CLP</strong></p>
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
