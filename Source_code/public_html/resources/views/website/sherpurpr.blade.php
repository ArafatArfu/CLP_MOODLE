@extends('layouts.website')
@section('title', 'Sherpur & Dhunat Project')
@section('pageStyle')
    .blog-single-no-height {
        box-shadow: 0 2px 6px rgb(32 49 45 / 20%);
        padding: 10px;
        border-radius: 5px;
        width: 100%;
        cursor: auto;
    }
@endsection
@section('content')
<div style="padding: 90px;" class="modal fade" id="videoModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: black;">
            <div class="modal-body">
                <iframe style="width: 100%; height: 400px" src="https://www.youtube.com/embed/ulULWW1t3_0"
                    frameborder="0" allowfullscreen>
                </iframe>
                <span>
                    <button type="button" class="modal-cls-btn close" data-dismiss="modal">&times;
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>

<h2 style="
    text-align: center;
    padding: 2%;
    font-size: 35px;
">Sherpur & Dhunat Project</h2>

<div class="container" style="width: 80%;">
    <!--<section class="rev_slider_wrapper">-->
    <div id="carousel" class="carousel slide" data-ride="carousel" style="border: 10px solid #e0e0e345;">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
            <li data-target="#carousel" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="active item">
                <img class="img-responsive" src="{{asset('root/assets/images/homepage/Sherpur/molla-sir-min.jpg')}}" />
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
                <img class="img-responsive" src="{{asset('root/assets/images/homepage/Sherpur/1.jpeg')}}" />
                <div class="carousel-caption">
                    <div class="carouselBtn">
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="img-responsive" src="{{asset('root/assets/images/homepage/Sherpur/s-1.jpg')}}">
                <div class="carousel-caption">
                    <div class="carouselBtn">
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="img-responsive" src="{{asset('root/assets/images/homepage/Sherpur/3.jpeg')}}">
                <div class="carousel-caption">
                    <div class="carouselBtn">
                    </div>
                </div>
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
<!--Texts-->
<div class="container">
    <h4 style="
    text-align: justify;
    padding: 2%;
    font-size: 18px;">
        The “Sherpur Project” is the brainchild of Dr. Molla Fazlul Huq who lived in Sherpur as a child of an
        immigrant
        family in the early fifties. He graduated from DJ High School in 1953 and left Sherpur for higher studies.
        He
        wanted to give back to the community that once supported him and his family. The goal of this project is to
        educate the underprivileged students so that they have an opportunity for fair competition. The objective
        could
        be achieved if these kids are well versed in English, savvy user of the internet, and dominates technology
        well.
        To achieve these goals he facilitated Computer labs, Smart Classrooms, and the internet in schools, and
        facilitated training for the teachers and for the students. The project is implemented by a US-based
        nonprofit
        CLP through its Dhaka partner Dnet. So far 8 schools, 5 high schools and 3 primary schools, joined this
        project.
        Sherpur Project is making commendable advances in introducing digital literacy training and technology-aided
        education programs in school in Sherpur town, district of Bogura, Bangladesh. English is taught via distance
        teaching from the USA. Dr. Molla pulled his personal resources and raised funds from relatives, friends, and
        his
        community.
    </h4>
</div>
<!--Texts-->

<section class="here-sherpur-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="blog-list row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="blog-single-no-height thumbnail home-thumb">
                            <div class="blog-thumb">
                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/QSQ0whodgys" title="Learn to Earn Project" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                            <div class="blog-info" style="padding-bottom:60px">
                                <h4 class="title">
                                   Learn to Earn Project
                                </h4>
                                <h6 class="title">
                                   From Struggle to self sufficiency
                                </h6>
                                <p style="margin-bottom:40px">
                                 Thanks to your support, Sherpur School students have continued their education and achieved excellent exam results; yet many still face institutional barriers to employment. To close this gap, we launched the Learn to Earn Program, which turns top students’ skills into sustainable freelance income.
