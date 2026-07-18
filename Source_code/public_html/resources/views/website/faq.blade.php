@extends('layouts.website')
@section('title', 'CLP | FAQ')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>FAQ</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">About Us</a>
                        </li>
                        <li>
                            FAQ
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="call-out faq-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="statement-inner">
                        <h4>What is a CLC?</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of faq-wrap -->

    <section class="faq-answer-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="inner">
                        <p class="work_para">Answer: <a href="{{route('website.clcTeaching')}}">CLC</a> stands for our
                            Computer Literacy Center initiative. The CLC initiative establishes turnkey computer labs in
                            educational institutes and actively participates in promoting knowledge and usage of
                            computers and internet among underprivileged youth in Bangladesh.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of faq-answer-wrap -->

    <section class="call-out faq-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="statement-inner">
                        <h4>What is a SCR?</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of faq-wrap -->

    <section class="faq-answer-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="inner">
                        <p class="work_para">Answer: <a href="{{route('website.smartClassRoom')}}">SCR</a> stands for
                            our Smart Class Room initiative where classrooms in Bangladesh are equipped with computers,
                            a large screen TV/monitor, and remote conferencing devices. Teachers are able to access and
                            share content digitally and are enabled to teach remotely. The Smart Class Room project
                            intends to bring the educational opportunities provided by advances in personal computers,
                            Internet, educational CDs, and ICT-based interactive learning materials to secondary school
                            students in rural Bangladesh.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of faq-answer-wrap -->
@endsection
