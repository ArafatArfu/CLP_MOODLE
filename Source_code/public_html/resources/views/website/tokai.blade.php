@extends('layouts.website')
@section('title', 'Sponsor-a-Tokai-CLC')
@section('content')
    <!-- End of theme_menu -->
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Sponsor-a-Tokai(টোকাই)-CLC</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Our WORK</a>
                        </li>
                        <li>
                            Sponsor-a-Tokai(টোকাই)-CLC
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
                    <p class="work_para">CLP (Computer Literacy Program) for underprivileged youth provides <a
                            href="{{ route('website.clcTeaching') }}">CLC (Computer Literacy Center)</a> to allow
                        students to receive digital literacy training through a structured curriculum. These centers are
                        established with two-thirds support from a sponsor enabling him/her to give back to the
                        underprivileged students of his/her community. CLP also ensures smooth operation of the CLC on
                        an on-going basis when the sponsor pays 50% (USD 300) of the yearly operation cost ($600.00).
                    </p>
                    <p class="work_para">Starting in 2005, CLP has built {{ $general->total_clc_count }} CLCs to date.
                        Out of these, {{ $general->total_supportedcenter_count }} centers are being supported by the
                        sponsors and CLP is ensuring smooth operation of these centers to produce digitally literate
                        graduates when schools are in session. The unsupported centers remained uncared for and
                        gradually ceased digital literacy training program. We are dubbing each unsupported CLC, as a
                        <strong>‘Tokai (টোকাই) CLC’</strong>. All <strong>‘Tokai’</strong> CLCs are identified on the <a
                            href="{{route('website.schoolInfo')}}" target="_blank">CLP website</a>.</p>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <p>
                        <img src="{{asset('root/assets/images/tokai/tokai.webp')}}" alt="img" class="img-responsive"/>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="history-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <div class="card-columns literacy-columns">
                        <div class="card partner-items literacy mrg">
                            <div class="img-col">
                                <h4>${{ $general->tokai_sponsorship_price }}</h4>
                                <p style="font-size: 15px">is the total cost for sponsoring a Tokai(টোকাই) Center. CLP
                                    also expects annual $300 maintenance support to ensure full operation year over
                                    year. <br></p>
                            </div>
                            <div class="text-col">
                                <div class="inner">
                                    <h4>For this we include:</h4>
                                    <ul class="work_para">
                                        <li>Rejuvenate a 'Tokai' CLC center</li>
                                        <li>Resurrect a computer lab with more than 4 computers</li>
                                        <li>Introduce structured Digital Literacy training</li>
                                        <li>Provide teacher training and the Teachers’ Guide</li>
                                        <li>Provide incentive remuneration to CLP teacher after completion of a batch
                                            training
                                        </li>
                                        <li>One-year maintenance contract</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End of partner-items -->
                    </div>
                </div>
                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">We recognize that these centers still retain limited capabilities to reinitiate
                        CLP’s digital literacy curriculum. As a result, CLP has introduced a new opportunity called
                        ‘Sponsor-a-Tokai CLC’ for a sponsor to bring these abandoned CLCs to lively operation condition
                        again.
                    </p>
                    <p class="work_para">A sponsor can pick an abandoned CLC from the <a
                            href="{{route('website.schoolInfo')}}" target="_blank">CLP website</a> or CLP would be able
                        to choose one or more CLCs according to guidance from a potential sponsor.
                    </p>

                    <div class="card-columns literacy-columns">
                        <div class="card partner-items literacy mrg">
                            <div class="text-col">
                            </div>
                        </div>
                        <!-- End of partner-items -->
                    </div>
                </div>

    </section>

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
                        <a style="max-width: 300px" href="{{route('website.sponsorTokai')}}" target="_blank"
                           class="thm-btn">Sponsor a
                            Tokai CLC</a>
                    </p>
                    <p class="work_para"><strong>For the list of Tokai CLCs, <a target="_blank"
                                                                                href="{{route('website.schoolInfo')}}">click
                                here</a>.</strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p><img src="{{'root/assets/images/clc/plaque-clc.jpg'}}" alt="img" class="img-responsive"></p>
                    <p class="work_para">Example of plaque onsite at a CLC.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of our-partners-wrap -->
    @include('website.partials.actions')
@endsection
