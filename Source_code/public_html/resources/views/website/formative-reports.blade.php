@extends('layouts.website')
@section('title', 'CLP | Formative Reports')
@section('content')
    <!-- End of theme_menu -->
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Formative Reports</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">News & Publications</a>
                        </li>
                        <li>
                            Formative Reports
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="formative-reports-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <p class='work_para'>The objective of Smart Classroom model is to create a sustainable digital
                        learning environment for the secondary level students in mostly rural Bangladesh for achieving
                        maximum learning outcomes.</p>

                    <p class='work_para'>Smart Classrooms (SCR) are generally operated by the teachers and the school
                        authority is responsible for the security and maintenance issues. Multimedia contents are used
                        to conduct the classes. School authority is supposed to conduct classes regularly in this SCR.
                        Dnet team monitors these SCRs through field visit in the first year and through phone follow-up
                        regularly.</p>

                    <p class='work_para'>Dnet, Implementing partner of CLP, has conducted a formative survey to measure
                        the current status of Smart Classrooms through phone follow-up in February 2015. Randomly
                        selected Smart Classroom teachers have attended the survey over phone. A checklist had been
                        developed for the survey.</p>

                    <p class='work_para'>Out of 152 schools, 139 school teachers were responded according to their
                        feasibility. Teachers were being asked about regularities of taking smart class, classroom
                        maintenance and their interest for establishing new smart classrooms. Based on the
                        questionnaire, they responded very actively.</p>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <img src="{{asset('root/assets/images/formative-report-img.png')}}" alt="img" class="img-responsive">
                </div>
                <div class="col-sm-12 col-xs-12 amazonSmile-left">
                    <h4>Some major findings from the survey are given below:</h4>
                    <ul class="list-group work_para">
                        <li class="list-group-item">Most of the teachers conduct their class by using smart classroom on
                            regular basis;
                        </li>
                        <li class="list-group-item">Most of the schools get financial support from schools’ headmaster
                            and SMC members for renovating SCRs’ equipment;
                        </li>
                        <li class="list-group-item">The interest level of teachers were very high for establishing new
                            smart classroom in their schools;
                        </li>
                        <li class="list-group-item">Most of the teachers said they are more capable for maintaining new
                            SCRs’ equipment in proper way;
                        </li>
                        <li class="list-group-item">Most of the teachers said that they were not facing any equipment
                            related problem during their class conduction in smart classroom;
                        </li>
                        <li class="list-group-item">Almost all teachers manifested high level expression about the
                            necessities of more multimedia content for their smart classroom use;
                        </li>
                        <li class="list-group-item">Almost all of the students showed a high level of interest in case
                            of doing class in smart classroom;
                        </li>
                        <li class="list-group-item">Most of the teachers showed high level of interest for conducting
                            their class in multimedia classroom;
                        </li>
                        <li class="list-group-item">Headmasters and SMC members gave positive opinion about the
                            effectiveness of smart classroom, and most of the cases they monitor the classroom and give
                            feedback for enhancing the quality of learning.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of formative-reports-wrap -->
    @include('website.partials.actions')
@endsection
