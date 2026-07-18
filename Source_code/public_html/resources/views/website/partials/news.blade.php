@php use Carbon\Carbon; @endphp
<div class="col-md-4 col-sm-12 col-xs-12">
    <div class="panel panel-default latest-program">
        <div class="panel-body">
            <h4 style="color:#006b4f;"><strong>Newest Event</strong></h4>
            <div class="latestNews green">
                <ul>
                    @foreach($latestNews as $ln)
                        <li>
                            <a href="{{route('news.single', $ln->slug)}}">{{$ln->title ? substr($ln->title, 0, 60) : ''}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="sidebar-area">
        <div class="widget widget-letest-news">
            <div class="widget-title">
                <h2>Latest News:</h2>
            </div>

            <div class="news-list">

                <!--news para container-->
                <div class="blog-info">
                    @foreach($latestNews as $ln)
                        @php
                            $monthName = date('F',strtotime($ln->date)) ?? date('F',strtotime($ln->created_at));
                            $day = date('j',strtotime($ln->date)) ?? date('j',strtotime($ln->created_at));
                        @endphp
                        <div class="meta-thumb date-col">
                            <span class="day">{{$day ?? ''}}</span>
                            <span class="month">{{$monthName ?? ''}} </span>
                        </div>
                        <!--Content and Title-->
                        <div class="meta-content" style="min-height: 65px; margin-bottom: 20px;">
                            <a href="{{route('news.single', $ln->slug)}}">{{$ln->title ? substr($ln->title, 0, 60) : ''}}</a>
                        </div>
                        <!--Content and Title-->
                        <div class="meta-content">
                            <div class="media-box-border-shadow">
                                @if($ln->youtube_url)
                                    <section class="video-section">
                                        <div class="youtube-video">
                                            <iframe class="embed-responsive-item" src="{{ $ln->youtube_url }}"
                                                    allowfullscreen
                                            ></iframe>
                                        </div>
                                    </section>
                                @else
                                    <img src="{{ $ln->image_url ?? asset('assets/img/news/img01.jpg') }}"
                                         class="img-responsive" alt="news"/>
                                @endif
                            </div>
                        </div>
                        <hr/>
                    @endforeach
                    <a class="read-more" href="{{route('news.latestNews')}}">View All</a>
                </div>
            </div>
        </div>
    </div>
</div>
