@extends('layouts.website')
@section('title', 'CLP | Brochure')
@section('content')
    <!-- End of theme_menu -->
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Brochure</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">News</a>
                        </li>
                        <li>
                            Brochure
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->
    <section class="brochure-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <p class="brochure-img">
                        <a href="{{asset('root/assets/images/clpb3.png')}}" download="">
                            <img src="{{asset('root/assets/images/clpb3.jpg')}}" alt="img"
                                 class="img-responsive"></a></p>
                    <p class="brochure-img">
                        <a href="{{asset('root/assets/images/clpb2.jpg')}}" download=""><img
                                src="{{asset('root/assets/images/clpb2.jpg')}}" alt="img"
                                class="img-responsive"></a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of brochure-wrap -->
    @include('website.partials.actions')
@endsection
