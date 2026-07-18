@extends('layouts.website')
@section('title', 'Latest News')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Latest News</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">News</a>
                        </li>
                        <li>
                            CLP NEWS
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="latest-news-wrap sec-padd">
        <div class="container">
            @foreach($newses as $key => $news)
                <div class="row news-row">
                    <div class="col-sm-6 col-xs-12 news-left-cont">
                        @if($news->youtube_url)
                            <section class="video-section">
                                <div class="youtube-video">
                                    <iframe class="embed-responsive-item" src="{{ $news->youtube_url }}" allowfullscreen
                                    ></iframe>
                                </div>
                            </section>
                        @else
                            <img src="{{ $news->image_url ?? asset('assets/img/news/img01.jpg') }}" alt="news-cover"
                                 class="img-responsive"/>
                        @endif
                    </div>
                    <div class="col-sm-6 col-xs-12 news-right-cont">
                        <h6 class="date">{{  $news->date ?? '' }}</h6>
                        <h4 class="titles"><a href="{{route('news.single', $news->slug)}}">{{$news->title ?? ''}}</a>
                        </h4>
                        <p class="text">{!! $news->summary ?? '' !!}</p>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </section>
    <!-- End of latest-news-wrap -->
@endsection
