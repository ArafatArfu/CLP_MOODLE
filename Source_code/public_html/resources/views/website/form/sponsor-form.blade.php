{{-- <form method="post" action="{{url('sendemail/clcpledge')}}"> --}}
<form method="post" action="{{ $formAction }}" onsubmit="disableSubmitButton()">
    {{ csrf_field() }}
    <div class="col-sm-6 col-xs-12">
        <div class="form-group">
            <input type="text" name="full_name" class="form-control"
                   placeholder="Full Name*"
                   onfocus="this.placeholder=''" onblur="this.placeholder='Full Name*'"
                   value="{{ old('full_name') }}" required>
            <div style="color:red;">{{ $errors->first('full_name') }}</div>
        </div>
    </div>
    <div class="col-sm-6 col-xs-12">
        <div class="form-group">
            <input type="text" name="address_one" class="form-control"
                   placeholder="Address 1*"
                   onfocus="this.placeholder=''" onblur="this.placeholder='Address 1'"
                   value="{{ old('address_one') }}" required>
            <div style="color:red; padding: 2px;">{{ $errors->first('address_one') }}</div>
        </div>
    </div>
    <div class="col-sm-6 col-xs-12">
        <div class="form-group">
            <input type="text" name="address_two" class="form-control"
                   placeholder="Address 2"
                   onfocus="this.placeholder=''" onblur="this.placeholder='Address 2'"
                   value="{{ old('address_two') }}">
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
                           placeholder="State*"
                           onfocus="this.placeholder=''" onblur="this.placeholder='State'"
                           value="{{ old('state') }}" required>
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
                   placeholder="Contact Person"
                   onfocus="this.placeholder=''" onblur="this.placeholder='Contact Person'"
                   value="{{ old('contact') }}">
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
                the
                email list so that I hear about upcoming events, volunteer opportunities,
                latest
                success stories and more.</label>
        </div>
    </div>
    <h4>Verification</h4>
    <div class="row donation-form">
        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="please-label">Please enter any two digits *</label>
                <input type="text" name="valid" class="form-control" placeholder="Example: 12"
                    onfocus="this.placeholder=''" onblur="this.placeholder='Example: 12'"
                    rquired>
                <div style="color:red; padding: 2px;">{{ $errors->first('valid') }}</div>
            </div>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <!--<a href="#" class="read-more">Submit</a>-->
        <input type="submit" id="submitBtn" name="pledge" class="read-more" value="Submit" />
    </div>

</form>

<script>
    function disableSubmitButton() {
        // Disable the submit button
        document.getElementById("submitBtn").disabled = true;
    }
</script>