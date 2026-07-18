@extends('layouts.website')
@section('title', 'CLP | Annual Status Report')
@section('content')
    <!-- End of theme_menu -->
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Annual Report</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">News</a>
                        </li>
                        <li>
                            Annual Report
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->
    <section class="cards-wrapper">
        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="{{asset('root/fileupload/annual-report/2021-Year-End-Report.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2021.png')}})">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2021</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="{{asset('root/fileupload/annual-report/2020-Year-End-Report.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2020.png')}})">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2020</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>

            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="{{asset('root/fileupload/annual-report/2019-Year-End-Report.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2019.png')}})">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2019</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>

            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2019" href="{{asset('root/fileupload/annual-report/2018-Year-End-Report.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2018.png')}})">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2018</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2018"
               href="/fileupload/annual-report/2016-Year-End-Report-Final-Draft.pdf"
               style="--bg-img: url(https://clpweb.org/assets/images/annual_report/2016.png)">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2016</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2017" href="{{asset('root/fileupload/annual-report/2014_Year_End-Report.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2014.png')}})">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2014</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2016" href="{{asset('root/fileupload/annual-report/Annual_Report_2013.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2013.png')}})">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2013</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2015" href="{{asset('root/fileupload/annual-report/Annual-Report-2012.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2012.png')}})">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2012</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2014" href="{{asset('root/fileupload/annual-report/Annual-Report-2011.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2011.png')}})">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2011</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2013" href="{{asset('root/fileupload/annual-report/Annual-Report-2010.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2010.png')}})">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2010</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2012" href="{{asset('root/fileupload/annual-report/clp_status_2008.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2008.png')}})">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2008</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2011" href="{{asset('root/fileupload/annual-report/clp_status_2007.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2007.png')}})">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2007</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2010" href="{{asset('root/fileupload/annual-report/clp_status_2006.pdf')}}"
               style="--bg-img: url({{asset('root/assets/images/annual_report/2006.png')}})">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2006</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>
    </section>

    @include('website.partials.actions')

@endsection
