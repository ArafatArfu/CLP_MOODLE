@extends('layouts.website')
@section('title', 'CLP | Sponsor a Computer')

@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Sponsor a Computer</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Be a Sponsor</a>
                        </li>
                        <li>
                            Sponsor a Computer
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
                    <h4 class="mrg-top-remove">Send a computer to a CLC today!</h4>
                    <p class="work_para">With your $400 donation, one laptop with core i3 specifications will be
                        provided to a <a href="{{ asset('clc-teaching') }}">Computer Literacy Center (CLC)</a> on your
                        behalf. To show our appreciation, we will engrave your name on the computer.</p>
                    <p class="work_para">You can sponsor a computer by sending a check in the mail or using our online
                        donation form. We accept PayPal and major credit cards. Please send mail to the following
                        address:</p>
                    <p class="work_para">CLP <br/>
                        6 Tharp Lane<br/>
                        Marlboro, NJ 07746, USA</p>

                    <h4>Donation Amount</h4>

                    <div class="row donation-form">
                        <div class="col-sm-4 col-xs-12">
                            <a href="#" class="read-more">$400</a>
                        </div>
                    </div>

                    <h4>Sponsor a Computer Online Pledge Form</h4>
                    <p style="text-align: right; font-size: small;"><i>* marked fields are required</i></p>
                    @include('website.form.sponsor-form', ['formAction' => route('sponsor.mail')])
                </div>
            </div>
        </div>
    </section>
    <!-- End of amazonSmile-wrap -->
    @include('website.partials.actions')
@endsection
