@extends('layouts.website')
@section('title', 'Dhunat Project')
@section('content')
    
    <!-- Project Title -->
    <h2 style="text-align: center; padding: 2%; font-size: 35px;">Dhunat Project</h2>

    <!-- Project Description -->
    <div class="container">
        <p style="text-align: justify; font-size: 18px; padding: 2%;">
            The "Dhunat Project" is a transformative initiative aimed at providing quality education and digital literacy
            to underprivileged students in Dhunat, Bogura. This program introduces modern learning facilities,
            including Computer Literacy Centers and Smart Classrooms, to enhance students' technological proficiency and
            communication skills. With a focus on English language learning and interactive education, the project
            empowers students to compete on a global level. The initiative is supported by dedicated educators and
            volunteers who facilitate distance learning opportunities.
        </p>
    </div>

    <!-- Image Carousel -->
    <div class="container" style="width: 80%;">
        <div id="carousel" class="carousel slide" data-ride="carousel" style="border: 10px solid #e0e0e345;">
            <ol class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="active item">
                    <img class="img-responsive" src="{{asset('root/assets/images/homepage/Dhunat/image1.jpg')}}"/>
                </div>
                <div class="item">
                    <img class="img-responsive" src="{{asset('root/assets/images/homepage/Dhunat/image2.jpg')}}"/>
                </div>
                <div class="item">
                    <img class="img-responsive" src="{{asset('root/assets/images/homepage/Dhunat/image3.jpg')}}">
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

    <section class="here-dhunat-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="blog-list row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="blog-single thumbnail home-thumb">
                                <div class="blog-thumb">
                                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/example1" frameborder="0" allowfullscreen></iframe>
                                </div>
                                <div class="blog-info" style="padding-bottom:40px">
                                    <h4 class="title">Center Name 1</h4>
                                    <p class="blog-text">Brief description of Center 1.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="blog-single thumbnail home-thumb">
                                <div class="blog-thumb">
                                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/example2" frameborder="0" allowfullscreen></iframe>
                                </div>
                                <div class="blog-info" style="padding-bottom:40px">
                                    <h4 class="title">Center Name 2</h4>
                                    <p class="blog-text">Brief description of Center 2.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="blog-single thumbnail home-thumb">
                                <div class="blog-thumb">
                                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/example3" frameborder="0" allowfullscreen></iframe>
                                </div>
                                <div class="blog-info" style="padding-bottom:40px">
                                    <h4 class="title">Center Name 3</h4>
                                    <p class="blog-text">Brief description of Center 3.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="sidebar-area">
                        <div class="widget widget-letest-news">
                            <div class="widget-title">
                                <h2>Latest News</h2>
                            </div>
                            <div class="news-list">
                                <div class="news-item">
                                    <h4>March 20, 2024</h4>
                                    <h3>New Learning Center Inaugurated</h3>
                                    <p>A new Computer Literacy Center has been inaugurated at Dhunat, providing students with access to modern educational resources.</p>
                                </div>
                                <div class="news-item">
                                    <h4>April 10, 2024</h4>
                                    <h3>Teacher Training Program Launched</h3>
                                    <p>A special training program for teachers has been launched to enhance digital literacy and teaching methodologies.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('website.partials.actions')
@endsection
