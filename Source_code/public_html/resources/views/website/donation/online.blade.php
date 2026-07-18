@extends('layouts.website')
@section('title', 'Donate Online')
@section('content')
    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 amazonSmile-left donate">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#GiveMonthly">Give Monthly</a></li>
                        <li><a data-toggle="tab" href="#DonateOnce">Donate Once</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="GiveMonthly" class="tab-pane fade in active">
                            <h4 style="Font-size:20px; margin: 0; padding: 0;">Make a monthly donation.</h4>
                            <p class="work_para" style="margin: 0; padding: 0px;">When you make a monthly donation, you
                                are helping create stability in our budget so that we can plan for the future. Monthly
                                donations go into the general donation funds. We accept donations through PayPal and
                                major credit cards.</p>
                            <div class="row">
                                <div style="margin-top: 15px;" class="donate-form-area">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-md-auto">
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div
                                                    style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px; color:black;">
                                                    <h5>All-Purpose</h5><br>
                                                    <p>
                                                        <a href="https://na01.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.paypal.com%2Fdonate%3Fhosted_button_id%3DTLHRWB5UGFECW&data=04%7C01%7C%7Cf24ef802b2da4b07daad08d8bbd824e5%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637465884285128282%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C1000&sdata=rRTVMs1SaMJig5DNQlN4YJduXsaLxadqo7ynOyaopjQ%3D&reserved=0">
                                                            <img style="border: none;" alt="donation"
                                                                 src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                                 class="donate-img"/>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div
                                                    style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px; color:black;">
                                                    <h5>Sherpur Project</h5><br>
                                                    <p>
                                                        <a href="https://na01.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.paypal.com%2Fdonate%3Fhosted_button_id%3DV6D3X44Q434VC&data=04%7C01%7C%7C55db0d88c5c0408b0deb08d8bbd957c2%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637465889434712419%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C1000&sdata=dBM7VYebTlhl%2BD9nki7ERXG9u3ajtdfduu0cNPJHauw%3D&reserved=0">
                                                            <img style="border: none;" alt="donate"
                                                                 src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                                 class="donate-img">
                                                        </a>
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 0 auto; padding-top:10px;">
                                        <p style="font-size: 20px; margin-bottom: 10px; margin-top: 5px; text-align: center;">
                                            Or</p>
                                        <div
                                            style="text-align: center; max-width: 196px; margin: 0 auto; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 10px; line-height: 22px; color:black; font-weight:bold;">
                                            Mail Check payable to CLP, 6 Tharp Lane, Marlboro, NJ07746.
                                        </div>
                                    </div>
                                    <div style="margin: 0 auto; width: 100%; text-align: center; color:black;">
                                        <strong>Tax ID # 46-0646134</strong>
                                    </div>
                                </div>
                            </div>
                            <h4>Donor Information</h4>
                            <div class="row donation-form">
                                @if ($errors->any())
                                    <div class="btn btn-danger" onclick="anim4_noti()">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div><br/>
                                @endif

                                <form method="post" action="{{ route('donation.store') }}">
                                    @csrf
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <select class="form-control" name="founds">
                                                <option value="general">General Funds</option>
                                                <option value="other">Other Funds</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="other" class="form-control" placeholder="Other"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Other'">
                                        </div>
                                    </div>
                                    <div class="row donation-form">
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="first_name"
                                                       placeholder="First Name*" onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='First Name*'">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="last_name"
                                                       placeholder="Last Name*" onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='Last Name*'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="address_one"
                                                       placeholder="Address 1*" onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='Address 1*'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="address_two"
                                                       placeholder="Address 2" onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='Address 2'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="city" placeholder="City*"
                                                       onfocus="this.placeholder=''" onblur="this.placeholder='City*'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="row">
                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="state"
                                                               placeholder="State*" onfocus="this.placeholder=''"
                                                               onblur="this.placeholder='State*'">
                                                    </div>
                                                </div>
                                                <div class="col-sm-8 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="zip"
                                                               placeholder="Zip*"
                                                               onfocus="this.placeholder=''"
                                                               onblur="this.placeholder='Zip*'">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="country"
                                                       placeholder="Country*"
                                                       onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='Country*'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email"
                                                       placeholder="Email*"
                                                       onfocus="this.placeholder=''" onblur="this.placeholder='Email*'">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone" placeholder="Phone"
                                                       onfocus="this.placeholder=''" onblur="this.placeholder='Phone'">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                        <textarea name="message" rows="6" class="form-control textarea"
                                                  placeholder="Special Instructions (Optional)"
                                                  onfocus="this.placeholder=''"
                                                  onblur="this.placeholder='Special Instructions (Optional)'"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="examplecheck"
                                                       id="exampleCheck">
                                                <label class="form-check-label work_para" for="exampleCheck">Subscribe
                                                    me to the
                                                    email list so that I hear about upcoming events, volunteer
                                                    opportunities,
                                                    latest success stories and more.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <h4>Verification</h4>
                                    <div class="row donation-form">
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="please-label">Please enter any two digits *</label>
                                                <input type="text" class="form-control" name="example"
                                                       placeholder="Example: 12"
                                                       onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='Example: 12'">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="read-more">Proceed</button>
                                </form>
                            </div>
                            <div id="DonateOnce" class="tab-pane fade">
                                <h4 style="Font-size:20px; margin: 0; padding: 0;">Make a one-time donation.</h4>
                                <p class="work_para" style="Font-Size:2vh; margin: 0; padding: 0px;">Your donation of
                                    any
                                    amount will help us with essentials like maintaining the technical field support
                                    team so
                                    that we can continue to do this work. You may choose to allocate your donation to
                                    the
                                    Sherpur Projects or to the general donation funds. We accept donations through
                                    PayPal
                                    and major credit cards.</p>

                                <!-- <h4>Donation Amount</h4> -->
                                <div style="margin-top: 15px;" class="donate-form-area">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!--<p style="margin:30px 0;"><strong style="color: #00140F; font-size: 24px; line-height: 32px; font-weight: bold;">Donate to CLP</strong></p>-->

                                            <div class="row">
                                                <div class="col-sm-6 col-xs-12">
                                                    <div
                                                        style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px;">
                                                        <h5>All Project</h5>
                                                        <form action="https://www.paypal.com/cgi-bin/webscr"
                                                              method="post"
                                                              target="_blank"><input name="cmd" type="hidden"
                                                                                     value="_s-xclick"/><br/><input
                                                                name="hosted_button_id" type="hidden"
                                                                value="9NLRSFG7QPK78"/><input
                                                                alt="PayPal - The safer, easier way to pay online!"
                                                                name="submit"
                                                                src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                                type="image" style="margin: 0 auto;"/><br/><img
                                                                src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                                                alt="" width="1" height="1" border="0"/></form>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-xs-12">
                                                    <div
                                                        style="text-align: center; border: solid 1px #ccc; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px;">
                                                        <h5>Sherpur Project</h5>
                                                        <form action="https://www.paypal.com/cgi-bin/webscr"
                                                              method="post"
                                                              target="_top"><input name="cmd" type="hidden"
                                                                                   value="_s-xclick"/><input
                                                                name="hosted_button_id" type="hidden"
                                                                value="HF57H5DMKZDTA"/><br/><input
                                                                title="PayPal - The safer, easier way to pay online!"
                                                                alt="Donate with PayPal button"
                                                                name="submit"
                                                                src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                                                type="image" style="margin: 0 auto;"/><br/><img
                                                                src="https://www.paypal.com/en_US/i/scr/pixel.gif"
                                                                alt=""
                                                                width="1"
                                                                height="1" border="0"/>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin: 0 auto; padding-top:10px;">
                                                <p style="font-size: 20px; margin-bottom: 10px; margin-top: 5px; text-align: center;">
                                                    Or</p>
                                                <div
                                                    style="text-align: center; max-width: 196px; margin: 0 auto; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 10px; line-height: 22px; color:black; font-weight:bold;">
                                                    Mail Check payable to CLP, 6 Tharp Lane, Marlboro, NJ07746.
                                                </div>
                                            </div>
                                            <div style="margin: 0 auto; width: 100%; text-align: center; color:black;">
                                                <strong>Tax ID # 46-0646134</strong>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <h4>Donor Information</h4>
                                <div class="row donation-form">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="First Name*"
                                                   onfocus="this.placeholder=''"
                                                   onblur="this.placeholder='First Name*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Last Name*"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Last Name*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Address 1*"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Address 1*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Address 2"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Address 2'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="City*"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='City*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="State*"
                                                           onfocus="this.placeholder=''"
                                                           onblur="this.placeholder='State*'">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Zip*"
                                                           onfocus="this.placeholder=''"
                                                           onblur="this.placeholder='Zip*'">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Country*"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Country*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Email*"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Email*'">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Phone"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Phone'">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <textarea name="form_message" rows="6" class="form-control textarea"
                                                  placeholder="Special Instructions (Optional)"
                                                  onfocus="this.placeholder=''"
                                                  onblur="this.placeholder='Special Instructions (Optional)'"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Subscribe me to the
                                                email
                                                list so that I hear about upcoming events, volunteer opportunities,
                                                latest
                                                success stories and more.</label>
                                        </div>
                                    </div>
                                </div>
                                <h4>Verification</h4>
                                <div class="row donation-form">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="please-label">Please enter any two digits *</label>
                                            <input type="text" class="form-control" placeholder="Example: 12"
                                                   onfocus="this.placeholder=''"
                                                   onblur="this.placeholder='Example: 12'">
                                        </div>
                                    </div>
                                </div>
                                <div class="row donation-form">
                                    <div class="col-sm-4 col-xs-12">
                                        <a href="#" class="read-more">Proceed to PayPal</a>
                                    </div>
                                    <div class="col-sm-8 col-xs-12">
                                        <p class="after-clicking work_para">After clicking this button, PayPal will give
                                            you
                                            the option to continue with PayPal or pay with a credit card.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of tab-content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('website.partials.actions')
@endsection
