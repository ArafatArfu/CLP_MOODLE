@extends('layouts.website')
@section('title', 'CLP | Smart Class Room')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Smart Class Room (SCR)</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">OUR WORK</a>
                        </li>
                        <li>
                            Smart Classroom (SCR)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="SCRs-cont-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <p class="work_para">In 2009, CLP introduced Smart Class Room (SCR) concept to bring the educational
                        opportunities provided by advances in personal computers, Internet, educational CDs, and
                        ICT-based interactive learning materials to secondary school students in rural Bangladesh. In a
                        SCR, students learn through the use of interactive educational CDs and the Internet. Every SCR
                        is equipped with a laptop, a large screen television, an IPS or Solar, and interactive CDs. The
                        students learn using these educational CDs and the Internet. These audio-visual and interactive
                        learning materials enhance students’ learning experience, and serve as useful tools for
                        teachers.</p>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <div id="carousel" style="border: 10px solid #e0e0e345;" class="carousel slide"
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
                                                                           src="{{asset('root/assets/images/slider/scr_slider/scr_slider_1.webp')}}"
                                                                           alt="img"/>
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="{{asset('root/assets/images/slider/scr_slider/scr_slider_2.jpg')}}"
                                                                    alt="img"/>
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="{{asset('root/assets/images/slider/scr_slider/scr_slider_3.webp')}}"
                                                                    alt="img"/>
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="{{asset('root/assets/images/slider/scr_slider/scr_slider_4.webp')}}"
                                                                    alt="img"/>
                            </div>

                            <div class="item slider-inner-img"><img class="img-responsive"
                                                                    src="{{asset('root/assets/images/slider/scr_slider/scr_slider_5.webp')}}"
                                                                    alt="img"/>
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

            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <p><img src="{{asset('root/assets/images/scr/Table1.jpg')}}" alt="img" class="img-responsive"/></p>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <p class="work_para">While it is desirable to teach every subject in a SCR, the initial focus was on
                        four subjects: Everyday English, Geography, Mathematics and Science. This is because
                        student-experience-sensitive educational CDs were available on those subjects. However, the need
                        and demand for contents and lesson plans that can accompany the NCTB (National Curriculum and
                        Textbook Board) curricula for different grade levels was always high. In 2011 the CLP
                        arranged a workshop for selected high school teachers to seek their input on the topical areas
                        that they would prefer to teach using multi-media contents. With feedback from participants in
                        the workshop, multimedia contents consisting of an assortment of videos, animated games, flash
                        animations and power-point slides were developed with the help of experts for nine NCTB books
                        covering four subjects and English Grammar for different grade levels (detailed in the table
                        below).</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <div class="row scrs-data-row">
                        <div class="col-sm-4 col-xs-12 item per30">
                            <h4>13</h4>
                            <p>June-2020 –June 2021</p>
                        </div>
                        <div class="col-sm-4 col-xs-12 item per60">
                            <h4>14</h4>
                            <p>June-2019 –June 2020</p>
                        </div>
                        <div class="col-sm-4 col-xs-12 item per100">
                            <h4>19</h4>
                            <p>June-2018 –June 2019</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <div class="impact-count-blk teachers">
                        <h4>{{ $general->total_scr_count }}</h4>
                        <p>Smart Class Rooms established in Bangladesh to date.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End of SCRs-cont-wrap -->

    <section class="table-cont-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <p class="work_para">Later, the National Curriculam and the text books were revised and a good
                        portion of the originally developed contents did not correlate with the new text books. The need
                        for new contents became apparent. Consequently, a research team from the Institute of Education
                        and Research (IER) of the University of Dhaka was consulted in 2015 to map out the existing NCTB
                        books and determine how many modules originally developed in 2011 were still useable and
                        delineate the need for new modules. Guided by this need analysis the team produced the required
                        new multimedia teaching modules (some developed in-house and most others adapted from open
                        source)</p>
                </div>
                <div class="col-sm-8 col-xs-12">
                    <p><img src="{{asset('root/assets/images/scr/Table2.jpg')}}" alt="img" class="img-responsive"/></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of table-cont-wrap -->

    <section class="content-disk-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <p class="content-disk-img"><img src="{{asset('root/assets/images/scr/SCR-Content-Disk.png')}}"
                                                     alt="img"
                                                     class="img-responsive"/></p>
                </div>
                <div class="col-sm-6 col-xs-12 team-also">
                    <div class="inner">
                        <p class="work_para">The team also developed detailed step-by-step lesson plans for each period
                            for each of the nine subjects to guide the teachers on how to conduct the class and to
                            communicate with the students. Some lesson plans contain more-than-one multimedia content
                            and some do not contain any. A computer CD containing teaching contents encompassing four
                            regular subjects covering multiple classes as well as lesson plans for each textbook as
                            described in the table has been produced for use by the teachers. This CD (pictured right)
                            was mailed in 2016 to all schools with SCRs. CLP also trains the teachers to browse Internet
                            and collect contents from the open sources and /or prepare teaching content themselves in
                            the PowerPoint.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of content-disk-wrap -->

    <section class="our-partners-wrap sec-padd">
        <div class="container literacy-container">
            <div class="card-columns literacy-columns">
                <div class="card partner-items literacy mrg">
                    <p class="work_para">Recently CLP developed a plan to expanded the SCR with appropriate hardware to
                        include remote conferencing and/or volunteering capabilities allowing introduction of two new
                        programs (Connect Students Around the World and the Remote Volunteering Teaching) for overall
                        development of the underprivileged students.</p>
                    <div class="img-col">
                        <h4>${{ $general->scr_sponsorship_price }}</h4>
                        <p>is the total cost for establishing one Smart Class Room.</p>
                    </div>
                    <div class="text-col">
                        <div class="inner work_para">
                            <h4>For this we include:</h4>
                            <ul>
                                <li>A 55 inch or larger LED Smart TV in the classroom</li>
                                <li>IPS (for the monitor) for uninterrupted power</li>
                                <li>A laptop with extended-charge battery</li>
                                <li>Interactive CDs for English, Geometry, Geography and Science lessons</li>
                                <li>Training of the teachers (four or more)</li>
                                <li>One-year maintenance contract</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End of partner-items -->
            </div>
        </div>
    </section>
    <!-- End of our-partners-wrap -->

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
                        <a href="{{route('website.sponsorScr')}}" class="thm-btn">Sponsor a SCR</a>
                    </p>
                    <p class="work_para"><strong>For the list of schools with sponsored SCRs, <a
                                href="{{asset('root/fileupload/List-of-schools-with-sponsored-SCRs.pdf')}}" target="_blank">click
                                here</a>.</strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p><img src="{{asset('root/assets/images/scr/sponsor-scr.jpg')}}" alt="img" class="img-responsive">
                    </p>
                    <p class="work_para">Example of plaque onsite at a SCR.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of sponsorship-wrap -->
    @include('website.partials.actions')
@endsection
