@extends('layouts.website')
@section('title', 'Computer Literacy Center (CLC)')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Computer Literacy Center (CLC)</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Our WORK</a>
                        </li>
                        <li>
                            Computer Literacy Center (CLC)
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
                    <p class="work_para">Digital literacy, computer use and Internet browsing, is essential in today’s
                        world
                        to gain/improve knowledge, communicate, and work efficiently. Digital literacy enables the
                        underprivileged youth to acquire capabilities comparable to those blessed with opportunities in
                        life.
                        CLP introduced Computer Literacy Center (CLC) program in 2004 to enable the underprivileged
                        youth
                        become digital literate. CLC provides hands-on computer and Internet browsing training cost
                        free.
                        A CLC is a computer lab run by trained teacher(s) to provide students with hands-on training.
                        Typically, a CLC is established in an educational institute and is furnished with:
                    </p>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <div style="border: 10px solid #e0e0e345;" id="carousel" class="carousel slide"
                         data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel" data-slide-to="1"></li>
                            <li data-target="#carousel" data-slide-to="2"></li>
                            <li data-target="#carousel" data-slide-to="3"></li>
                            <li data-target="#carousel" data-slide-to="4"></li>
                        </ol>

                        <div class="carousel-inner carousel-zoom">
                            <div class="active item slider-inner-img"><img class="img-responsive"
                                                                           src="{{asset('root/assets/images/slider/clc_slider/clc_slider_1.webp')}}">
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="{{asset('root/assets/images/slider/clc_slider/clc_slider_5.jpg')}}">
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="{{asset('root/assets/images/slider/clc_slider/clc_slider_2.webp')}}">
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="{{asset('root/assets/images/slider/clc_slider/clc_slider_3.webp')}}">
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="{{asset('root/assets/images/slider/clc_slider/clc_slider_4.webp')}}">
                            </div>

                        </div>

                        <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <br>
            <div class=row>
                <div class="card-columns literacy-columns">
                    <div class="card partner-items literacy mrg">
                        <div class="text-col">
                            <div class="inner work_para">
                                <ul>
                                    <li>Minimum of four new HP/Dell laptop or desktop computers with 18.5-inch
                                        monitors
                                    </li>
                                    <li>One printer</li>
                                    <li>Internet Modem and other computer peripherals</li>
                                    <li>Trained teacher(s)</li>
                                    <li>Structured curriculum</li>
                                    <li>Teachers’ guide</li>
                                    <li>One-year maintenance contract</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End of partner-items -->
                </div>
                <div class=" col-xs-12">
                    
                    <div class="card-columns literacy-columns">
                        <div class="card partner-items literacy mrg">
                            <div class="text-col">
                                <div class="inner work_para">
                                    <ul>
                                        <li>Course Hour = 40</li>
                                        <li>Class Duration = 1.5 hours</li>
                                        <li>Number of Class = 26</li>
                                        <li>Number of Students per Batch = 8-12. <br>
                                        (Based on number of computers; two students per computer</li>
                                        <li>Curriculum: "Esho Computer Shiki"</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="history-wrap ">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">In consultation with prominent computer scientists and educators in Bangladesh
                        an
                        introductory curriculum was developed. Based on that curriculum a student’s manual, “Esho
                        Computer
                        Shikhi” (Let Us Learn about Computers) in Bengali was published. Every student receives a copy
                        of
                        the manual at a nominal cost. Teacher(s) from each CLC receive intensive training provided by
                        professionals, CLP’s implementation partner in Bangladesh. The teacher(s) are also
                        provided
                        with complete “Teacher’s Manual” so that upon completing their training they can teach the
                        students.
                        The student manual, teacher’s manual and the curricula were updated as needed. The third edition
                        of
                        “Esho Computer Shikhi” was published 2018.
                    </p>
                    <p class="work_para">After completion of each training course, the students are awarded a literacy
                        certificate and the teacher will receive 1200-1500 Taka as incentive payment for completing a
                        training course. Each CLC is expected to complete 7 to 8 training courses per year.</p>
                </div>

            </div>
        </div>
    </section>
    <section class="sponsorship-wrap ">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p><img src="{{asset('root/assets/images/clc/esho.jpg')}}" alt="img" class="img-responsive"/></p>
                </div>
                
                <div class="col-xs-12">
                    <p><img src="{{asset('root/assets/images/clc/clc-certificate.jpg')}}" alt="img" class="img-responsive"/></p>
                </div>
                
                <div class="col-xs-12">
                    <p class="work_para">The school computer teacher conducts computer classes per the national
                        curriculum
                        in the CLC lab allowing student’s exposure to hardware.</p>
                    <p class="work_para">CLP maintains all hardware in operation and ensures that the digital literacy
                        curriculum is implemented in all CLCs for the first year and, in subsequent years, will provide
                        the
                        same service to all CLCs where the sponsor shares 50% of the maintenance cost, costing the
                        sponsor
                        USD 300 per year. The maintenance service includes:</p>
                    <div style="padding-left: 30px;" class="text-col">
                        <div class="inner work_para">
                            <ul>
                                <li>Site visit at least once in a calendar year.</li>
                                <li>Telephone call at least once a month to review status (school is encouraged to call
                                    Dnet
                                    immediately when they need help).
                                </li>
                                <li>Troubleshoot and resolve hardware issues as required.</li>
                                <li>Distribute graduation certificate and Teacher honorarium.</li>
                                <li>Provide needed supports to keep the CLC operational.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="history-wrap ">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p class="work_para">Maintenance support does not include key hardware replacement; however, CLP has
                        been sharing 2/3 of the replacement cost. This major equipment replacement cost sharing is
                        subject
                        to availability of funds.</p>
                </div>
                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">Starting in 2005, CLP has established {{ $general->total_clc_count ?? 00 }} CLCs (and 97
                        associate
                        CLCs) in {{ $general->districts ?? 00 }} districts of Bangladesh; have produced around {{ $general->number_of_graduates }} digital literacy graduates, ~
                        {{ $general->female_percentage }}
                        of those being females, and trained {{ $general->num_of_trained_teachers }} teachers. Annually 100,000 students use the digital
                        literacy Center and Smart Classroom established by CLP.
                    </p>
                    <p class="work_para">CLP establishes CLC in partnership with a sponsor, who pays ~2/3 of the cost.
                        CLP
                        enables the sponsor to give back to his community. He/she can choose a school anywhere in
                        Bangladesh
                        to establish the CLC. His donation is honored with plaque posted at the entrance of the lab and
                        he
                        would be able to dedicate it in the name of a beloved person.
                    </p>
                    <p class="work_para">
                        Taking advantage of the strong digital literacy foundation provided by the CLC, CLP has
                        introduced
                        the Smart Class Room (SCR), Education through Entertainment (EE), Connect Students Around the
                        World
                        (CSAW), and Remote Volunteer Teaching, RVT programs to improve education quality of the
                        underprivileged students.
                    </p>
                    <div class="card-columns literacy-columns">
                        <div class="card partner-items literacy mrg">
                            <div class="text-col">

                            </div>
                        </div>
                        <!-- End of partner-items -->
                    </div>
                </div>

                <div class="col-sm-5 col-xs-12">
                    <p><img src="{{asset('/root/uploads/school_image/map.jpg')}}" alt="img"
                            class="img-responsive"/></p>
                </div>
            </div>
        </div>
    </section>

    <!-- End of history-wrap -->

    <section class="our-partners-wrap ">
        <div class="container literacy-container">
            <div class="card-columns">
                <div class="card partner-items literacy">
                        <div class="img-col">
                            <h4>{{ $general->total_clc_count }}</h4>
                            <p>Computer Learning Centers established in Bangladesh to date.</p>
                        </div>
                </div>
                <div class="card partner-items literacy">
                    <div class="img-col">
                        <h4>{{ $general->number_of_graduates }}</h4>
                        <p>students have successfully completed the 40 hours course.</p>
                    </div>
                </div>
                <!-- End of partner-items -->
            </div>
            <div class="card-columns literacy-columns">
                <div class="card partner-items literacy mrg">
                    <div class="img-col">
                        <h4>${{ $general->clc_sponsorship_price }}</h4>
                        <p>is the total cost for establishing one Computer Literacy Center with a desktop computer.</p>
                    </div>
                    <div class="text-col">
                        <div class="inner">
                            <h4>For this we include:</h4>
                            <ul class="work_para">
                                <li>Four new brand laptop or desktop computers</li>
                                <li>One printer</li>
                                <li>Internet Modem and other computer peripherals</li>
                                <li>Structured curriculum</li>
                                <li>Teachers’ guide</li>
                                <li>Training of one teacher</li>
                                <li>Incentive remuneration for teachers with every month activity</li>
                                <li>One-year maintenance contract</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End of partner-items -->
            </div>
        </div>
    </section>
    <section class="sponsorship-wrap ">
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
                        <a href="sponsor_a_clc.htm" class="thm-btn">Sponsor a CLC</a>
                    </p>
                    <p class="work_para"><strong>For the list of schools with sponsored CLCs, <a href="https://clpweb.org/schoolinfo" class="learn-more">Learn More</a>.</strong></p>
                                
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p><img src="{{asset('root/assets/images/clc/barishal-plaque.jpg')}}" alt="img" class="img-responsive">
                    </p>
                    <p class="work_para">Example of plaque onsite at a CLC.</p>
                </div>
            </div>
        </div>
    </section>
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
    @include('website.partials.actions')
@endsection
