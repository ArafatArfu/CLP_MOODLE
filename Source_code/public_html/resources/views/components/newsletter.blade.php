<h3 class="footer-title">Newsletter</h3>
<p>Sign up for the weekly newsletter to stay in touch about upcoming events, volunteer opportunities,
    latest success stories and more.</p>

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
<form class="subscribe-form" method="post" action="{{route('mail.send')}}">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="text" name="first_name" class="form-control" placeholder="First Name*"
               onfocus="this.placeholder=''" onblur="this.placeholder='First Name*'"
               value="{{ old('first_name') }}" required>

        <div style="color:red; padding: 2px;">{{ $errors->first('first_name') }}</div>
    </div>
    <div class="form-group">
        <input type="text" name="last_name" class="form-control" placeholder="Last Name*"
               onfocus="this.placeholder=''" onblur="this.placeholder='Last Name*'"
               value="{{ old('last_name') }}" required>

        <div style="color:red; padding: 2px;">{{ $errors->first('last_name') }}</div>

    </div>

    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Email*"
               onfocus="this.placeholder=''" onblur="this.placeholder='Email*'"
               value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <div style="color:red; padding: 2px;">{{ $errors->first('email') }}</div>
        @endif
    </div>

    <div class="form-group">
        <input type="text" name="zip" class="form-control" placeholder="Zip"
               onfocus="this.placeholder=''" onblur="this.placeholder='Zip'" value="{{ old('zip') }}">
        @if ($errors->has('zip'))
            <div style="color:red; padding: 2px;">{{ $errors->first('zip') }}</div>
        @endif
    </div>

    <div class="form-group">
        <input name="phone" type="number" class="form-control" placeholder="Phone"
               onfocus="this.placeholder=''" onblur="this.placeholder='Phone'"
               value="{{ old('phone') }}">
        @if ($errors->has('phone'))
            <div style="color:red; padding: 2px;">{{ $errors->first('phone') }}</div>
        @endif
    </div>
    <div class="form-group">
        <input type="submit" name="send" class="btn btn-info" value="Subscribe"/>
    </div>

</form>
