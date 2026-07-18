@extends('layouts.website')
@section('title', 'CLP | Curriculum Development')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Curriculum Development</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Our WORK</a>
                        </li>
                        <li>
                            Curriculum Development
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
                    <span class="qt">“Esho Computer Shikhi”</span>
                    <span class="qt text-right">“Let Us Learn Computers”</span>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p style="font-size: 14px;" class="work_para">An introductory curriculum was developed in
                        consultation with computer scientists, based on which a student’s manual, “Esho Computer Shikhi”
                        (Let Us Learn Computers), has been published. Two teachers from each CLC receive two weeks of
                        intensive training from Dnet professionals. Dnet also provided with a “teacher’s manual.”</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-xs-12 col-sm-offset-1">
                    <p class="connect-img">
                        <img src="{{asset('root/assets/images/curriculum-development/book.png')}}" alt="img"
                                                class="img-responsive"/>
                    </p>
                    <p class="work_para">
                        <a href="https://drive.google.com/file/d/1pzfx4H0GopQfPFgUNGgPSQF5Eae1npSG/view">Click Here to
                            get PDF copy</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    @include('website.partials.actions')
@endsection
