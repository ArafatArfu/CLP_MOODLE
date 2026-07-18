@extends('layouts.website')
@section('title', 'CLP | Independent Evaluation Report')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Independent Evaluation Report</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">News</a>
                        </li>
                        <li>
                            Independent Evaluation Report
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
                <div class="col-sm-8 col-xs-12 amazonSmile-left">
                    <h4 class="mrg">An independent evaluation by a student from The Fletcher School of Law and
                        Diplomacy, Tufts University”, Boston, MA, USA</h4>

                    <p class="work_para">CLP (a successor organization of New Jersey chapter of the Volunteers
                        Association for Bangladesh (VAB-NJ) conceptualized the Computer Literacy Program as an
                        initiative through which CLCs would be established at educational institutions throughout
                        Bangladesh to help underprivileged youths learn computer usage. The CLP is a complete package
                        which includes the establishment of a computer lab at each CLC, development of a structured
                        hands-on curriculum, development of training manuals for both teachers and students, creation of
                        a pool of trained teachers, and providing the required technical support and monitoring to
                        ensure smooth operation of the computer labs. Each computer lab is equipped with a minimum of
                        four computers, one printer, necessary voltage regulator/stabilizers and other accessories. Dnet
                        implemented this vision. The on-the-ground tasks include site selection for CLCs, developing
                        curricula, preparing instruction manuals, training the teachers, supervising the smooth
                        operation of the centres, and technical support and maintenance. Dnet has the technical
                        expertise, innovative ideas for implementation, and the necessary motivation.</p>

                    <p class="work_para">Given the existence of a mature program management and operations capability on
                        the ground, a strong, proven basic curriculum, and well-functioning computer laboratories, Dnet
                        and CLP feel it is time to evaluate the impacts of CLCs as a precursor to considering
                        implementing value-added components. The study focus on the overall impact of CLCs and the CLP
                        course on the perceptions, attitudes and decision making processes for students, and the
                        assessment of this impact by teachers, head teachers and guardians. This study conducted by Mr.
                        Ashirul Amin, a Graduate Student (MALD) of “The Fletcher School of Law and Diplomacy, Tufts
                        University”, Boston, MA, USA.</p>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <img src="{{asset('root/assets/images/Angela.png')}}" alt="img" class="img-responsive">
                </div>
                <div class="col-sm-12 col-xs-12 amazonSmile-left">
                    <h4>Computer Literacy Program has been selected for evaluating based on Gender Evaluation
                        Methodology (GEM) for rural ICT4D project by “Association for Progressive Communications” a
                        South Africa based international organization.</h4>
                    <p class="work_para">Gender gaps that are widespread in access to basic rights, access to and
                        control of resources, in economic opportunities and also in power and political voice are an
                        impediment to development. Technologies are socially constructed and thus have direct impacts on
                        Gender. A rural ICT4D project cannot automatically address the gender divide in access, use and
                        appropriation for changing lives in positive ways. Association for Progressive Communications
                        (www.apc.org) Women’s Networking Support Program (APC WNSP) selected an ongoing project
                        operating by Dnet titled “Empowering underprivileged youth in Bangladesh through computer
                        literacy (CLP)” for applying their adopted Gender Evaluation Methodology (GEM) for rural ICT4D
                        project for evaluating the project.</p>

                    <p class="work_para">As a GEM practitioner Dnet has been applying GEM for its ICT4D projects
                        gradually. This is a one year research project, financed by APC WNCP. The project output will be
                        a report analyzing the gender dimension of the Computer Literacy Program. The GEM adaptation
                        process aims at sensitizing the project operation stakeholders about gender issues to become
                        more effective in creating access to computer training for the underprivileged. The main
                        research question is whether application of GEM makes a project more effective for the
                        community. For the research work we selected 30 schools as of CLP program starting date for
                        selecting old and new schools, Geographical distribution of schools, Rural-urban schools, girls,
                        boys and coeducation schools. The data gathering strategy was defined after defining the
                        evolution indicators. We collected data by conducting Focus Group Discussion, Observation and
                        case study and interviewed students, teachers, parents by questionnaire fill up. After
                        completing the survey a report had been prepared and submitted the report to APC WNCP and
                        CLP.</p>
                    <p style="text-align: center;">
                        <a class="btn btn-primary btn-lg" data-toggle="modal"
                           data-target="#myModal"><strong>View the Report</strong></a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of formative-reports-wrap -->

    <!-- Modal -->
    <div style="padding: 90px;" class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button style="font-size:30px;" type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">INDEPENDENT EVALUATION REPORT</h4>
                </div>
                <div class="modal-body">
                    <object data="{{asset('root/fileupload/news/CLP-Research-Final-Copy.pdf')}}" type="application/pdf"
                            frameborder="0"
                            width="100%" height="600px">
                        <p class="work_para">If you are unable to view the pdf on mobile browser then please click the
                            button below to download the pdf file </p>
                        <p style="text-align: center;"><a class="btn btn-primary btn-lg"
                                                          href="{{asset('root/fileupload/news/CLP-Research-Final-Copy.pdf')}}"><strong>Download
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
