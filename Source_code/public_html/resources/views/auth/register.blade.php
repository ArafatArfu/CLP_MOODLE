@extends('layouts.website')
@section('title', 'Registration')
@section('pageStyle')
<style>
.cheque-message {
    display: none;
    margin-top: 30px;
    margin-bottom: 30px;
    padding: 12px;
    background-color: #e9f7e6;
    border: 1px solid #ffeeba;
    border-radius: 4px;
    color: #002f93;
    font-weight: 500;
}
</style>
@endsection
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box text-center">
                <h1>Registration</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            Registration
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section style="py-5">
        <div class="container">
            <div class="row justify-content-center donation-form">
                <div class="col-md-12">
                    <h2 class="text-center">CLP 2025 NJ Convention</h2>
                    <p class="text-center">
                        Join Us for an Evening of Inspiration, Entertainment, and Impact</br>
                        Date: August 16, 2025 | Time: 6-9pm</br>
                        At Franklin Community Senior Center, 505 DeMott Lane, Somerset, NJ 08873</br>
                        Registration+ Donation: Minimum $125 per person (Dinner Included), Children under 12 is FREE!
                    </p>
                    <hr/>
                    <form action="{{ route('registration.submit') }}" method="POST" id="addressForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-12">
                                <label for="last_name">Last Name: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="first_name">First Name: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="email">Email Address: <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="mailing_address">Mailing Address: <small class="text-muted">(Optional)</small></label>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="text" placeholder="Street" id="street" name="street" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" placeholder="City" id="city" name="city" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" placeholder="Zip Code" id="zip" name="zip" class="form-control">
                                    </div>
                                </div>
                                <input type="hidden" id="address" name="mailing_address" value="{{ old('mailing_address') }}">
                                @error('mailing_address')
                                    <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="contact_phone">Contact Phone: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}" required>
                                @error('contact_phone')
                                    <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="guests">Number of Guests: <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('guests') is-invalid @enderror" id="guests" name="guests" value="{{ old('guests') }}" required>
                                @error('guests')
                                    <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="payment_method">Payment Method: <span class="text-danger">*</span></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" id="paypal" name="payment_method" value="Paypal" {{ old('payment_method') == 'Paypal' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="paypal" style="width: 20%">Paypal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" id="cheque" name="payment_method" value="Cheque" {{ old('payment_method') == 'Cheque' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="cheque" style="width: 20%">Cheque</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" id="zelle" name="payment_method" value="Zelle" {{ old('payment_method') == 'Zelle' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="zelle" style="width: 20%">ZellePay</label>
                                </div>
                                @error('payment_method')
                                    <div class="invalid-feedback d-block" style="color: red;">{{ $message }}</div>
                                @enderror
                                <!-- Cheque Message block -->
                                <div id="cheque-info" class="cheque-message">
                                    <h6>Mailing Address:</h6>
                                    <p>
                                        6 Tharp Line,<br/>
                                        Marlboro, NJ 07746,<br/>
                                        732-829-0341
                                    </p>
                                </div>
                                <!-- Zelle Message block -->
                                <div id="zelle-info" class="cheque-message">
                                    <h4>Using: <strong>CLP</strong></h4>
                                    <h5>vabnj@hotmail.com</h5>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group col-md-6 col-12">
                                <label for="amount">Amount (USD): <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" required>
                                @error('amount')
                                    <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <br/>
                            <div class="form-group col-md-12 col-12">
                                <label for="comment">Comment: <small class="text-muted">(Optional)</small></label>
                                <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3"></textarea>
                                @error('comment')
                                    <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" style="margin-bottom:75px">Submit</button>
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </section>
    <!-- End of search-popup -->
    @include('website.partials.actions')
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chequeRadio = document.getElementById('cheque');
        const paypalRadio = document.getElementById('paypal');
        const zelleRadio = document.getElementById('zelle');
        const chequeInfo = document.getElementById('cheque-info');
        const zelleInfo = document.getElementById('zelle-info');

        function toggleChequeInfo() {
            chequeInfo.style.display = chequeRadio.checked ? 'block' : 'none';
            zelleInfo.style.display = zelleRadio.checked ? 'block' : 'none';
        }

        toggleChequeInfo();
        chequeRadio.addEventListener('change', toggleChequeInfo);
        paypalRadio.addEventListener('change', toggleChequeInfo);
        zelleRadio.addEventListener('change', toggleChequeInfo);
    });
    
    
    document.addEventListener('DOMContentLoaded', function() {
            const streetInput = document.getElementById('street');
            const cityInput = document.getElementById('city');
            const zipInput = document.getElementById('zip');
            const addressHiddenInput = document.getElementById('address');
            const addressForm = document.getElementById('addressForm');

            function updateCombinedAddress() {
                const street = streetInput.value.trim();
                const city = cityInput.value.trim();
                const zip = zipInput.value.trim();

                // Combine the values. You can customize the format here.
                // For example: "123 Main St, Anytown, 12345"
                let combinedAddress = '';
                const parts = [];

                if (street) parts.push(street);
                if (city) parts.push(city);
                if (zip) parts.push(zip);

                combinedAddress = parts.join(', ');

                // Set the value of the hidden input field
                addressHiddenInput.value = combinedAddress;
            }

            // Add event listeners to update the combined address whenever input changes
            streetInput.addEventListener('input', updateCombinedAddress);
            cityInput.addEventListener('input', updateCombinedAddress);
            zipInput.addEventListener('input', updateCombinedAddress);

            // Also update on form submission to ensure the latest values are captured
            addressForm.addEventListener('submit', function(event) {
                updateCombinedAddress(); // Ensure the hidden field is up-to-date
                // The form will then submit to the action URL with 'address' field populated
                // If you were using AJAX, you would preventDefault() here and send the data manually.
            });

            // Initial update in case there are pre-filled values (e.g., from server-side rendering)
            updateCombinedAddress();
        });

</script>

@endsection