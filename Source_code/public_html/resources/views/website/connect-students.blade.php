@extends('layouts.website')
@section('title', 'CLP | Connecting Students Around the World')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Connecting Students Around the World</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Our WORK</a>
                        </li>
                        <li>
                            Connecting Students a round the World (CSAW)
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
                    <h4 class="subtitle mrg-top-remove work_para">CLP launched a new program called Connecting Students
                        Around the World (CSAW).</h4>
                    <p class="work_para">CLP’s latest project is Connecting Students around the World (C-SAW) that
                        brings together students from two different schools in two different countries through joint
                        projects and live video discussion. This project aims at fostering cultural communication,
                        friendship, and what is even more important, developing understanding between youths living in
                        different corners of the world. Another objective is to improve communication skills
                        particularly English communication skills of students from countries where English is not the
                        native language.</p>
                    <p class="work_para">This unique project was developed in collaboration with Ms. Jill Stedronsky, an
                        English teacher with William Annin Middle School (WAMS) in Baskin Ridge, NJ, USA. The first
                        pilot was run with WAMS and Uddipon Bader –Shamsu Bidya Niketon (UBSBN), a school in rural
                        Chitali of Bagerhat district in Bangladesh, on April 17, 2017 with great success. In late March
                        2017, the UBSBN students prepared a video that showed their homes, daily life, school, and the
                        village market.</p>
                    <p class="work_para">The video really impressed the 8th Grade students of WAMS. They in turn also
                        prepared and shared a video depicting their school, activities, supermarket, library and other
                        aspects of life in an affluent small town.</p>
                </div>
                <div class="col-sm-4 col-xs-12 col-sm-offset-1">
                    <p class="connect-img"><img src="{{asset('root/assets/images/connect-students/students1.png')}}"
                                                alt="img" class="img-responsive"/></p>
                    <p class="work_para">WAMS participants during Skype conversation with UBSBN participants.</p>
                    <p class="connect-img"><img src="{{asset('root/assets/images/connect-students/Pic2.jpg')}}"
                                                alt="img" class="img-responsive"/></p>
                    <p class="work_para">UBSBN participants speaking with WAMS participants via Skype video call.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of history-wrap -->

    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url({{asset('root/assets/images/fact-counter-bg.jpg')}};)">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="csaw-video">
                        <a target="_blank" href="https://youtu.be/FzpQT6Gx33Y" class="gallery_video">
                            <img src="{{asset('root/assets/images/play.svg')}}" alt="">
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Connect Students around the World (CSAW) Program</h2>
                            <p class="description">Learn how CLP brings students together around the world.</p>

                            <h5 class="next-note">Next: Partner project at William Annin Middle School in Baskin Ridge,
                                NJ, USA.</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of introduction-wrap -->

    <section class="history-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">Next the students from both schools emailed each other a set of questions. On
                        April 17 they held a live Skype video conference to answer each other’s questions. Given the 10
                        hour time difference, the kids at WAMS came to school by 6.40 AM, which is one hour before their
                        normal arrival time. Eight thousand miles away in Chitali though the school day ended at 4 pm,
                        the students of the English Club stayed an hour extra for the Skype session to begin at 5 PM
                        Bangladesh local time (7 AM, New Jersey local time). A part of their conversation is captured in
                        a video: <a href="https://www.youtube.com/watch?v=ga3I6Ly9Ae8">https://www.youtube.com/watch?v=ga3I6Ly9Ae8</a>.
                        The two student groups seemed to have understood each other quite satisfactorily. It was
                        heart-warming to observe how kids from such diverse socio-economic, ethnic, and cultural
                        backgrounds could connect so well, so quickly.</p>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <p class="connect-img"><img src="{{asset('root/assets/images/connect-students/students.png')}}"
                                                alt="img" class="img-responsive"/></p>
                    <p class="work_para">UBSBN participants speaking with WAMS participants via Skype video call.</p>
                </div>
            </div>

            <div class="row extr-mrg-top">
                <div class="col-sm-5 col-xs-12">
                    <p class="connect-img"><img src="{{asset('root/assets/images/connect-students/blog-img4.png')}}"
                                                alt="img" class="img-responsive"/></p>
                    <p class="work_para">WAMS participants during Skype conversation with UBSBN participants.</p>
                </div>
                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">This pilot project has clearly shown how understanding and friendship between
                        students living at two different corners of the world can be improved through simple project
                        collaboration project described here.</p>
                    <p class="work_para">CLP plans more of similar projects in the future using the lessons-learned for
                        mutual benefits of global students.</p>
                    <p class="work_para">This pilot project has noticeably shown how self-confidence, understanding and
                        friendship between students living at two different corners of the world can be nurtured through
                        a simple live collaboration project described here.</p>
                    <p class="work_para">CLP plans more of similar projects in the future using the lessons-learned for
                        shared benefits of students from different parts of the world.</p>
                    <p class="work_para">CLP welcomes comments and suggestions.</p>
                </div>
            </div>
        </div>
    </section>
    
        <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url({{asset('root/assets/images/fact-counter-bg.jpg')}};)">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="csaw-video">
                        <a target="_blank" href="https://youtu.be/qf7MPhVH-es?si=WxkCT5zgbVcJqx0B" class="gallery_video"> 
                            <img src="{{asset('root/assets/images/play.svg')}}" alt="">
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Connect Students around the World CSAW | Zoom Conference| Great Oaks & Sherura School</h2>
                            <p class="description">The Connect Students Around the World (CSAW) program is a cross-cultural initiative by the Children’s Literature Project (CLP) that brings together students from Bangladesh and the United States through video storytelling and live Zoom interactions. In recent sessions, students from schools like GK Adarsha High School and Sherua Adarsha High School in Bangladesh connected with peers from Great Oaks Legacy Charter School in New Jersey. They exchanged videos about their daily lives and engaged in real-time conversations, fostering mutual understanding, friendship, and global awareness.</p>

                            <h5 class="next-note">Next: Great Oaks Legacy Charter School in New Jersey.</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- End of history-wrap -->
    @include('website.partials.actions')
@endsection
