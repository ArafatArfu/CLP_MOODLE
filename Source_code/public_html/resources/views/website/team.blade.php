@extends('layouts.website')
@section('title')
    Our Team
@endsection

@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Our Team</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">About Us</a>
                        </li>
                        <li>
                            Our Team
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="officers-wrap sec-padd">
        <div class="container">
            <!--<h2 class="subtitle text-center">Officers</h2>-->
            <div class="row">
                <div class="team-item">
                    <p><img src="{{asset('root/assets/images/our-team/team-members1.png')}}" alt="img" class="img-responsive" /></p>
                    <h4>Dr. Mohammad Farooque</h4>
                    <h5>President</h5>
                    <p>(732) 829-0341</p>
                    <p>vabnj@hotmail.com</p>
                </div>
                <div class="team-item">
                    <p><img src="{{asset('root/assets/images/our-team/team-members2.png')}}" alt="img" class="img-responsive" /></p>
                    <h4>Dr. Farrukh N Mohsen</h4>
                    <h5>Vice President</h5>
                    <p>(609) 787-8727</p>
                    <p>farrukhmohsen@gmail.com</p>
                </div>
                <div class="team-item">
                    <p><img src="{{asset('root/assets/images/our-team/team-members3.png')}}" alt="img" class="img-responsive" /></p>
                    <h4>Ms. Lubna Kabir</h4>
                    <h5>Vice President</h5>
                    <p>(908) 218-9531</p>
                    <p>lubnakabir@hotmail.com</p>
                </div>
                <div class="team-item">
                    <p><img src="{{asset('root/assets/images/our-team/team-members4.png')}}" alt="img" class="img-responsive" /></p>
                    <h4>Dr. Sayeed Hasan</h4>
                    <h5>General Secretary</h5>
                    <p>(732) 910-9096</p>
                    <p>sayeed443@gmail.com</p>
                </div>
                <div class="team-item">
                    <p><img src="{{asset('root/assets/images/our-team/team-members5.png')}}" alt="img" class="img-responsive" /></p>
                    <h4>Mr. Amzad Khan</h4>
                    <h5>Treasurer</h5>
                    <p>(908) 380-1243</p>
                    <p>ahkhan48@hotmail.com</p>
                </div>
            </div>
        </div>
    </section>
@endsection
