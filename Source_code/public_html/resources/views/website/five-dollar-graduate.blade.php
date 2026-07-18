@extends('layouts.website')
@section('title', '$5 CLP Graduate')

@section('content')
    <!-- End of theme_menu -->
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>$5 CLP Graduate</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Our WORK</a>
                        </li>
                        <li>
                            $5 CLP Graduate
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="education-through-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <p class="work_para">CLP has recognized that there are appropriately equipped and functioning
                        computer labs in many rural schools in Bangladesh. While the computers are available for
                        students use, these labs are excellent resources for enhancing digital literacy among students
                        in these schools using the tested CLP Digital Literacy curriculum. CLP will be required to
                        arrange for adequate teacher incentive, overall supervision and persuade the school
                        administrations to introduce the CLP Curriculum in their schools.</p>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div style="border: 10px solid #f8f8ff;" class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item"
                                src="https://www.youtube.com/embed/gIsr226rNIg?autoplay=0&mute=0"
                                title="YouTube video player"
                                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen='0'></iframe>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <img src="{{asset('root/assets/images/5_graduate/5_graduate1.png')}}" alt="img"
                         class="img-responsive"/>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p class="work_para">CLP costs for this project include teacher honorarium (~ $150 per year per
                        school), Dnet supervision supports as well as miscellaneous support items (` $150 per year per
                        school). So, CLP will be able to produce digital literates at a very nominal cost from the
                        non-clp schools ($300 per school per year). It will cost $5 per graduate if each school is
                        tasked to produce at least 60 graduates per year. Schools and/or sponsors interested in this
                        program of producing digital literates may contact us immediately.</p>
                </div>
            </div>

            <div class="row">
                <p class="btn-area donate-now">
                    <a href="https://na01.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.paypal.com%2Fdonate%3Fhosted_button_id%3DTLHRWB5UGFECW&data=04%7C01%7C%7Cf24ef802b2da4b07daad08d8bbd824e5%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637465884285128282%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C1000&sdata=rRTVMs1SaMJig5DNQlN4YJduXsaLxadqo7ynOyaopjQ%3D&reserved=0"
                       class="thm-btn">Donate Now</a>
                </p>
            </div>
        </div>
    </section>
    <!-- End of education-through-wrap -->

    <!-- End of clp-footer -->

    @include('website.partials.actions')
@endsection
