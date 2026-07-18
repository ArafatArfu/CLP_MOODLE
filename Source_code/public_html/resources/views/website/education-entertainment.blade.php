@extends('layouts.website')
@section('title', 'Education Through Entertainment')
@section('content')
    <!-- End of theme_menu -->
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Education Through Entertainment</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Our WORK</a>
                        </li>
                        <li>
                            Education Through Entertainment (EE)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="education-through-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">Education through Entertainment (EE) is a new initiative of the Computer
                        Literacy Program that leverages the computer and multimedia facilities at the Computer Literacy
                        Centers (CLCs) and/or Smart Class Rooms (SCRs) to provide students with an entertaining platform
                        for acquiring knowledge. The objectives of the program are to instill knowledge and values, such
                        as tolerance, global awareness, environmental conscientiousness, entrepreneurship in students,
                        as well as to sharpen student’s communication skills through entertaining co-curricular
                        activities.</p>

                    <p class="work_para">Launched in 2016, the initiative was run as a pilot project in five schools
                        with SCRs. While we expect the scope and format of EE to evolve, in the current form it involves
                        use of engaging video(s) to draw students’ attention to interesting and important topics. The
                        topics intended to be covered and eventually collected in the EE content library may belong to
                        diverse areas, such as, general knowledge, science, literature, arts, nature, history,
                        geography, environment, personalities, current issues and events, health, medicine,
                        entrepreneurship to name a few.</p>
                </div>

                <div class="col-sm-5 col-xs-12">
                    <p class="work_para">Table 1.0. The content page of the current version of the CD listing the
                        contents and relevant features.</p>
                    <img src="{{asset('root/assets/images/education-through-entertainment/contentimage.jpg')}}"
                         alt="img"
                         class="img-responsive"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <p class="work_para">The first step in the EE project involves selection of contents in the
                        above-mentioned areas. The videos pertaining to different contents are currently adapted from
                        those available in the open sources, such as, existing videos, You Tube, Internet, websites,
                        etc. In the pilot phase of the project, following 26 sessions were assembled: Visit Beautiful
                        Places in Bangladesh, Language Movement, Life Story of Bill Gates, Balanced Diet, We’ll Protect
                        Ourselves, Be Kind, How to Succeed, Environmental Conservation, Apocalyptic Natural Disaster,
                        Facts About Elephant, Global Fresh Water Challenge, and Do What You are Good at, Build Good
                        Habits, and Gain Wisdom from Stories. These video pieces, adapted from different open sources
                        have been organized in a CD (see Table 1.0).</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <p class="work_para">The topics and videos received enthusiastic acceptance from students and
                        teachers during the pilot project. Since then, the following 12 pieces have been added to the EE
                        repertoire: Rules and Manners, Unity, Physical Exercise, Wasfia’s Journey, Our Universe,
                        Tornado, Thunderstorm and Hail, Flood Safety, Earthquake Safety, Entrepreneurship, Cleanliness,
                        Active Listening, and Climate Change. Table 2.0 provides a complete list of contents developed
                        to date.</p>

                    <p class="work_para">Even a casual look at the above list of contents will reveal the intent of the
                        EE initiative. The piece entitled Language Movements provides a glimpse of the pivotal event in
                        our history; Balanced Diet is a lesson in food for good health; Global Fresh Water Challenge
                        draws attention to the importance of water in sustaining life and need for preserving this
                        precious resource; Build Good Habits, Be Kind, and Gain Wisdom from Stories are geared towards
                        self-improvement and developing moral values; Life Story of Bill Gates is an inspirational story
                        of what an entrepreneurial individual can accomplish from humble beginning, and so on.</p>

                    <p class="work_para">The next important step is presenting the above-mentioned contents to students.
                        Here a student-club model, such as, that of a debating society, or a science club has been
                        adopted. The EE project activity is organized in structured sessions. An EE session covers two
                        regular class periods (approximately 90 minutes). Typically, a session is run on a Thursday
                        after the regular classes are over. In a typical session one (or depending on the length, two)
                        videos are shown to students. Each video is accompanied by a lesson plan to guide the teacher on
                        how to conduct the session and steer students’ activities and discussions. After playing the
                        video(s), the teacher opens the floor for discussion on the topic(s) covered by the video
                        presentation. The optimization of students’ participation in the discussion, so that everyone
                        (as opposed to enthusiastic few) gets involved is emphasized, and the Lesson Plan provides
                        specific suggestions to that end. The discussions among the students are steered so that they
                        understand the intended teachings and develop action plans to translate their learning into
                        practice as appropriate. Students from classes VI through X are expected to benefit from the EE
                        Sessions.</p>

                    <p class="work_para">The anticipated benefits of this program include: (a) Providing an engaging and
                        enjoyable learning environment; (b) fostering listening and comprehension skills; (c) imparting
                        knowledge, building moral values and awareness through entertainment; and (d) sharpening
                        communication skills through participatory discussions.</p>

                    <p class="work_para">The EE project is still in its early stages of development. Present activities
                        include: (a) Improvement of initial 26 sessions with feedback from the pilot trials; (b)
                        Developing a second CD to include the other 12 sessions with corresponding lesson plans (and/or,
                        develop of a composite CD that includes all 26 videos and sessions); and (c) Implement the
                        project in other schools with CLC and/or SCR, which includes training teachers, providing the CD
                        with lesson plan, and monitoring progress.</p>

                    <p class="work_para">We are optimistic about the value and impact of the EE project. This optimism
                        derives from the reception that the EE Pilot phase has received.</p>
                </div>
            </div>
            <div class="section-title center extr-mrg-top">
                <h2>Education Through <span class="thm-color">Entertainment Name List</span></h2>
            </div>

            <div class="col-sm-12 col-xs-12">
                <h3 class="subtitle ">Beautiful Bangladesh</h3>
                <br>
                <p class="work_para">These resources show off the beautiful country of Bangladesh</p>
            </div>
        </div>
    </section>
    <!-- End of education-through-wrap -->

    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url({{asset('root/assets/images/fact-counter-bg.jpg')}});">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div
                        style="background: url({{asset('root/assets/images/education-through-entertainment/eecover2.png')}})"
                        class="about-video">
                        <a href="https://youtu.be/hRWYZNA_NJo" class="gallery_video">
                            <img src="{{asset('root/assets/images/play.svg')}}" alt="youtube"/>
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Incredibly Beautiful Bangladesh - The School of Life [Full Version]</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of introduction-wrap -->
    <section class="education-through-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h3 class="subtitle">Language Movement</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- End of education-through-wrap -->

    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url({{asset('root/assets/images/fact-counter-bg.jpg')}});">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="about-video"
                         style="background: url({{asset('root/assets/images/education-through-entertainment/eecover1.png')}}">
                        <a href="https://www.youtube.com/watch?v=FRoa1v6_ZQY" class="gallery_video">
                            <img src="{{asset('root/assets/images/play.svg')}}" alt="youtube"/>
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>History of Shahid Minar 21 February</h2>
                            <h5 class="next-note">Next: Documentary International Mother Language Day</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of introduction-wrap -->

    <section class="education-through-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h3 class="subtitle mrg-top-remove">Life Story of Bill Gates</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- End of education-through-wrap -->

    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url({{asset('root/assets/images/fact-counter-bg.jpg')}});">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="about-video"
                         style="background: url({{asset('root/assets/images/education-through-entertainment/eecover3.png')}}">
                        <a href="https://www.youtube.com/watch?v=t8mvgmO5XUE" class="gallery_video">
                            <img src="{{asset('root/assets/images/play.svg')}}" alt="youtube">
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Life Story of Bill Gates - Documentary Bengali</h2>
                            <h5 class="next-note">Next: Bill Gates Speech at Harvard Part 1 - [English sub]</h5>
                        </div>
                    </div>
                </div>
                <!-- End of welcome-content -->
            </div>
        </div>
    </section>
    <!-- End of introduction-wrap -->

    <section class="education-through-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <p class="work_para">NOTE: There are several other sections of videos included on this page:
                        Balanced Diet, We’ll Protect Ourselves, Be Kind, Failure is the Pillar of Success, Environmental
                        Conservation, Apocalyptic Natural Disaster, Elephants are Smart, Global Fresh Water Crisis.
                        Follow the same pattern exemplified in the three resource lists above.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of education-through-wrap -->
    @include('website.partials.actions')
@endsection
