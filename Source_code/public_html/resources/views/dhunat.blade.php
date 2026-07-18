@extends('layouts.website')
@section('title', 'Sherpur Project')
@section('content')
    <div style="padding: 90px;" class="modal fade" id="videoModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: black;">
                <div class="modal-body">
                    <iframe style="width: 100%; height: 400px" src="https://www.youtube.com/embed/ulULWW1t3_0"
                            frameborder="0" allowfullscreen>
                    </iframe>
                    <span>
                        <button type="button" class="modal-cls-btn close"
                                data-dismiss="modal">&times;
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
">Sherpur Project</h2>

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
                    <img class="img-responsive"
                         src="{{asset('root/assets/images/homepage/Sherpur/molla-sir-min.jpg')}}"/>
                    <div class="carousel-caption">
                    </div>
                </div>
                <div class="item">
                    <img class="img-responsive" src="{{asset('root/assets/images/homepage/Sherpur/1.jpeg')}}"/>
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

    <section class="here-sherpur-wrap">
        <div class="container">
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
                            <div
                                class="col-md-{{$bootstrapColWidth}} col-sm-{{$bootstrapColWidth}} col-xs-12">
                                <div class="blog-single thumbnail home-thumb"
                                >
                                    <div class="blog-thumb">
                                        @isset($row['school_youtube'])
                                            {!! $row['school_youtube'] !!}
                                        @endisset
                                    </div>
                                    <div class="blog-info" style="padding-bottom:60px">
                                        <h4 class="title">
                                            <a href="https://clpweb.org/schoolinfos_view/{{$row['id']}}">
                                                @isset($row['school_name'])
                                                    {{$row['school_name']}}
                                                @endisset
                                        </h4>
                                        <a href="https://clpweb.org/schoolinfos_view/{{$row['id']}}">
                                            <p class="blog-text"
                                               style="margin-bottom:40px">
                                                @isset($row['school_des'])
                                                    {{$row['school_des']}}
                                                @endisset
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @php
                                $rowCount++;
                                if ($rowCount % $numOfCols == 0) echo '</div><div class="blog-list row" style="margin-top:50px">';
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
                                        <span class="day">20</span>
                                        <span class="month">Mar</span>
                                    </div>
                                    <!--Content and Title-->
                                    <div class="meta-content">
                                        <a href="/sherua">CLP has founded a new CLC and distance teaching enabled smart
                                            classroom at Sherua Adarsha High School, Sherpur, Bogura </a>
                                        <p class="blog-texts">
                                            On March 20, 2022, CLP established a Computer Literacy Center (CLC) and
                                            Distance
                                            Teaching Enabled Smart Classroom at Sherua Adarsha High School located in a
                                            rural
                                            part of Sherpur upazila in Bangladesh's Bogura district to facilitate modern
                                            ICT
                                            education among disadvantaged youth.
                                        </p>
                                    </div>
                                    <div class="meta-thumb date-col">
                                        <span class="day">08</span>
                                        <span class="month">Dec</span>
                                    </div>
                                    <!--Content and Title-->
                                    <div class="meta-content">
                                        <a href="/sherpur">New CLC and SCR established at Sherpur, Bogura </a>

                                        <p class="blog-texts">
                                            For more than sixteen years, CLP has been providing modern computer literacy
                                            to
                                            disadvantaged youth in distant areas of Bangladesh. Along the way, CLP has
                                            established smart classrooms (SCRs) and computer literacy centers (CLCs) in
                                            two
                                            different schools in Sherpur upzila of Bogura district in Bangladesh.
                                        </p>
                                    </div>
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

    <section class="introduction-wrap fact-counter-2 sec-padd" style="background-image: url({{asset('root/assets/images/bg.webp')}});">
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
                            <p class="we-belong work_para" style="font-size: 14px;">Need the short brief of what Molla
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
