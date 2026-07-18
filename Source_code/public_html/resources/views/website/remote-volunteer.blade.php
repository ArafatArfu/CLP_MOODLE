@extends('layouts.website')
@section('title', 'Remote Voluntary Teaching (RVT)')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Remote Voluntary Teaching (RVT) </h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Our WORK</a>
                        </li>
                        <li>
                            Remote Voluntary Teaching (RVT)
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
                    <p class="work_para">How effective is remote teaching? How does a remote class experience compare
                        with that of a face-to-face class? These questions have been raised many times from many
                        different pulpits and platforms ever since advances in instructional technology made online,
                        distant instruction feasible; and more so during this pandemic that shut down schools and put
                        in-person classes on hold around the globe. While the jury is still out, one observation is
                        clear that there may be no all-encompassing single answer. Answers to the questions will depend
                        on many factors that include resources of the institution, socio-economic background of the
                        students attending the school, availability of trained teachers and aspects of interpersonal
                        communications.
                    </p>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <p><img src="{{asset('root/assets/images/remote-volunteer/ds2.webp')}}" alt="img"
                            class="img-responsive"/></p>
                </div>
            </div>
        </div>
    </section>

    <section class="history-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <div class="card-columns literacy-columns">
                        <p><img src="{{asset('root/assets/images/remote-volunteer/ds1.webp')}}" alt="img"
                                class="img-responsive"/></p>
                    </div>
                </div>

                <div class="col-sm-7 col-xs-12">
                    <p class="work_para">The Computer Literacy Program (CLP) initiated remote voluntary teaching on a
                        limited scale few years ago. Volunteer teachers from the US and other countries have been
                        teaching primary and high school students in rural Bangladesh. The project uses the
                        infrastructure of a <a href="{{ route('website.smartClassRoom') }}">Smart Class Room (SCR)</a>,
                        with
                        some improvisations, for distant instruction. The experiment has generated considerable interest
                        among students, teachers of those students, parents and volunteers of different age groups eager
                        to teach. This article features the experiences and observations of four individuals engaged in
                        this experiment.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url({{asset('root/assets/images/fact-counter-bg.jpg')}});">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="rvt1_video">
                        <a target="_blank" href="https://youtu.be/pqdkhrvmrkA" class="gallery_video">
                            <img src="{{asset('root/assets/images/play.svg')}}" alt="play">
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Shirin Siddiqui talking about CLP and RVT</h2>
                            <p class="description work_para">Shirin Siddiqui, a professor of Chemistry at Elizabeth City
                                State University in North Carolina, shares about her teaching of Chemistry to high
                                school students of the <a href="{{route('website.schoolDetails', 13)}}"
                                                          target="_blank">Uddipan
                                    Badar-Shamsu Bidya Niketan (UBSBN)</a> at Boitpur, Bagerhat. Not only does she bring
                                her knowledge of chemistry and teaching skills honed over the years to the class, but
                                also her background of growing up in a similar rural setting and her life experience.
                                She naturally becomes a role model for her students.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="history-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="work_para">The objective of each of these classes are teaching grammar, vocabulary,
                            communication, writing, etc. Learning English from native speakers of the language enhances
                            ability of the Bangladeshi students to communicate with peers in the outside world. In
                            addition, the school hosts RVT classes in Chemistry, Physics and Mathematics to students in
                            different grade levels.</p>
                    </div>
                </div>
                <p class="work_para">CLP is pursuing to implement this popular program in additional CLP schools.</p>
            </div>
        </div>
    </section>

    <section class="introduction-wrap news fact-counter-2 sec-padd"
             style="background-image: url({{asset('root/assets/images/fact-counter-bg.jpg')}});">
        <div class="welcome-area ptb--100">
            <div class="container">
                <div class="welcome-content">
                    <div class="rvt2_video">
                        <a target="_blank" href="https://youtu.be/FzpQT6Gx33Y" class="gallery_video">
                            <img src="{{asset('root/assets/images/play.svg')}}" alt="">
                        </a>
                    </div>
                    <div class="welcome-inner">
                        <div class="blog-info">
                            <h2>Partnership between CLP and FERA Foundation</h2>
                            <p class="description work_para">CLP has developed a professional collaboration relationship
                                with Fera Foundation in 2021.
                                With a synergy between CLP-provided hardware & logistic support and volunteer
                                recruitment by Fera Foundation, it is anticipated that Distance Teaching will be
                                launched at many CLP sponsored <a target="_blank"
                                                                  href="{{ route('website.smartClassRoom') }}">Smart
                                    Classroom
                                    (SCR).</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="history-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="work_para">Nashwaan Ali Khan, a high school senior from Cerritos, California wanted to
                            obtain some volunteering experience as high school students in the US commonly do. His
                            fascinating piece tells how that pursuit made him raise funds to help establish a SCR at an
                            orphanage in Gazipur, organize his friends to participate, bring out the leader in him and
                            of course teach English to the students at the orphanage. He garners a US President's
                            Volunteer Service Award (PVSA) Gold medal for his exemplary activities.</p>
                    </div>
                </div>
                <div class="row">
                    <table class="tblpage work_para">
                        <caption style="text-align:center; font-size: 18px; font-weight:bold;" class="work_para">List of
                            volunteer teachers
                        </caption>
                        <tr>
                            <th>Volunteer Teacher Name</th>
                            <th>Grade Level</th>
                            <th>Class Frequency</th>
                            <th>What Subject</th>
                            <th>Book Title</th>

                        </tr>
                        <tr>
                            <td>Aleaya Hajra, NY City</td>
                            <td>Four</td>
                            <td>Weekly</td>
                            <td>English Story Book</td>
                            <td>The Pied Piper of Hamelin-John Holder (Level 4)</td>

                        </tr>
                        <tr>
                            <td>Keean Saadi, NJ</td>
                            <td>Five</td>
                            <td>Weekly</td>
                            <td>English Story Book</td>
                            <td>Stella & Roy Go Camping-Ashley wolff</td>
                        </tr>
                        <tr>
                            <td>Samhita Tatavarty, NJ</td>
                            <td>SiX + Seveen</td>
                            <td>Weekly</td>
                            <td>English Story Book</td>
                            <td>The Adventures of Sherlock Holmes</td>
                        </tr>
                        <tr>
                            <td>Shroyo Rafiq, Australia</td>
                            <td>Eight</td>
                            <td>Weekly</td>
                            <td>English Grammar</td>
                            <td>Creative Writing</td>
                        </tr>

                        <tr>
                            <td>Nashwaan Ali Khan, NJ, USA</td>
                            <td>Five + Six + Seven</td>
                            <td>Weekly</td>
                            <td>English Story</td>
                            <td>English for Today</td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <div style="margin: 0 auto; text-align: center;">
                            <a style="margin: 0 auto;" href="{{ route('website.volunteer') }}" target="_blank"
                               class="read-more">Be a Volunteer</a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('website.partials.actions')
@endsection
