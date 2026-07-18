@extends('layouts.website')
@section('title', 'CLP | Impact')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Impact</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">About Us</a>
                        </li>
                        <li>
                            Impact
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="sec-padd impact-count-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12 impact-count-item">
                            <div class="inner">
                                <h5></h5>
                                <h4>{{ $general->total_clc_count ?? 00 }} <span>Computer Literacy Centers</span></h4>
                                <h6>established in Bangladesh.</h6>
                                <p>Updated {{ $general->last_updated_time ?? 00}}</p>
                            </div>
                            <a href="https://clpweb.org/clc-teaching" class="learn-more">Learn More</a>
                        </div>
                        <div class="col-sm-6 col-xs-12 impact-count-item">
                            <div class="inner">
                                <h5></h5>
                                <h4>{{ $general->total_scr_count ?? 00 }} <span>Smart Class Rooms</span></h4>
                                <h6>established in Bangladesh.</h6>
                                <p>Updated {{ $general->last_updated_time ?? 00 }}</p>
                            </div>
                            <a href="https://clpweb.org/smart-class-room" class="learn-more">Learn More</a>
                        </div>
                        <div class="col-sm-6 col-xs-12 impact-count-item">
                            <div class="inner">
                                <h5></h5>
                                <h4>97 <span>Associate Centers</span></h4>
                                <h6>established in Bangladesh.</h6>
                                <p>Updated {{ $general->last_updated_time ?? 00 }}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 impact-count-item red">
                            <div class="inner">
                                <h5>Our centers have a presence in</h5>
                                <h4>{{ $general->districts ?? 00 }} <span>Districts</span></h4>
                                <h6>across the country!</h6>
                                <p>Updated {{ $general->last_updated_time ?? 00 }}</p>
                            </div>
                        </div>
                    </div>

                    <p class="work_para">This work is made possible by donors like you who have chosen to sponsor a <a
                            href="{{asset('clc-teaching')}}">Computer Literacy Center (CLC)</a> or a <a
                            href="{{asset('smart-class-room')}}">Smart Class Room (SCR)</a>. Learn more about how you
                        can sponsor a center or classroom at your favorite childhood school or any other school of your
                        choice.</p>

                    <div class="impact_sponsor_holder">
                        <div style="padding:5px;">
                            <a style="background-color: #0e0e0e; border-color: #0e0e0e;" href="sponsor_a_clc.htm"
                               class="btn btn-primary">Sponsor a CLC</a>
                        </div>

                        <div style="padding:5px;">
                            <a style="background-color: #5f914e; border-color: #5f914e;" href="sponsor_a_scr.htm"
                               class="btn btn-info">Sponsor a SCR</a>
                        </div>

                        <div style="padding:5px;">
                            <a style="background-color: #a1a044; border-color: #a1a044;" href="sponsor_a_tokai.htm"
                               class="btn btn-warning">Sponsor a Tokai-CLC</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <p><img src="{{asset($general->map)}}" alt="img" class="img-responsive"></p>
                    <p class="work_para">Map shows the locations of Centers and Classrooms.
                        Updated {{ $general->last_updated_time ?? 00 }}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of impact-count-wrap -->

    <section class="introduction-wrap growth fact-counter-2 sec-padd">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="about-video">
                        <a target="_blank" href="https://youtu.be/sVbyg0O5JPs" class="gallery_video">
                            <img src="{{asset('root/assets/images/play.svg')}}" alt="">
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Growth & Expansion</h2>
                            <ul class="work_para">
                                <li>Increase Interest & Enthusiasm</li>
                                <li>Increase Success rate at secondary exam</li>
                                <li>More students enrolled in computer course</li>
                                <li>Enrollment increase in school with a CLC</li>
                                <li>Increase efficiency at school</li>
                                <li>Leverage computers to teach other subjects</li>
                                <li>Career opportunities for CLP graduates</li>
                                <li>Students from different institutions trained at CLCs</li>
                            </ul>
                            <a href="donate-online" class="thm-btn">DONATE NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of introduction-wrap -->

    <section class="impact-count-wrap">
        <div class="container">
            <div class="section-title center extr-mrg">
                <h2>Instructors <span class="thm-color">Trained</span></h2>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <span class="qt work_para">“Esho Computer Shikhi”</span>
                    <span class="qt text-right work_para">“Let Us Learn Computers”</span>

                    <div class="impact-count-blk">
                        <h4>{{ $general->num_of_trained_teachers ?? 00 }}</h4>
                        <p class="work_para">teachers have been trained to teach in CLCs and SCRs.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p style="font-size: 15px;" class="work_para">An introductory curriculum was developed in
                        consultation with computer scientists, based on which a student’s manual, “Esho Computer Shikhi”
                        (Let Us Learn Computers), has been published. Two teachers from each CLC receive two weeks of
                        intensive training from professionals. We also provided with a “teacher’s manual.”</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <h4 class="qt">The Program</h4>
                    <p class="work_para">Class Room Operation four subject based curriculum on English and General
                        Science for grade VI-VIII & Geography and Geometry for grade IX-X was developed in consultation
                        with subject based specialist. Four teachers from each SCR receive four days of intensive
                        training from professionals.</p>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p><img src="{{asset('root/assets/images/impact/SCR.png')}}" alt="img" class="img-responsive mrg-top"></p>
                    <p class="work_para">ToT for Smart Class Room Operation </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7 col-xs-12 clc-stands">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="stand-inner-col">
                                <h1>617</h1>
                                <h5>computer teachers have been trained.</h5>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="stand-inner-col brd-none">
                                <h1>25%</h1>
                                <h5>of computer teachers trained are women.</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5 col-xs-12">
                    <p class="impact-thm-btn"><a href="donate-online" class="thm-btn">DONATE NOW</a></p>
                </div>
            </div>

            <div class="section-title center extr-mrg">
                <h2>Students <span class="thm-color">Graduated</span></h2>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <p><img src="{{asset('root/assets/images/impact/w2.png')}}" alt="img" class="img-responsive"></p>
                    <p class="img-caption work_para">Students at computer class in a <a href="clc-teaching">CLC</a>.</p>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p class="for-each work_para">For each batch of students, CLCs send a list of students who
                        successfully completed the 40 hours course. Based on this list, we issues certificates
                        of appreciations to the CLCs for the students. A batch usually consists of eight to ten
                        students.</p>

                    <div class="impact-count-blk left-mrg">
                        <h4>{{ $general->number_of_graduates }}</h4>
                        <p class="work_para">students have successfully completed the 40 hours course.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <h4 class="qt cumulative">Cumulative Students Graduated as of May 2014: Girls and Boys</h4>
                    <p class="impact_count_img_holder"><img src="{{asset('root/assets/images/impact/Chart.png')}}" alt="img"
                                                            class="img-responsive"></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <img src="{{asset('root/assets/images/impact/w1.png')}}" alt="img" class="img-responsive mrg-top">
                    <p class="work_para">The SCR teachers get trained on how to effectively teach four of the main
                        subjects of class six to ten which are English Grammar, Mathematics, Science, and Geography.
                        They also get training on the pedagogical sides of teaching-learning along with the most
                        effective ways of using the technologies available into the classroom.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of impact-count-wrap -->
    @include('website.partials.actions')
@endsection
