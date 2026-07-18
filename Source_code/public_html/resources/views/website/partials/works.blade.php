<section class="here-bangladesh-wrap">
    <div class="container">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="blog-info">
                <p>CLP promotes the knowledge and usage of computer and information technology among the
                    underprivileged
                    youths in Bangladesh. We do so in following ways:</p>
            </div>
            <div class="blog-list row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="blog-single thumbnail home-thumb"
                         onclick="location.href='{{ asset('clc-teaching')}}'">
                        <div class="blog-thumb">
                            <a href="{{ asset('clc-teaching')}}"><img
                                    src="{{ asset('root/assets/images/homepage/program-img/clc-prg_cover_500_300.webp') }}"
                                    class="img-fluid" alt="blog thumbnail"/>
                            </a>
                        </div>
                        <div class="blog-info">
                            <h4 class="title">
                                <a href="{{ asset('clc-teaching')}}">COMPUTER LITERACY CENTER (CLC)</a>
                            </h4>
                            <p class="blog-text">We equip Computer Literacy Center (CLCs) with computers, internet
                                connectivity, curriculum and trained teachers for students to become computer
                                literate.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="blog-single thumbnail home-thumb"
                         onclick="location.href='{{ asset('smart-class-room')}}'">
                        <div class="blog-thumb">
                            <a href="{{ asset('smart-class-room')}}"><img
                                    src="{{ asset('root/assets/images/homepage/program-img/scr-prg-cover_500_300.webp') }}"
                                    class="img-fluid" alt="blog thumbnail"></a>
                        </div>
                        <div class="blog-info">
                            <h4 class="title">
                                <a href="{{ asset('smart-class-room')}}">SMART CLASSROOM<br>(SCR)</a>
                            </h4>
                            <p class="blog-text">We equip Smart Classrooms (SCRs) with large screen monitor,
                                computer,
                                contents and subject based trained teachers for student’s enjoyable and sustainable
                                learning.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="blog-single thumbnail home-thumb"
                         onclick="location.href='{{ asset('remote-volunteer')}}'">
                        <div class="blog-thumb">
                            <a href="{{ asset('remote-volunteer')}}"><img
                                    src="{{ asset('root/assets/images/homepage/program-img/rvt-prg_cover_500_300.webp') }}"
                                    alt="blog thumbnail"></a>
                        </div>
                        <div class="blog-info">
                            <h4 class="title">
                                <a href="{{ asset('remote-volunteer')}}">REMOTE VOLUNTARY TEACHING (RVT)</a>
                            </h4>
                            <p class="blog-text">We create opportunities for rural students to participate different
                                live online classes of subject-based experts who connect from locations across the
                                globe.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="blog-list row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="blog-single thumbnail home-thumb"
                         onclick="location.href='{{ asset('connect-students-around')}}'">
                        <div class="blog-thumb">
                            <a href="{{ asset('connect-students-around')}}"><img
                                    src="{{ asset('root/assets/images/homepage/program-img/csawweb_500_300-min.webp') }}"
                                    alt="blog thumbnail"></a>
                        </div>
                        <div class="blog-info">
                            <h4 class="title">
                                <a href="{{ asset('connect-students-around')}}">CONNECT STUDENTS AROUND THE WORLD
                                    (CSAW)</a>
                            </h4>
                            <p class="blog-text">We bring students together from two different countries, aims at
                                fostering cultural communication, friendship and English communication skills
                                development.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="blog-single thumbnail home-thumb"
                         onclick="location.href='{{ asset('education-through-entertainment')}}'">
                        <div class="blog-thumb">
                            <a href="{{ asset('education-through-entertainment')}}"><img
                                    src="{{ asset('root/assets/images/homepage/program-img/ee-prg_cover_500_300.webp') }}"
                                    alt="blog thumbnail"></a>
                        </div>
                        <div class="blog-info">
                            <h4 class="title">
                                <a href="{{ asset('education-through-entertainment')}}">EDUCATION THROUGH
                                    ENTERTAINMENT
                                    (EE)</a>
                            </h4>
                            <p class="blog-text">We provide students an entertaining platform for acquiring
                                knowledge on
                                tolerance, global awareness, entrepreneurship and sharpen student's communication
                                skills.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="blog-single thumbnail home-thumb"
                         onclick="location.href='{{ asset('develop-training-material')}}'">
                        <div class="blog-thumb">
                            <a href="{{ asset('develop-training-material')}}"><img
                                    src="{{ asset('root/assets/images/homepage/program-img/development-prg_cover_500_300.webp') }}"
                                    alt="blog thumbnail"></a>
                        </div>
                        <div class="blog-info">
                            <h4 class="title">
                                <a href="{{ asset('develop-training-material')}}">DEVELOP TRAINING MATERIALS AND
                                    CONTENTS</a>
                            </h4>
                            <p class="blog-text">We engage with experts to design fitting curriculum for computer
                                literacy training in CLCs and the subjects taught in SCRs.</p>
                        </div>
                    </div>
                </div>
            </div>
            <p class="about-us-btn"><a class="read-more" href="history">ABOUT US</a></p>
        </div>
        @include('website.partials.news')
    </div>
</section>
