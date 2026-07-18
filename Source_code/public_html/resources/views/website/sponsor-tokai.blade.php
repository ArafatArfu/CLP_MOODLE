@extends('layouts.website')
@section('title', 'Sponsor a Tokai-CLC')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box">
                <h1>Be a Sponsor</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Get
                                Involved</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Be a Sponsor</a>
                        </li>
                        <li>
                            Sponsor a Tokai(টোকাই)-CLC
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section class="amazonSmile-wrap sec-padd">
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12 col-xs-12 amazonSmile-left donate">
                    <h4 class="mrg-top-remove">Sponsor a <a href="{{ route('website.tokai') }}">Tokai(টোকাই)-CLC</a>
                        today!</h4>
                    <p class="work_para">Starting in 2005, CLP has built {{ $general->total_clc_count }} CLC to date <a
                            target="_blank" href="{{ route('website.schoolInfo') }}">(see tokai clc center list)</a>.
                        Out of these, {{ $general->total_supportedcenter_count }} centers are being supported by the
                        sponsors and CLP is ensuring smooth operation of these centers to produce digitally literate
                        graduates when schools are in session. 8 Tokai CLCs have resurrected till now and you can
                        sponsor an unsupported center that remained uncared for and gradually ceased digital literacy
                        training program.</p>
                    <p class="work_para">*Your donation may be considered US tax-deductible.</p>
                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                            data-target="#collapseWidthDetails" aria-expanded="false"
                            aria-controls="collapseWidthDetails">
                        Know More
                    </button>
                    <div class="collapse width mt-5" id="collapseWidthDetails">
                        <div class="row sponsor-clc-scr">
                            <div class="col-sm-12 col-xs-12">
                                <div class="inner tokai">
                                    <h4>Sponsor a Tokai (টোকাই) CLC center for <strong>
                                            {{ $general->tokai_sponsorship_price }}
                                        </strong> and bring the following resources to your school:</h4>
                                    <ul class="work_para">
                                        <li>Resurrection of tokai CLC center</li>
                                        <li>Structured curriculum</li>
                                        <li>Teachers’ guide</li>
                                        <li>Training of one teacher</li>
                                        <li>Incentive remuneration for teachers with every month activity for 12 months*
                                        </li>
                                        <li>One year maintenance contract</li>
                                    </ul>
                                    <p class="notes work_para"><i>*Teacher remuneration and equipment maintenance will
                                            continue if the donor continues to support center maintenance by donating
                                            $300/year.</i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Tokai-CLC Online Pledge Form</h4>
                    <p style="text-align: right; font-size: small;"><i>* marked fields are required</i></p>
                    <div class="row donation-form">
                        <!--form starts here-->
                        <div class="row donation-form">
                            <form method="post" action="{{route('sponsor.mail')}}">
                                {{ csrf_field() }}
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="full_name" class="form-control"
                                               placeholder="Full Name*" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='Full Name*'" value="{{ old('full_name') }}"
                                               required>
                                        <div style="color:red;">{{ $errors->first('full_name') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="address_one" class="form-control"
                                               placeholder="Address 1*" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='Address 1'" value="{{ old('address_one') }}"
                                               required>
                                        <div style="color:red; padding: 2px;">{{ $errors->first('address_one') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="address_two" class="form-control"
                                               placeholder="Address 2" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='Address 2'" value="{{ old('address_two') }}">
                                        <div style="color:red; padding: 2px;">{{ $errors->first('address_two') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="city" class="form-control" placeholder="City*"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='City'"
                                               value="{{ old('city') }}" required>
                                        <div style="color:red; padding: 2px;">{{ $errors->first('city') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" name="state" class="form-control"
                                                       placeholder="State*" onfocus="this.placeholder=''"
                                                       onblur="this.placeholder='State'" value="{{ old('state') }}"
                                                       required>
                                                <div
                                                    style="color:red; padding: 2px;">{{ $errors->first('state') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" name="zip" class="form-control" placeholder="Zip*"
                                                       onfocus="this.placeholder=''" onblur="this.placeholder='Zip'"
                                                       value="{{ old('zip') }}" required>
                                                <div style="color:red; padding: 2px;">{{ $errors->first('zip') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="country" class="form-control" placeholder="Country*"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Country'"
                                               value="{{ old('country') }}" required>
                                        <div style="color:red; padding: 2px;">{{ $errors->first('country') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="Email*"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Email*'"
                                               value="{{ old('email') }}" required>
                                        <div style="color:red; padding: 2px;">{{ $errors->first('email') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="number" name="phone" class="form-control" placeholder="Phone*"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Phone*'"
                                               value="{{ old('phone') }}" required>
                                        <div style="color:red; padding: 2px;">{{ $errors->first('phone') }}</div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="instituition" class="form-control"
                                               placeholder="Name of the Institution" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='Name of the Institution'"
                                               value="{{ old('instituition') }}">
                                        <div style="color:red; padding: 2px;">{{ $errors->first('instituition') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="location" class="form-control" placeholder="Location"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Location'"
                                               value="{{ old('location') }}">
                                        <div style="color:red; padding: 2px;">{{ $errors->first('location') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="contact" class="form-control"
                                               placeholder="Contact Person" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='Contact Person'" value="{{ old('contact') }}">
                                        <div style="color:red; padding: 2px;">{{ $errors->first('contact') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="phone2" class="form-control" placeholder="Phone"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Phone'"
                                               value="{{ old('phone2') }}">
                                        <div style="color:red; padding: 2px;">{{ $errors->first('phone2') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="donateBy" class="form-control" placeholder="Donated By"
                                               onfocus="this.placeholder=''" onblur="this.placeholder='Donated By'"
                                               value="{{ old('donateBy') }}">
                                        <div style="color:red; padding: 2px;">{{ $errors->first('donateBy') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="memory" class="form-control"
                                               placeholder="In Memory Of (please specify)" onfocus="this.placeholder=''"
                                               onblur="this.placeholder='In Memory Of (please specify)'"
                                               value="{{ old('memory') }}">
                                        <div style="color:red; padding: 2px;">{{ $errors->first('memory') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <textarea name="instruction" rows="6" class="form-control textarea"
                                                  placeholder="Special Instructions (Optional)"
                                                  onfocus="this.placeholder=''"
                                                  onblur="this.placeholder='Special Instructions (Optional)'"
                                                  value="{{ old('instruction') }}"></textarea>
                                        <div style="color:red; padding: 2px;">{{ $errors->first('instruction') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="exampleCheck3" class="form-check-input"
                                               id="exampleCheck3" value="1">
                                        <label class="form-check-label work_para" for="exampleCheck3">Subscribe me to
                                            the email list so that I hear about upcoming events, volunteer
                                            opportunities, latest success stories and more.</label>
                                    </div>
                                </div>
                                <h4>Verification</h4>
                                <div class="row donation-form">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="please-label">Please enter any two digits *</label>
                                            <input type="text" name="valid" class="form-control"
                                                   placeholder="Example: 12"
                                                   onfocus="this.placeholder=''" onblur="this.placeholder='Example: 12'"
                                                   required>
                                            <div style="color:red; padding: 2px;">{{ $errors->first('valid') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <input type="submit" name="pledge" class="read-more" value="Submit"/>
                                </div>
                            </form>
                            {{-- @include('website.form.sponsor-form', ['formAction' => route('mail.tokaiPledge')]) --}}
                        </div>
                        <!--form ends here-->
                        <div class="row donation-form">
                            <div class="col-sm-8 col-xs-12">
                                <p class="after-clicking work_para">After clicking this button, PayPal will give you the
                                    option to continue with PayPal or pay with a credit card.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('website.partials.actions')
@endsection
