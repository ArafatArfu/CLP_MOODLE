@extends('layouts.website')
@section('title', 'CLP | Independent Evaluation Report')
@section('content')
<section class="inner-banner">
    <div class="container">
        <div class="box">
            <h1>Essential Office skills Course evaluation Report </h1>
            <div class="breadcumb-wrapper">
                <ul class="list-inline link-list">
                    <li>
                        <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">News</a>
                    </li>
                    <li>
                        Essential Office skills Course evaluation Report
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

            <div class="col-sm-12 col-xs-12 amazonSmile-left">
                <h4>Executive Summary</h4>

                <p class="work_para"><br>
                    The Essential Office Skills (EOS) Course Evaluation Report provides a detailed review of a
                    three-month training program developed by CLP and PI to enhance job seekers' professional skills.
                    Covering key topics such as job interview techniques, professional excellence, office etiquette,
                    business communication, ICT skills, and English proficiency, the program followed a blended learning
                    approach with 60 hours of expert-led instruction and hands-on activities. The evaluation revealed
                    high participant satisfaction, with 100% agreeing on its relevance for job seekers and 91% reporting
                    valuable new learning, particularly in English training and interview preparation, as well as online
                    sessions and instructor professionalism. Areas for improvement included better Bangla translations
                    in English lessons, stronger ICT training, improved internet connectivity, and enhanced classroom
                    facilities. Assessments showed strong written test performance, but ICT and presentation skills
                    needed improvement, with 72% of participants scoring above average. Recommendations include updating
                    course content to align with job market trends, making English training more interactive, improving
                    learning infrastructure, and integrating hybrid learning models for hands-on experience. Overall,
                    the EOS program has proven highly effective in preparing job seekers for the workplace, bridging
                    skill gaps, and fostering professional growth, making it a valuable initiative for career
                    development.
                </p>

                <p style="text-align: center;">
                    <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#eosModal"><strong>View the
                            Report</strong></a>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- End of formative-reports-wrap -->

<!-- Modal -->
<div style="padding: 90px;" class="modal fade" id="eosModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button style="font-size:30px;" type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Essential Office skills Course evaluation Report</h4>
            </div>
            <div class="modal-body">
                <object data="{{asset('root/fileupload/news/eos-report-01.pdf')}}" type="application/pdf"
                    frameborder="0" width="100%" height="600px">
                    <p class="work_para">If you are unable to view the pdf on mobile browser then please click the
                        button below to download the pdf file </p>
                    <p style="text-align: center;"><a class="btn btn-primary btn-lg"
                            href="{{asset('root/fileupload/news/eos-report-01.pdf')}}"><strong>Download
                                the Report</strong></a></p>
                </object>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- End of clp-footer -->
@include('website.partials.actions')
@endsection