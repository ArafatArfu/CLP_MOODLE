@extends('layouts.website')
@section('title', 'DEVELOP TRAINING MATERIALS AND CONTENTS')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>DEVELOP TRAINING MATERIALS AND CONTENTS</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Our WORK</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">More Programs</a>
                        </li>
                        <li>
                            DEVELOP TRAINING MATERIALS AND CONTENTS
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
                <div class="col-sm-6 col-xs-12">
                    <p class='work_para'>CLP engages with experts to design curriculum for digital literacy training in
                        CLCs and the subjects taught in SCRs. The ‘Esho Computer Shikhi’ book which is used as a
                        guideline for the students who receive digital literacy training in the CLCs, was developed and
                        edited by consulting with some of the well-known experts of the country. CLP has also produced a
                        multimedia content CD for nine high school textbooks with guidance from technology and
                        educational experts to implement multi-media-based teaching-learning. Yearly 60,000 students
                        across Bangladesh are getting the benefit of using CLP’s SCR contents in classrooms. Besides
                        developing contents regarding CLC and SCR, CLP always tries to bring on the modern pedagogies
                        and methodologies of teaching-learning while designing any kinds of teachers’ training for its
                        supported centers’ teachers </p>
                    <div class="card-columns literacy-columns">
                        <div class="card partner-items literacy mrg">
                        </div>
                        <!-- End of partner-items -->
                    </div>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <p><img src="{{asset('root/assets/images/clc/EshoComputerShikhiBook.jpg')}}" alt="img"
                            class="img-responsive"/></p>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <p><img src="{{asset('root/assets/images/curriculum-development/book.png')}}" alt="img"
                            class="img-responsive"/></p>
                    <p class="work_para"><a
                            href="https://drive.google.com/file/d/1pzfx4H0GopQfPFgUNGgPSQF5Eae1npSG/view">Click Here to
                            get PDF copy</a></p>
                </div>
            </div>
        </div>
    </section>
    @include('website.partials.actions')
@endsection
