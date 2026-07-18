<section class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-5">
                <ul class="social-icon">
                    <li>
                        <a href="https://www.facebook.com/CLPUSAA" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/clp_usa" target="_blank"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/channel/UC3CIzUUXeDXspImUjubA19A" target="_blank"><i
                                class="fa fa-youtube"></i></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/clp_usa/" target="_blank"><i class="fa fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-8 col-xs-7 text-right">
                <!--<button class="thm-btn donate-box-btn">donate</button>-->
                <a href="#" class="thm-btn donate-box-btn">
                    Donate
                </a>
            </div>
        </div>
    </div>
</section>
<!-- End of top-bar -->

<section class="theme_menu stricky">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="main-logo">
                    <a href="/">
                        <img alt="" src="{{ asset('root/assets/images/logo/clp-logo-2022-4.png') }}"/>
                    </a>
                </div>
            </div>
            <!--main nav start-->
            <div class="col-md-9 menu-column">
                <nav class="defaultmainmenu" id="main_menu">
                    <ul class="defaultmainmenu-menu">
                        <!--about us-->
                        <li>
                            <a href="{{ route('website.team') }}">ABOUT US</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="{{ route('website.history') }}">HISTORY</a>
                                </li>
                                <li>
                                    <a href="{{ route('website.mission') }}">MISSION</a>
                                </li>
                                <li>
                                    <a href="{{ route('website.impact') }}">IMPACT</a>
                                </li>
                                <li>
                                    <a href="{{ route('website.partners') }}">PARTNERS</a>
                                </li>
                                <li>
                                    <a href="{{ route('website.team') }}">OUR TEAM</a>
                                </li>
                                <li>
                                    <a href="{{ route('website.faq') }}">FAQ</a>
                                </li>
                            </ul>
                        </li>
                        <!--OUR WORK-->
                        <li>
                            <a href="#">OUR WORK</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="{{ route('website.clcTeaching') }}">COMPUTER LITERACY CENTER (CLC)</a>
                                </li>
                                <li>
                                    <a href="{{ route('website.smartClassRoom') }}">SMART CLASSROOM (SCR)</a>
                                </li>
                                <li>
                                    <a href="{{ route('website.remoteVolunteer') }}">
                                        REMOTE VOLUNTARY TEACHING
                                        (RVT)
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('website.connectStudents') }}">
                                        CONNECT STUDENTS AROUND THE
                                        WORLD
                                        (CSAW)
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('website.educationThroughEntertainment') }}">EDUCATION THROUGH
                                        ENTERTAINMENT (EE)</a>
                                </li>

                                <li>
                                    <a href="{{ route('website.successStories') }}">SUCCESS STORIES</a>
                                </li>

                                <li>
                                    <a href="#">MORE PROGRAMS</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a style="font-size: 12px;" href="{{ route('website.tokai') }}">Sponsor a
                                                TOKAI(টোকাই)-CLC</a>
                                        </li>

                                        <li>
                                            <a style="font-size: 12px;"
                                               href="{{ route('website.fiveDollarGraduate') }}">5$
                                                CLP Graduate</a>
                                        </li>
                                        <li>
                                            <a style="font-size: 12px;"
                                               href="{{ route('website.curriculumDevelopment') }}">Curriculum
                                                Development</a>
                                        </li>
                                        <li>
                                            <a style="font-size: 12px;"
                                               href="{{ route('website.trainingMaterial') }}">Develop
                                                Training
                                                Material</a>
                                        </li>
                                        <li>
                                            <a style="font-size: 12px;"
                                               href="{{ route('website.teacherTrainingProgram') }}">Teacher
                                                Training
                                                Program</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Centers</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="#">BE A SPONSOR</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a style="text-transform: none;"
                                               href="{{ route('website.sponsorClc') }}">Sponsor
                                                a CLC</a>
                                        </li>
                                        <li>
                                            <a style="text-transform: none;"
                                               href="{{ route('website.sponsorScr') }}">Sponsor
                                                a SCR</a>
                                        </li>
                                        <li>
                                            <a style="text-transform: none;"
                                               href="{{ route('website.sponsorTokai') }}">Sponsor a
                                                Tokai(টোকাই)-CLC</a>
                                        </li>

                                        <li>
                                            <a style="text-transform: none;"
                                               href="{{ route('donation.sponsorComputer') }}">Sponsor
                                                a Computer</a>
                                        </li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('website.schoolInfo') }}">All CENTERS</a>
                                </li>
                                <li>
                                    <a href="{{ route('website.searchCenter') }}">SEARCH CENTERS</a>
                                </li>
                            </ul>
                        </li>
                        <!--SHERPUR PROJECT-->
                        <li>
                            <a style="text-transform: none;"
                               href="{{ route('website.sherpurpr') }}">SHERPUR PROJECT</a>
                        </li>
                        
                        <!--News and Reports-->
                        <li>
                            <a href="#">NEWS & REPORTS</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="{{ route('news.newsCoverage') }}">NEWS COVERAGE</a>
                                </li>
                                <li>
                                    <a href="{{ route('news.latestNews') }}">CLP BLOG</a>
                                </li>
                                <li>
                                    <a href="#">REPORT</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a href="/eos-evaluation-report-01">E. O. S.
                                                EVALUATION REPORT</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('website.evaluationReport') }}">INDEPENDENT
                                                EVALUATION REPORT</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('website.formativeReports') }}">FORMATIVE REPORT</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('website.annualReport') }}">ANNUAL REPORT</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('website.magazines') }}">MAGAZINES</a>
                                </li>
                                <li>
                                    <a href="{{ route('website.brochure') }}">BROCHURE</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">BE A SPONSOR</a>
                            <ul class="dropdown">
                                <li>
                                    <a style="text-transform: none;" href="{{ route('website.sponsorClc') }}">Sponsor a
                                        CLC</a>
                                </li>
                                <li>
                                    <a style="text-transform: none;" href="{{ route('website.sponsorScr') }}">Sponsor a
                                        SCR</a>
                                </li>
                                <li>
                                    <a style="text-transform: none;" href="{{ route('website.sponsorTokai') }}">Sponsor
                                        a
                                        Tokai(টোকাই)-CLC</a>
                                </li>
                                <li>
                                    <a style="text-transform: none;" href="{{ route('donation.sponsorComputer') }}">Sponsor
                                        a
                                        Computer</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">JOIN US</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="{{ route('donation.form') }}">Donation Form</a>
                                </li>
                                <li>
                                    <a href="#">DONATE</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a href="{{ route('donation.index') }}">DONATE ONLINE</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('donation.mail') }}">DONATE BY MAIL</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('donation.amazonSmile') }}">DONATE BY AMAZON SMILE</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('website.volunteer') }}">BE A VOLUNTEER</a>
                                </li>
                                <li>
                                    <a href="{{ route('website.contactUs') }}">CONTACT US</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
