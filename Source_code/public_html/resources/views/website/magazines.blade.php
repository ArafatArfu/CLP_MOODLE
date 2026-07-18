@extends('layouts.website')
@section('title', 'CLP | Magazines')
@section('content')
    <!-- End of theme_menu -->

    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Magazines</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">News & Publication</a>
                        </li>
                        <li>
                            Magazines
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <!--data-toggle="modal" data-target="#pdf_modal" -->
    <section class="cards-wrapper">
        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="{{asset('root/fileupload/magazines/Magazine-2025.pdf')}}"  style="--bg-img: url({{asset('root/assets/images/magazine/magazine-2024.jpg')}})">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2025</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>
            </a>
        </div>
        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="{{asset('root/fileupload/magazines/Magazine-2024.pdf')}}"  style="--bg-img: url({{asset('root/assets/images/magazine/magazine-2024.jpg')}})">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2024</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>
            </a>
        </div>
        <div class="card-grid-space">
           <a class="card-magazine" target="_blank" href="{{asset('root/fileupload/magazines/CLP_Magazine_2023.pdf')}}"  style="--bg-img: url({{asset('root/assets/images/magazine/mg_cover_2022.png')}})">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2023</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>
            </a>
        </div>
        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="{{asset('root/fileupload/magazines/CLP_Magazine_2022.pdf')}}"  style="--bg-img: url({{asset('root/assets/images/magazine/mg_cover_2022.png')}}">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2022</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>

            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="{{asset('root/fileupload/magazines/CLP_Magazine_2021.pdf')}}"  style="--bg-img: url({{asset('root/assets/images/magazine/mg_cover_2021.png')}}">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2021</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>

            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" href="{{asset('root/fileupload/magazines/CLP_Magazine 2020.pdf')}}"  style="--bg-img: url({{asset('root/assets/images/magazine/2020.webp')}}">
                <div class="ribbon-wrapper">
                    <div class="ribbon">2020</div>
                </div>
                <div class="tags">
                    <div class="tag">Read Now</div>
                </div>

            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2019" href="{{asset('root/fileupload/magazines/2019-CLP-Magazine.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2019.webp')}}">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2019</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2018" href="{{asset('root/fileupload/magazines/VAB_2018_CLP-Magazine-Final.pdf')}}"  style="--bg-img: url({{asset('root/assets/images/magazine/2019.webp')}}">
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
            <a class="card-magazine" target="_blank" data-label="2017" href="{{asset('root/fileupload/magazines/2017CLPMagazine(2017-07-20)0819AM.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2017.webp')}}">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2017</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2016" href="{{asset('root/fileupload/magazines/18-July-2016-6-PM-2016-UPDATED-CLP-Magazine.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2017.webp')}})">
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
            <a class="card-magazine" target="_blank" data-label="2015" href="{{asset('root/fileupload/magazines/CLP-Magazine-2015.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2015.webp')}}">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2015</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2014" href="{{asset('root/fileupload/magazines/2014-Magazine-Status-1August2014-Version-3.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2014.webp')}}">
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
            <a class="card-magazine" target="_blank" data-label="2013" href="{{asset('root/fileupload/magazines/2013-CLP-Magazine.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2013.webp')}}">
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
            <a class="card-magazine" target="_blank" data-label="2012" href="{{asset('root/fileupload/magazines/2012-CLP-Magazine.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2012.webp')}}">
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
            <a class="card-magazine" target="_blank" data-label="2011" href="{{asset('root/fileupload/magazines/2011-CLP-Magazine.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2011.webp')}}">
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
            <a class="card-magazine" target="_blank" data-label="2010" href="{{asset('root/fileupload/magazines/2010-CLP-Magazine.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2010.webp')}}">
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
            <a class="card-magazine" target="_blank" data-label="2009" href="{{asset('root/fileupload/magazines/2009-CLP-Magazine.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2009.webp')}}">
                <div>
                    <div class="ribbon-wrapper">
                        <div class="ribbon">2009</div>
                    </div>
                    <div class="tags">
                        <div class="tag">Read Now</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-grid-space">
            <a class="card-magazine" target="_blank" data-label="2008" href="{{asset('root/fileupload/magazines/2008-CLP-Magazine.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2008.webp')}}">
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
            <a class="card-magazine" target="_blank" data-label="2007" href="{{asset('root/fileupload/magazines/2007-CLP-Magazine.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2007.webp')}}">
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
            <a class="card-magazine" target="_blank" data-label="2006" href="{{asset('root/fileupload/magazines/2006-CLP-Magazine.pdf')}}" style="--bg-img: url({{asset('root/assets/images/magazine/2006.webp')}}">
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
