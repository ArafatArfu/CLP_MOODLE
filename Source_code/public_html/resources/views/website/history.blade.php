@extends('layouts.website')
@section('title')
    History
@endsection
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>History</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">About Us</a>
                        </li>
                        <li>
                            History
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
                <div class="col-sm-6 col-xs-12">
                    <p class="work_para">The Computer Literacy Program for Underprivileged (CLP) was originally
                        conceived in 2004 by several Bangladeshis Americans living in New Jersey with the mission of
                        empowering underprivileged youths through computer literacy training and technology-aided
                        improved teaching. CLP was first introduced to donors and recipients as the New Jersey Chapter
                        of the Volunteers Association for Bangladesh (VAB), a New York charity focused on providing
                        improved education to underprivileged secondary school students in Bangladesh. In 2012, CLP grew
                        into an independent US501@ (3) organization.</p>
                    <p class="work_para">Since its beginning, CLP progressively spawned innovative programs to bridge
                        the digital divide between the underprivileged and affluent students and advance their education
                        excellence with the help of modern technology. These programs span from establishing <a
                            href="{{asset('clc-teaching')}}">computer literacy centers (CLCs)</a>, certifying and
                        training instructors, creating educational materials to be consumed digitally, and enabling
                        remote learning opportunities. As of
                        {{ $general->last_updated_time ?? 00 }}
                        , CLP has established {{ $general->total_clc_count ?? 00 }} CLCs
                        ans {{ $general->total_scr_count ?? 00 }} SCRs in 55 districts of Bangladesh. As of
                        {{ $general->last_updated_time ?? "May" }}, CLCs have trained around {{ $general->number_of_graduates ?? 00 }}
                        students, {{ $general->female_percentage ?? 00 }}% of those being females.</p>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <div style="border: 10px solid #f8f8ff;" class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item"
                                src="https://www.youtube.com/embed/xGBxpFrQ7gM?autoplay=0&mute=0"
                                title="YouTube video player"
                                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen='0'></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('website.partials.actions')
@endsection
