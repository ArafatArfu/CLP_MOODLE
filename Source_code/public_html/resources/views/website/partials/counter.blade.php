<section class="students-count-wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <h2>{{ $general->number_of_graduates ?? 00 }}</h2>
                <p>Students have received basic computer literacy training from the CLCs established by the Computer
                    Literacy Program and its implementation partner Dnet in Bangladesh with support from sponsors
                    and
                    local school administrations.</p>
                <h2 class="extr-mrg">{{ $general->female_percentage ?? 00 }}%</h2>
                <p>of the graduates are female.</p>
            </div>
        </div>
    </div>
</section>

<section class="clc-stands-wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <p>
                    <img alt="images" src="{{asset('root/assets/images/homepage/side1.webp')}}" class="img-responsive"/>
                </p>
            </div>
            <div class="col-sm-6 col-xs-12">
                <p class="clc-stand-text">A Computer Literacy Center (CLC) is a computer lab run by CLP trained
                    teachers
                    to provide students with hands-on training in computer usage using a structured curriculum.
                    Every
                    computer lab is equipped with a minimum of four computers, one printer, requisite accessories,
                    furniture and Internet connection (where available).</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7 col-xs-12 clc-stands">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="stand-inner-col">
                            <h1>${{ $general->clc_sponsorship_price ?? 00 }}</h1>
                            <h5>is the cost to sponsor a Computer Literacy Center.</h5>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="stand-inner-col brd-none">
                            <h1>{{ $general->total_clc_count ?? 00 }}</h1>
                            <h5>Computer Literacy Centers have been established in Bangladesh.</h5>
                        </div>
                    </div>
                </div>
                <p class="learn-more-btn-btn">
                    <a href="clc-teaching" class="read-more">Learn More</a>
                    <span style="padding-left: 12px;"> <a
                            href="{{ asset('sponsor_a_clc.htm') }}" class="read-more">Sponsor A CLC</a>
                    </span>
                </p>
            </div>
            <div class="col-sm-5 col-xs-12">
                <p><img alt="images" src="{{asset('root/assets/images/homepage/video-thumb.webp') }}"
                        class="img-responsive mrg-top"/>
                </p>
            </div>
        </div>
        <div class="row SCR-stands">
            <div class="col-sm-5 col-xs-12">
                <p><img alt="images" src="{{asset('root/assets/images/homepage/Pic4web.webp') }}"
                        class="img-responsive"/></p>
            </div>
            <div class="col-sm-7 col-xs-12">
                <p class="clc-stand-text">Smart Class Rooms (SCRs) brings the educational opportunities provided by
                    advances in personal computer, Internet, educational CDs, and ICT-based interactive learning
                    materials to secondary school students in rural Bangladesh. Every SCR is equipped with a laptop,
                    a
                    large screen TV monitor, educational CDs and contents from web. SCRs are readily adaptable for
                    remote instruction</p>

                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="stand-inner-col">
                            <h1>${{ $general->scr_sponsorship_price ?? 00 }}</h1>
                            <h5>is the cost for establishing a Smart Class Room.</h5>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="stand-inner-col brd-none">
                            <h1>{{ $general->total_scr_count ?? 00 }}</h1>
                            <h5>Smart Class Rooms have been established in Bangladesh.</h5>
                        </div>
                    </div>
                </div>
                <p class="learn-more-btn-btn"><a href="smart-class-room" class="read-more">Learn More</a>
                    <span style="padding-left: 12px;"> <a href="{{ asset('sponsor_a_scr.htm') }}" class="read-more">Sponsor A SCR</a></span>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- End of clc-stands-wrap-->
