@extends('layouts.website')
@section('title')
    Mission
@endsection
<!-- End of top-bar -->
@section('content')
    <!-- End of theme_menu -->
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Mission</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">About Us</a>
                        </li>
                        <li>
                            Mission
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="call-out mission-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="statement-inner">
                        <h4>Empowering underprivileged youths through  computer literacy training and technology-aided education. </h4>
                        <span class="statement-innert"><b>CLP MISSION STATEMENT</b></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of call-out -->

    <section class="introduction-wrap fact-counter-2 sec-padd" style="background-image: url(/root/assets/images/introduction-bg.png);">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <iframe width="560" height="420" src="https://www.youtube.com/embed/Y3LUfsUeGCg?rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Computer Literacy Program: An Introduction</h2>
                            <p class="we-belong">Computer Literacy Program Volunteers for the Underprivileged (CLP) has spent {{date("Y")-2005}} years building and running <a href="{{asset('clc-teaching')}}">Computer Literacy Centers (CLCs)</a>  to develop a model for computer literacy of the underprivileged youths in rural Bangladesh. Listen to our dedicated team  explain the CLP mission and why we do it.</p>
                            <a href="donate-online" class="thm-btn">DONATE NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of introduction-wrap -->

    <section class="mission-wrap sec-padd">
        <div class="container">
            <div class="section-title center extr-mrg">
                <h2>Who We <span class="thm-color">Focus On</span></h2>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <p class="work_para">Our primary focus is on youths because they are the future. They learn fast, take risk, and can transform societies.</p>
                </div>
            </div>

            <div class="section-title center extr-mrg">
                <h2>What <span class="thm-color"> We Do</span></h2>
            </div>
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <ul class="work_para">
                        <li>Establish Computer Literacy Centers (CLCs) to provide access to and promote usage of computers in education free of charge to students</li>
                        <li>Establish Smart Class Rooms (SCRs) for multi-media instruction of educational contents</li>
                        <li>Train teachers who in turn can teach students </li>
                        <li>Develop and adapt educational contents that complement and enhance the curricula the students follow</li>
                        <li>Provide access to Internet and wood wide web where available </li>
                        <li>Provide help and support for maintaining and upgrading the computers and related resources </li>
                        <li>Develop dynamic school websites to provide online access to stakeholders and to allow parents to connect with the school through mobile phones.</li>
                    </ul>
                    <p class="work_para">In order to achieve the above, we raise funds and seek support from individuals and institutions.</p>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <p><img src="{{ asset('root/assets/images/mission/mission_1.webp') }}" alt="img" class="img-responsive" /></p>
                </div>
            </div>

            <div class="section-title center extr-mrg">
                <h2>Where We <span class="thm-color">Operate</span></h2>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <p class="work_para">Our primary area of operation is high schools. However, the model is applicable to any educational institution in an underprivileged community. </p>
                </div>
            </div>

            <div class="section-title center extr-mrg">
                <h2>Why We <span class="thm-color">Do It</span></h2>
            </div>
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">Computer is the key educational tool of the information age. Computers and Information Technology are revolutionizing how we learn, work, communicate, socialize, and organize. Computer is today's book, paper, pen, and lob tool.</p>
                    <p class="work_para">Internet is the information and knowledge source of the day. Multimedia and interactive instruction facilitates learning much better than traditional lecture-based instruction. The new technology can play the role of 'great equalizer' making information and knowledge base accessible to any remote corner of the world that is digitally connected.</p>
                    <p class="work_para">On the other hand, lack of access to these resources can push individuals and societies backwards. Our aim is to help alleviate the "digital divide' that exists between youths in developing and developed nations, and between well-to-do and underprivileged students of the same society by making computers and other resources of information technology accessible. Given the access, youths can excel, and transform their lives and societies.</p>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <p><img src="{{ asset('root/assets/images/mission/mission_2.webp') }}" alt="img" class="img-responsive" /></p>
                </div>
            </div>

            <div class="section-title center extr-mrg">
                <h2>CLP <span class="thm-color">Presentation</span></h2>
            </div>
            <p><a href="{{ asset('root/fileupload/event-presentation/CLP%202015-Event-Presentation.pdf') }}"><strong>CLP EVENT-PRESENTATION-2015, CLICK TO DOWNLOAD</strong></a></p>
            <p><a href="{{ asset('root/fileupload/event-presentation/CLP%202016-Event-Presentation.pdf') }}"><strong>CLP EVENT-PRESENTATION-2016, CLICK TO DOWNLOAD</strong></a></p>
            <p><a href="{{ asset('root/fileupload/event-presentation/CLP%202017-Event-Presentation.pdf') }}"><strong>CLP EVENT-PRESENTATION-2017, CLICK TO DOWNLOAD</strong></a></p>
        </div>
    </section>
    <!-- End of mission-wrap -->
    @include('website.partials.actions')
@endsection
