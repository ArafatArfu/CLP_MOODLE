@extends('layouts.website')
@section('title', $news->title ? substr($news->title, 0, 30) : '')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>{{$news->title ? substr($news->title, 0,50) : ''}}</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">News</a>
                        </li>
                        <li>
                            <a href="{{route('news.latestNews')}}">CLP News</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="latest-news-wrap sec-padd">
        <div class="container">
            <div class="row news-row">
                <div class="col-sm-12 col-xs-12 news-left-cont">
                    <h6 class="blog-date">{{$news->date ?? ''}}</h6>
                    <h2 class="text-center blog-title">{{$news->title ?? ''}}</h2>
                    @if ($news->image)
                    <img src="{{asset($news->image)}}" style="margin-bottom: 10px;">
                    @endif
                    <div class="blog-details-cont">
                        {!! $news->description ?? '' !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="latest-news-thumb sec-padd">
        <div class="container">
            <div class="row">
                <h4 class="news-title">Latest News</h4>
                @foreach($latestNews as $ln)
                    @php
                        $monthName = date('F',strtotime($ln->date)) ?? date('F',strtotime($ln->created_at));
                        $day = date('j',strtotime($ln->date)) ?? date('j',strtotime($ln->created_at));
                    @endphp
                    <div class="col-sm-6 col-xs-12">
                        <div class="news-inner-blk">
                            <div class="date-time">
                                <h6>{{$day ?? ''}}</h6>
                                <span>{{$monthName ?? ''}}</span>
                            </div>
                            <div class="news-text">
                                <h5>
                                    <a href="{{route('news.single', $ln->slug)}}">{{$ln->title ?? ''}}</a>
                                </h5>
                                <p class="work_para_news">F{!! $ln->summary ?? '' !!}
                                    [<a href="{{route('news.single', $ln->slug)}}">Read More...</a>]</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
