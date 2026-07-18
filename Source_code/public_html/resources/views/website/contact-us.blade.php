@extends('layouts.website')
@section('title', 'CLP | Contact Us')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Contact Us</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            Contact Us
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="our-dedicated sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <p style="font-size: 14px;" class="work_para">Our dedicated teams in the USA, Canada, and Bangladesh
                        are waiting to hear from you! We are open to connecting, whether you have questions about our
                        sponsorship options, you are researching an article about CLP, or something else. Please locate
                        the contact person for your country of residence in the list below. To contact a specific
                        officer or member of our team, <a href="our-team"><strong>please visit the team
                                page</strong></a>.</p>

                    <p style="font-size: 14px;" class="work_para">Looking for the volunteer form? <a
                            href="{{route('website.volunteer')}}"><strong>Submit your contact details</strong></a> and
                        the right team member will reach out to you for next steps.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of our-dedicated -->


    <section class="general-inquiries sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <h4>General Inquiries</h4>

                    <p class="work_para">General inquiries will be sent to CLP headquarters in New Jersey, USA and
                        responded to within 2 business days.</p>
                    @if ($errors->any())
                        <div class="btn btn-danger" onclick="anim4_noti()">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p class="work_para" style="color:red"><i>Please mail your query directly to clp@clpweb.org </i></p>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <img src="{{asset('root/assets/images/contact-us-img.png')}}" alt="img" class="img-responsive"/>
                </div>
            </div>
        </div>
    </section>

    <!-- End of general-inquiries -->

    <section class="sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h4 class="country-name">USA</h4>
                    <div class="container">
                        <ul class="contact-us-list">
                            <li>
                                <h5>CLP Headquarters</h5>
                                <p>6 Tharp Lane</p>
                                <p>Marlboro, NJ 07746, USA</p>
                                <p>(732) 972-8362</p>
                                <p>clp@clpweb.org</p>
                            </li>
                            <li>
                                <h5>Dr. Mohammad Farooque</h5>
                                <p><strong>President</strong></p>
                                <p>(732) 829-0341</p>
                                <p>vabnj@hotmail.com</p>
                            </li>
                            <li>
                                <h5>Dr. Farrukh Mohsen</h5>
                                <p><strong>Vice President</strong></p>
                                <p>(609) 273-3265</p>
                                <p>farrukhmohsen@yahoo.com</p>
                            </li>
                            </br>
                            <li>
                                <h5>Dr. Sayeed Hasan </h5>
                                <p><strong>General Secretary </strong></p>
                                <p>732-910-9096 </p>
                                <p>Sayeed443@gmail.com</p>
                            </li>
                        </ul>
                    </div>
                    <h4 class="country-name">Bangladesh</h4>
                    <div class="container">
                        <p class="please-use work_para">Please use the contact details below to get in touch with our
                            Bangladesh volunteer </p>
                        <ul class="contact-us-list">
                            <li>
                                <h5>Dr. Molla Azfarul Haque</h5>
                                <p>Email: to_molla@yahoo.com</p>
                                <p>Phone: +8801720096043</p>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End of contact-wrap -->


    <!-- End of clp-footer -->

    @include('website.partials.actions')

@endsection