We interviewed 70 students and selected 15 for an eight-month intensive program. The curriculum included Foundation & Productivity training focused on English communication and core ICT skills (MS Office, Google Workspace, advanced data entry, internet security, and digital ethics), followed by the Freelancing Specialization. Fourteen students, of whom eleven are female, have received platform approvals and are ready to begin professional freelance work while training continues.
A remaining barrier is the digital divide: each graduate needs a laptop, a modem, and reliable high-speed internet—items most cannot afford. Your donation is an investment: graduates will repay equipment costs into a revolving fund as they earn, enabling future cohorts to be equipped. Recruitment and training costs continue, but this model makes each gift multiply over time.
Our goal is $20,000 to provide technology, connectivity, and mentorship for this cohort and to seed the revolving fund. By February 2026, we expect the first cohort to reach financial stability and help launch the next group of Sherpur freelancers.
Join us in creating sustainable careers for Sherpur’s youth. Click the Learn to Earn Program link to watch a short video of the graduating group.
                                </p>
                                <h5>
                                    To donate, click here: <a href="https://www.paypal.com/donate?hosted_button_id=V6D3X44Q434VC" class="btn btn-info">
                                        Paypal
                                    </a>
                                </5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @php
            //Columns must be a factor of 12 (1,2,3,4,6,12)
            $numOfCols = 3;
            $rowCount = 0;
            $bootstrapColWidth = 12 / $numOfCols;
            @endphp
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="blog-list row">
                    @foreach ($data as $row)
                    <div class="col-md-{{$bootstrapColWidth}} col-sm-{{$bootstrapColWidth}} col-xs-12">
                        <div class="blog-single thumbnail home-thumb">
                            <div class="blog-thumb">
                                @isset($row['school_youtube'])
                                {!! $row['school_youtube'] !!}
                                @endisset
                            </div>
                            <div class="blog-info" style="padding-bottom:60px">
                                <h4 class="title">
                                    <a href="https://clpweb.org/school-details?schoolInfo={{$row['id']}}">
                                        @isset($row['school_name'])
                                        {{$row['school_name']}}
                                        @endisset
                                </h4>
                                <a href="https://clpweb.org/school-details?schoolInfo={{$row['id']}}">
                                    <p class="blog-text" style="margin-bottom:40px">
                                        @isset($row['school_des'])
                                        {{ \Illuminate\Support\Str::limit($row['school_des'], 200, '...') }}
                                        @endisset
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    @php
                    $rowCount++;
                    if ($rowCount % $numOfCols == 0) echo '
                </div>
                <div class="blog-list row" style="margin-top:50px">';
                    @endphp
                    @endforeach
                </div>
            </div>

            <!-- left content end -->

            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="sidebar-area">
                    <div class="widget widget-letest-news">
                        <div class="widget-title">
                            <h2>Latest News:</h2>
                        </div>
                        <div class="news-list">

                            <!--news para container-->
                            <div class="blog-info">
                                <div class="meta-thumb date-col">

                                    <span class="day">04</span>
                                    <span class="month">Mar</span>

                                </div>

                                <div class="meta-content">

                                    <a href="#">Counselling Center</a>

                                </div>
                                <br>


                                <div style="border-radius: 15px; overflow: hidden; width: 100%; max-width: 100%; padding-top: 10px;"
                                    ;>
                                    <iframe width="100%"
                                        src="https://www.youtube.com/embed/MQPZVyz_Ccg?si=NcjQg3QEahz_3r_d"
                                        title="Sherpur Project Donated by Mollah Haq" frameborder="0" allowfullscreen>
                                    </iframe>
                                </div>



                                <br>

                                <div class="meta-thumb date-col">
                                    <span class="day">16</span>
                                    <span class="month">Jan</span>
                                </div>


                                <div class="meta-content">

                                    <a href="#">Learn to Earn Project</a>

                                </div>
                                <br>
                                <div style="border-radius: 15px; overflow: hidden; width: 100%; max-width: 100%; padding-top: 10px;">
                                    <iframe width="100%"
                                        src="https://www.youtube.com/embed/NRVWDfmix1M?si=SrAmihSEMzZ00CDs"
                                        title="Learn to Earn" frameborder="0" allowfullscreen>
                                    </iframe>
                                </div>
                                <br>

                                <!--Content and Title-->

                            </div>
                            <a class="read-more" href="latest-news">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of here-bangladesh-wrap -->
<div class="section-title center extr-mrg">
    <h2>Computer <span class="thm-color">Literacy</span></h2>
</div>

<section class="introduction-wrap fact-counter-2 sec-padd"
    style="background-image: url({{asset('root/assets/images/bg.webp')}});">
    <div class="welcome-area ptb--100">
        <div class="container">
            <div class="welcome-content">
                <div class="molla-video">
                    <a class="gallery_video" role="button" data-toggle="modal" data-target="#videoModal">
                        <img src="{{asset('root/assets/images/play.svg')}}" alt="">
                    </a>
                </div>
                <div class="welcome-inner">
                    <div class="blog-info">
                        <h2>Dr. Molla Fazlul Huq is talking about Sherpur Project</h2>
                        <p class="we-belong work_para" style="font-size: 14px;">Need the short brief of what
                            Molla
                            Huq
                            sir highlights or express to the audience</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('website.partials.actions')
@endsection