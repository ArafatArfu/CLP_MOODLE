@extends('layouts.website')
@section('title', 'CLP | Volunteer')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Be a Volunteer or Intern with CLP</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">BE A VOLUNTEER</a>
                        </li>
                        <li>
                            Volunteer
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->
    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12 col-xs-12 amazonSmile-left donate">
                    <p class="extr-mrg-btm work_para">CLP invites you to participate in various volunteer opportunities.
                        You can join the volunteer team on a physical or virtual assignment.Computer Literacy Program
                        Volunteers for Underprivileged (CLP) is an organization of the volunteers, by the volunteers,
                        for the underprivileged. Adult and young (young adult and teen) volunteers play complementary
                        roles in designing, developing, and executing the programs and activities to further the CLP
                        mission to empower underprivileged youths through computer literacy training and
                        technology-enhanced education.</p>
                    <p>
                        <a class="read-more" data-toggle="collapse" href="#collapseExample" role="button"
                           aria-expanded="false" aria-controls="collapseExample">
                            Read More
                        </a>
                    </p>

                    <div class="volunteers-collapes collapse" id="collapseExample" aria-expanded="true" style="">
                        <h4><strong>Adult volunteers:</strong></h4>
                        <p class="work_para">help design and develop programs; facilitate field implementation of those
                            programs, monitor established programs and suggest improvements, support office activities
                            and seek new directions. They also engage in publicity and fund raising. Some are involved
                            in distant instruction, such as, teaching a science course in a rural school in Bangladesh
                            from a living room in the US. CLP seeks new adult volunteers to sustain and expand its
                            activities.</p>
                        <h4><strong>Young volunteers:</strong></h4>
                        <p class="work_para">help with different CLP activities while developing their volunteering
                            experience and credentials. Currently they help with publicity and organization of fund
                            raising events. They make phone calls to invite guests to CLP events, manage the
                            registration desk, decorate the venue, and support activities associated with the annual
                            fund raising event. Some young volunteers are involved in enhancing CLP’s social media
                            (Facebook, website, etc.) presence. Some volunteers are teaching students in remote long
                            distance classes. Opportunities exist for developing contents for CLP programs, such as,
                            Education through Entertainment. CLP has options for college students interested in
                            conducting educational projects in Bangladesh. CLP encourages new ideas and initiatives from
                            volunteers. To sum up, CLP seeks young volunteers to help with annual events, distant
                            instruction, website editing, managing social media publicity, organizing mini fund raising
                            events, and conducting educational projects abroad.To recognize the contribution of young
                            volunteers CLP provides certificates for volunteering hours accumulated by a volunteer. CLP
                            is a certifying organization for President’s Volunteer Service Award (PVSA) Program* since
                            2019. This program specially recognizes those who spend more time and efforts. The
                            requirements that the PVSA sets for different achievement levels for the Teen and Young
                            Adult volunteers are shown in the Table below.</p>
                        <h4><strong>Volunteering hours required in a calendar year to earn awards in each age
                                group:</strong></h4>
                        <p class="work_para">
                        <table class="tblpage">
                            <tr>
                                <th>Age Group</th>
                                <th>Bronze</th>
                                <th>Silver</th>
                                <th>Gold</th>

                            </tr>
                            <tr>
                                <td>Teens (11–15 years)</td>
                                <td>50–74 hours</td>
                                <td>75–99 hours</td>
                                <td>100+ hours</td>
                            </tr>
                            <tr>
                                <td>Young Adults (16–25 years)</td>
                                <td>100–174 hours</td>
                                <td>175–249 hours</td>
                                <td>250+ hours</td>
                            </tr>
                        </table>
                        </p>
                        <p class="work_para">
                            *To find out more about PVSA, please visit: <a
                                href="https://www.presidentialserviceawards.gov/eligibility"></a>https://www.presidentialserviceawards.gov/eligibility.
                            <br>
                            ** (CLP) is a 501c (3)US charity organization<br>
                            If you are interested in joining our volunteer team, please contact vabnj@hotmail.com or
                            submit a form below. Thank you for your very kind gesture.
                        </p>

                    </div>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <p><h5 class="work_para"><b>Adult volunteers:</b></h5> help design and develop programs;
                            facilitate field implementation of those programs, monitor established programs and suggest
                            improvements, support office activities and seek new directions. They also engage in
                            publicity and fund raising. Some are involved in distant instruction, such as, teaching a
                            science course in a rural school in Bangladesh from a living room in the US. CLP seeks new
                            adult volunteers to sustain and expand its activities.
                            <h5 class="work_para"><b>Young volunteers:</b></h5> help with different CLP activities while
                            developing their volunteering experience and credentials. Currently they help with publicity
                            and organization of fund raising events. They make phone calls to invite guests to CLP
                            events, manage the registration desk, decorate the venue, and support activities associated
                            with the annual fund raising event. Some young volunteers are involved in enhancing CLP’s
                            social media (Facebook, website, etc.) presence. Some volunteers are teaching students in
                            remote long distance classes. Opportunities exist for developing contents for CLP programs,
                            such as, Education through Entertainment. CLP has options for college students interested in
                            conducting educational projects in Bangladesh. CLP encourages new ideas and initiatives from
                            volunteers. To sum up, CLP seeks young volunteers to help with annual events, distant
                            instruction, website editing, managing social media publicity, organizing mini fund raising
                            events, and conducting educational projects abroad.To recognize the contribution of young
                            volunteers CLP provides certificates for volunteering hours accumulated by a volunteer. CLP
                            is a certifying organization for President’s Volunteer Service Award (PVSA) Program* since
                            2019. This program specially recognizes those who spend more time and efforts. The
                            requirements that the PVSA sets for different achievement levels for the Teen and Young
                            Adult volunteers are shown in the Table below.
                            <h5 class="work_para">Volunteering hours required in a calendar year to earn awards in each
                                age group:</h5>
                            <br>
                            <table class="tblpage">
                                <tr>
                                    <th>Age Group</th>
                                    <th>Bronze</th>
                                    <th>Silver</th>
                                    <th>Gold</th>

                                </tr>
                                <tr>
                                    <td>Teens (11–15 years)</td>
                                    <td>50–74 hours</td>
                                    <td>75–99 hours</td>
                                    <td>100+ hours</td>
                                </tr>
                                <tr>
                                    <td>Young Adults (16–25 years)</td>
                                    <td>100–174 hours</td>
                                    <td>175–249 hours</td>
                                    <td>250+ hours</td>
                                </tr>
                            </table>
                            <br>
                            <p>
                                *To find out more about PVSA, please visit: <a
                                    href="https://www.presidentialserviceawards.gov/eligibility">presidential service
                                    awards eligibility</a>
                                <br>
                                ** (CLP) is a 501c (3)US charity organization<br>
                                If you are interested in joining our volunteer team, please contact vabnj@hotmail.com or
                                submit a form below. Thank you for your very kind gesture.</p>
                        </div>
                    </div>
                    <h4>Volunteer Form</h4>
                    @if ($errors->any())
                        <div class="btn btn-danger" onclick="anim4_noti()">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br/>
                    @endif

                    <form method="post" action="{{ route('website.volunteerStore') }}">
                        @csrf

                        <p style="text-align: right; font-size: small;"><i>* marked fields are required</i></p>
                        <div class="row donation-form">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="first_name" class="form-control" required
                                           placeholder="First Name*" onfocus="this.placeholder=''"
                                           onblur="this.placeholder='First Name*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="last_name" class="form-control" required
                                           placeholder="Last Name*" onfocus="this.placeholder=''"
                                           onblur="this.placeholder='Last Name*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="address_one" class="form-control" required
                                           placeholder="Address 1*" onfocus="this.placeholder=''"
                                           onblur="this.placeholder='Address 1*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="address_two" class="form-control" placeholder="Address 2"
                                           onfocus="this.placeholder=''" onblur="this.placeholder='Address 2'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="city" class="form-control" required placeholder="City*"
                                           onfocus="this.placeholder=''" onblur="this.placeholder='City*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="state" class="form-control" required
                                                   placeholder="State*" onfocus="this.placeholder=''"
                                                   onblur="this.placeholder='State*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="zip" class="form-control" required
                                                   placeholder="Zip*" onfocus="this.placeholder=''"
                                                   onblur="this.placeholder='Zip*'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="country" class="form-control" placeholder="Country*"
                                           required onfocus="this.placeholder=''" onblur="this.placeholder='Country*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" required placeholder="Email*"
                                           onfocus="this.placeholder=''" onblur="this.placeholder='Email*'">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone*" required
                                           onfocus="this.placeholder=''" onblur="this.placeholder='Phone'">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <textarea name="message" rows="6" class="form-control textarea"
                                              placeholder="Comments (Optional)" onfocus="this.placeholder=''"
                                              onblur="this.placeholder='Comments (Optional)'"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="examplecheck"
                                           id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Subscribe me to the email list
                                        so that I hear about upcoming events, volunteer opportunities, latest success
                                        stories and more.</label>
                                </div>
                            </div>

                            <h4>Verification</h4>
                            <div class="row donation-form">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="please-label">Please enter any two digits *</label>
                                        <input type="text" name="example" class="form-control" placeholder="Example: 12"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Example: 12'"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="row donation-form">
                                <div class="col-sm-4 col-xs-12">
                                    <button type="submit" class="read-more">Submit</button>
                                </div>
                                <div class="col-sm-8 col-xs-12">
                                    <p class="after-clicking work_para">A member of our volunteer team will reach out to
                                        you
                                        shortly for placement at the right volunteer opportunity for you.</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End of amazonSmile-wrap -->

    <div class="donate-popup" id="donate-popup">
        <div class="close-donate theme-btn">
            <span class="fa fa-close"></span>
        </div>

        <div class="popup-inner">
            <div class="container">
                <div class="donate-form-area">
                    <div class="section-title center">
                        <h2>Donate</h2>
                    </div>


                    <!-- <h4>How much would you like to donate:</h4> -->
                    <div class="row">
                        <div class="col-sm-12">
                            <p style="margin:30px 0;"><strong
                                    style="color: #00140F; font-size: 24px; line-height: 32px; font-weight: bold;">Donate
                                    to CLP</strong></p>

                            <div class="row">
                                <div class="col-sm">
                                    <div
                                        style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px;">
                                        <!--  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank"><input name="cmd" type="hidden" value="_s-xclick" /><br /><input name="hosted_button_id" type="hidden" value="9NLRSFG7QPK78" /><input alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                 type="image" style="margin: 0 auto;" /><br /><img src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="" width="1" height="1" border="0" /><p style="color: Black">General-Purpose</p></form> -->
                                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post"
                                              target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick"/>
                                            <input type="hidden" name="hosted_button_id" value="HF57H5DMKZDTA"/>
                                            <input type="image"
                                                   src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                   type="image" style="margin: 0 auto;" border="0" name="submit"
                                                   title="PayPal - The safer, easier way to pay online!"
                                                   alt="Donate with PayPal button"/>
                                            <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif"
                                                 width="1" height="1"/>
                                        </form>

                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('website.partials.actions')
@endsection
