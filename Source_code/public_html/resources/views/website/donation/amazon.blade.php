@extends('layouts.website')
@section('title', 'CLP | Help CLP Through AmazonSmile')
@section('content')
    <!-- End of theme_menu -->
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Donate by AmazonSmile</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Get Involved</a>
                        </li>
                        <li>
                            Donate by AmazonSmile
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->
    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 amazonSmile-left">
                    <p class="work_para">When you shop at Amazon through AmazonSmile, a percentage of your Amazon
                        purchase will be donated to the charity of your choice. CLP is registered with AmazonSmile as a
                        charitable organization, so be sure to shop through AmazonSmile for your next Amazon purchase
                        and select "<strong>Computer Literacy Program, Marlboro</strong>" as your charity of choice.
                        Amazon will contribute 0.5% to CLP at no additional cost to you.</p>
                    <h4>All you need to do…</h4>
                    <h5 class="work_para">If you have already registered with AmazonSmile</h5>
                    <ul class="list-group work_para">
                        <li class="list-group-item">
                            Get on the AmazonSmile page by clicking this <a target="_blank"
                                                                            href="https://smile.amazon.com/ch/46-0646134"><strong>link</strong></a>
                        </li>
                        <li class="list-group-item">If you are not signed in, please sign in to the AmazonSmile.</li>
                        <li class="list-group-item">If you have already signed in then a window will appear on your
                            screen where AmazonSmile will ask you to choose CLP as your charity of choice.<img style="
    margin: 0 auto;" src="{{ asset('root/assets/images/amazonsmile/smile_1.png') }}" alt="img" class="img-responsive"/>
                            Be sure you have clicked the button shown above and you got the "Thank You" window.
                        </li>
                        <li class="list-group-item">Once it has acknowledged, just shop normally as you do and
                            AmazonSmile will do the rest. Once again it does not cost you anything.
                        </li>
                    </ul>
                    <h5 class="work_para">If you are not registered with AmazonSmile</h5>

                    <ul class="list-group work_para">
                        <li class="list-group-item">
                            Get on the AmazonSmile page by clicking this <a target="_blank"
                                                                            href="https://smile.amazon.com/ch/46-0646134">link</a>
                        </li>
                        <li class="list-group-item">Please register for AmazonSmile.</li>
                        <li class="list-group-item">After successful registration a window (please see the image below)
                            will appear on your screen where AmazonSmile will ask you to choose CLP as your charity of
                            choice. Please check tick mark on the red maked box and then finally click on the "Strat
                            Shopping" button.<img src="{{ asset('root/assets/images/amazonsmile/smile_2.png') }}"
                                                  alt="img"
                                                  class="img-responsive"/>
                        </li>
                        <li class="list-group-item">Once it has acknowledged, just shop normally as you do and
                            AmazonSmile will do the rest. Once again it does not cost you anything.
                        </li>
                    </ul>
                    <p class="work_para">Let us know if you face any trouble. This will mean a lot for the program.</p>

                    <h6 class="note work_para">Please share this link on social media and tag 3 friends to spread to the
                        word. We are looking forward to your support!</h6>
                </div>
            </div>
        </div>
    </section>
    <!-- End of amazonSmile-wrap -->
    @include('website.partials.actions')
@endsection
