@extends('layouts.website')
@section('title', 'CLP | Our Partners')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Partners</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">About Us</a>
                        </li>
                        <li>
                            Our Partners
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->
    <section class="our-partners-wrap sec-padd">
        <div class="container">
            <h2 style="text-align:center;"><span class="thm-color">Corporate</span> Partners</h2>
            <div style="height:250px; width: 100%;">
                    <a target="_blank" style="width: 100%; display: flex; justify-content: center;" href="https://www.petracephas.com/">
                        <img src="{{asset('root/assets/images/partners/ad_1.jpg')}}"
                             class="img-responsive partner_main_img text-center" alt="partner-logo">
                    </a>
            </div>
            <div class="partner-card-columns">
                <div class="card partner-items">
                    <div class="img-col-partner">
                        <img src="{{asset('root/assets/images/partners/nabic.png')}}" alt="img" class="img-responsive"/>
                    </div>
                    <div class="text-col">
                        <div class="inner">
                            <h4>Nabic, USA</h4>
                            <p class="work_para"><a target="_blank" href="https://nabic.org/">North American Bangladesh
                                    Islamic Community (NABIC)</a>
                                is an initiative of Bangladeshi Muslims in North America dedicated to promoting Islamic
                                awareness and facilitating
                                socio-economic upliftment of the common people of Bangladeshi heritage in North America
                                and those in Bangladesh.</p>
                        </div>
                    </div>
                </div>
                <!-- End of partner-items -->

                <div class="card partner-items">
                    <div class="img-col-partner">
                        <img src="{{asset('root/assets/images/partners/bank_asia_logo.jpg')}}" alt="img"
                             class="img-responsive"/>
                    </div>
                    <div class="text-col">
                        <div class="inner">
                            <h4>Bank Asia Ltd, Bangladesh</h4>
                            <p class="work_para"><a target="_blank" href="https://www.bankasia-bd.com/">Bank Asia
                                    Limited</a>
                                is a scheduled commercial bank in the private sector established under the Banking
                                Company Act 1991 and incorporated in
                                Bangladesh as a public limited company under the Companies Act 1994 to carry out banking
                                business in Bangladesh.
                                Bank Asia Ltd. sponsored thirteen Computer Literacy Center under their Corporate Social
                                Responsibilities adjacent
                                in the rural branch in Bangladesh.</p>
                        </div>
                    </div>
                </div>

                <div class="card partner-items">
                    <div class="img-col-partner"></div>
                    <div class="text-col">
                        <div class="inner">
                            <h4>Imdad Sitara Khan Foundation, USA</h4>
                            <p class="work_para">This foundation is based in CA, USA formed by Dr. Imdadul Haque Khan, a
                                renowned scientist and philanthropist. Dr. Khan’s magnanimous support gave the fledgling
                                Computer Literacy Program a boost without which perhaps, the program would not be where
                                it is to-day. Dr. Khan provided support for twelve centers. In addition, he provided
                                funds for teacher incentive pay to the CLCs he sponsored. But, CLP is not the only noble
                                endeavor that Dr. Khan supported, but it was one of many.</p>
                        </div>
                    </div>
                </div>
                <!-- End of partner-items -->

                <div class="card partner-items">
                    <div class="img-col-partner"></div>
                    <div class="text-col">
                        <div class="inner">
                            <h4>I-K Foundation, Dhaka</h4>
                            <p class="work_para">I-K Foundation is a family foundation committed to poverty reduction
                                and social progress through the support of programs that impart income-generating skills
                                to the poor and underprivileged in Bangladesh.</p>
                        </div>
                    </div>
                </div>
                <!-- End of partner-items -->

                <div class="card partner-items">
                    <div class="img-col-partner"></div>
                    <div class="text-col">
                        <div class="inner">
                            <h4>CSDC, Chittagong</h4>
                            <p class="work_para">Chittagong Skills Development Center (CSDC) is the first industry-led,
                                non-profit skills training center in Bangladesh; and a private-public partnership
                                between industry, government and academia. CSDC aims to strategically develop
                                Bangladesh’s workforce by meeting the present and future skill needs of the ICT and
                                manufacturing sectors; and promote poverty reduction.</p>
                        </div>
                    </div>
                </div>
                <!-- End of partner-items -->

                <div class="card partner-items">
                    <div class="img-col-partner">
                        <img src="{{asset('root/assets/images/partners/ucep.png')}}" alt="img" class="img-responsive"/>
                    </div>
                    <div class="text-col">
                        <div class="inner">
                            <h4>Underprivileged Children’s Educational Programs</h4>
                            <p class="work_para">UCEP is a leading national NGO working with the distressed urban
                                working children, to improve the socio-economic status of the urban poor and support
                                industrial growth by generating skilled manpower. UCEP has earned a global reputation
                                for its unique model of human resource development through general education and
                                vocational skills training for employment and income generation.</p>
                        </div>
                    </div>
                </div>
                <!-- End of partner-items -->

                <div class="card partner-items">
                    <div class="img-col-partner"></div>
                    <div class="text-col">
                        <div class="inner">
                            <h4>Hossain Trust, Dhaka, Bangladesh</h4>
                            <p class="work_para">Syed Saadat Hossain, Dr. Ahmed Hossain and Ahmedi Hossain Trust (herein
                                called Hossain Trust) duly incorporated in Bangladesh under the Trust Act of the
                                People’s Republic of Bangladesh having its registered office at 7/C New Baily Road,
                                Dhaka – 1217.</p>
                        </div>
                    </div>
                </div>
                <!-- End of partner-items -->
                <div class="card partner-items">
                    <div class="img-col-partner"></div>
                    <div class="text-col">
                        <div class="inner">
                            <h4>Islamabad Girl’s Orphanage</h4>
                            <p class="work_para">This organization was established as one of the first girls’ orphanages
                                in Chittagong by several philanthropist 25 years ago. The orphanage hosts 96 girls from
                                the age 4-16, providing accommodations, health care, education and overall welfare.</p>
                        </div>
                    </div>
                </div>
                <!-- End of partner-items -->

                <div class="card partner-items">
                    <div class="img-col-partner">
                        <img src="{{asset('root/assets/images/partners/Fera_Foundation_Logo.png')}}" alt="img"
                             class="img-responsive"/>
                    </div>
                    <div class="text-col">
                        <div class="inner">
                            <h4>Fera Foundation</h4>
                            <p class="work_para">CLP has developed a professional collaboration relationship with <a
                                    target="_blank" href="https://www.ferafoundation.org/">Fera Foundation</a> in 2021.
                                Fera Foundation Inc. is a women-led, not-for-profit organization serving as a reliable
                                bridge between the Bangladeshi diasporic community and Bangladeshi civil society through
                                convenient remote charitable services. Fera Foundation has an effective program in
                                recruiting volunteer teachers.
                                With a synergy between CLP-provided hardware & logistic support and volunteer
                                recruitment by Fera Foundation,
                                it is anticipated that Distance Teaching will be launched at many CLP sponsored Smart
                                Classroom (SCR).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('website.partials.actions')
@endsection
