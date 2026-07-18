@extends('layouts.website')
@section('title', 'CLP | News Coverage')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>News Coverage</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">News</a>
                        </li>
                        <li>
                            News Coverage
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End of inner-banner -->
    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            <div class="row row-eq-height">
                <h2 style="text-align: center; padding-bottom: 1em;">Print Media</h2>
                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/ny_prothomalo.png')}}" alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> 11 Oct 2020 <i
                                    class="fa fa-newspaper-o"></i> PROTHOM ALO, NY CITY</p>
                            <p><h4>CLP ANNUAL EVENT NEWS</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/Prothom-Alo-Published-Link.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/prothom_alo_2.png')}}" alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> 24 Dec 2019 <i
                                    class="fa fa-newspaper-o"></i> PROTHOM ALO</p>
                            <p><h4>‘I’M IMPRESSED COMING HERE</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/Prothom-Alo-artical-24.12.2019-B.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/thikana.png')}}" alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> 19 Feb 2010 <i
                                    class="fa fa-newspaper-o"></i> Thikana</p>
                            <p><h4>5 YEARS’ DEVELOPMENT PROGRESS OF COMUTER LITERACY PROGRAM, ZAFAR BILLAH</h4></p>
                            <p style="text-align: center; margin: 10px;"><a href="{{asset('root//fileupload/news/Article-Thikana.pdf')}}"
                                                                            class="btn btn-primary newsBtn"
                                                                            role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/forum.png')}}" alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> Sep 2009 <i
                                    class="fa fa-newspaper-o"></i> FORUM MAGAZINE, THE DAILY STAR (VOL 3, ISSUE 9) </p>
                            <p><h4>GOING DIGITAL, SWAPAN KUMAR GAYEN</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/CLP-The-Daily-Star-Forum_Sep_2009.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/digitallearning.png')}}" alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> Oct 2008 <i
                                    class="fa fa-newspaper-o"></i> DIGITAL LEARNING (VOL 4, ISSUE 10)</p>
                            <p><h4>TRANSFORMING RURAL BANGLADESH, ANIR & AJOY</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/Article-on-CLP_Published-by-CSDMS_India_Oct08.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/janakantha.png')}}" alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> Sep 2008 <i
                                    class="fa fa-newspaper-o"></i> DAILY JANAKANTHA</p>
                            <p><h4>COMPUTER LITERACY, SWAPAN KUMAR GAYEN</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/An-Article-on-CLP_Daily-Janakantha.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/unsesco.png')}}" alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> Oct 2007 <i
                                    class="fa fa-newspaper-o"></i> UNESCO</p>
                            <p><h4>EXTENDING COMPUTER TRAINING TO ALL IN BANGLADESH</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/Article-on-CLP-Published-by-UNESCO_Bangkok.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/dailystar2.png')}}" alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> 09 Sept 2007 <i
                                    class="fa fa-newspaper-o"></i> THE DAILY STAR</p>
                            <p><h4>COMPUTER LITERACY PROGRAM: AN INNOVATIVE APPROACH FOR SPREADING IT TO RURAL
                                BANGLADESH, SWAPAN & FARRUKH</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/S-8-Daily-Star-Article.pdf')}}" class="btn btn-primary newsBtn"
                                    role="button">Read More</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url({{asset('root/assets/images/fact-counter-bg.jpg')}});">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="newsCover-video">
                        <a href="https://youtu.be/SanxUItfZrg" class="gallery-video">
                            <img src="{{asset('root/assets/images/play.svg')}}" alt="">
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Smart Classroom Establishment, ATN News</h2>
                            <p class="description work_para">CLP USA, in collaboration with the Govt, established the
                                first Smart Classroom in Bangladesh at Alhaj Jamal Uddin Adarsha High School, Dhamrai,
                                Dhaka in 2011.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of introduction-wrap -->

    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            <div class="row row-eq-height">
                <h2 style="text-align: center; padding-bottom: 1em;">Articles</h2>
                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/subha.png')}}" alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> 2015</p>
                            <p><h4>Success Story of Subha Mandal</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/SUCCESS-STORY-OF-SUBHA-MANDAL.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/FROM-GURUGHIRA-TO-SMART-CLASSROOMS.png')}}"
                             alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> Oct 2010 <i
                                    class="fa fa-user-circle"></i> Swapan Kumar Gayen</p>
                            <p><h4>From Gurughira to Smart Classrooms: Technology Shapes Education</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/FROM-GURUGHIRA-TO-SMART-CLASSROOMS.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/GLIMPSES-OF-E-EDUCATION-AT-UDDIPAN.png')}}"
                             alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> June 2010 <i
                                    class="fa fa-user-circle"></i> Asas-Uz-Zaman</p>
                            <p><h4>Glimpses of e-Education at Uddipan Badar-Shamsu Bidya Niketon</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/Article-Thikana.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/ICT-&-SCR-IN-VICTORIA-HIGH-SCHOOL.png')}}"
                             alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-user-circle"></i> Ayan Chowdhury </p>
                            <p><h4>ICT & SCR in Victoria High School (Bangla)</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/ICT-&-SCR-IN-VICTORIA-HIGH-SCHOOL.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/COMPUTER-LITERACY-PROGRAM-TRANSFORMING-RURAL.png')}}"
                             alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> Sep 2008 <i
                                    class="fa fa-user-circle"></i> ANIR & AJOY</p>
                            <p><h4>Computer Literacy Program: Transforming Rural Bangladesh One School at a
                                Time</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/COMPUTER-LITERACY-PROGRAM-TRANSFORMING-RURAL.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/WOULD-YOU-BELIEVE.png')}}" alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> Mar 2008 <i
                                    class="fa fa-user-circle"></i> Dalilur Rahman</p>
                            <p><h4>Would You Believe? A Computer Literacy Center at Shailan Surma High School?</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/WOULD-YOU-BELIEVE.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/A-VISIT-TO.png')}}" alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> Jan 2008 <i
                                    class="fa fa-user-circle"></i> Musaddeq Hussain</p>
                            <p><h4>A visit to ‘Surovi’- a CLC</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/A-VISIT-TO.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/COMPUTER-LEARNING-CENTERS.png')}}"
                             alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> Jun 2006 <i
                                    class="fa fa-user-circle"></i> Anir Chowdhury</p>
                            <p><h4>Computer Learning Centers: Today and Tomorrow</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/COMPUTER-LEARNING-CENTERS.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="thumbnail newsCard">
                        <img style=" width: 100%; height: 200px; object-fit: cover;"
                             src="{{asset('root/assets/images/news-coverage/COMPUTER-LITERACY-PROGRAM-FIRST.png')}}"
                             alt="...">
                        <div class="caption">
                            <p class="newsDate"><i class="fa fa-calendar"></i> Jul 2010 <i
                                    class="fa fa-user-circle"></i> Zafar & Farrukh</p>
                            <p><h4>Computer Literacy Program: First Five Years of Progress</h4></p>
                            <p style="text-align: center; margin: 10px;"><a
                                    href="{{asset('root/fileupload/news/COMPUTER-LITERACY-PROGRAM-FIRST.pdf')}}"
                                    class="btn btn-primary newsBtn" role="button">Read More</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            <div class="row row-eq-height">
                <h2 style="text-align: center; padding-bottom: 1em;">Research Paper</h2>
                <div style="display: flex;align-content: center;justify-content: space-around;">
                    <div class="col-sm-12 col-md-6 col-xs-12">
                        <div class="thumbnail newsCard">
                            <img style=" width: 100%; height: 200px; object-fit: cover;"
                                 src="{{asset('root/assets/images/news-coverage/research_cover.png')}}" alt="...">
                            <div class="caption">
                                <p class="newsDate"><i class="fa fa-calendar"></i> 2015 <i
                                        class="fa fa-user-circle"></i> Ashirul Amin, Dnet</p>
                                <p><h4>Bridging Digital Divide For Rural Youth: An Experience from Computer Literacy
                                    Programme in Bangladesh</h4></p>
                                <p style="text-align: center; margin: 10px;"><a
                                        href="{{asset('root/fileupload/news/CLP-Research-Final-Copy.pdf')}}"
                                        class="btn btn-primary newsBtn" role="button">Read More</a></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('website.partials.actions')
@endsection
