@extends('layouts.website')
@section('title', 'Donation')
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
.form-check-inline{
    border: 1px solid #DDD;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 12px;
}
</style>
@endsection
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box text-center">
                <h1>Donation</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            Donation
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section style="padding-top: 20px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">Donate CLP</h2>
                    <hr/>
                    <form action="{{ route('donation.submit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!--<div class="form-group col-md-12 col-12">-->
                            <!--    <label for="name">Name:</label>-->
                            <!--    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>-->
                            <!--    @error('name')-->
                            <!--        <div class="invalid-feedback" style="color: red;">{{ $message }}</div>-->
                            <!--    @enderror-->
                            <!--</div>-->
                            <!--<div class="form-group col-md-12 col-12">-->
                            <!--    <label for="email">Email Address:</label>-->
                            <!--    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>-->
                            <!--    @error('email')-->
                            <!--        <div class="invalid-feedback" style="color: red;">{{ $message }}</div>-->
                            <!--    @enderror-->
                            <!--</div>-->
                            <div class="form-group col-12 d-flex flex-column align-items-center text-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" id="paypal" name="payment_method" value="Paypal" {{ old('payment_method') == 'Paypal' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="paypal">Paypal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" id="cheque" name="payment_method" value="Cheque" {{ old('payment_method') == 'Cheque' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="cheque">Cheque</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('zelle_method') is-invalid @enderror" type="radio" id="zelle" name="payment_method" value="Zelle" {{ old('payment_method') == 'Zelle' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="zelle">ZellePay | Using: CLP | vabnj@hotmail.com</label>
                                </div>
                                @error('payment_method')
                                    <div class="invalid-feedback d-block" style="color: red;">{{ $message }}</div>
                                @enderror
                                <!-- Cheque Message block -->
                                <div id="cheque-info" class="cheque-message">
                                    <h4>Pay to: CLP</h4>
                                    <h6>Mailing Address:</h6>
                                    <p>
                                        6 Tharp Line,<br/>
                                        Marlboro, NJ 07746,<br/>
                                        732-829-0341
                                    </p>
                                </div>
                            </div>
                            <br/>
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

        function toggleChequeInfo() {
            chequeInfo.style.display = chequeRadio.checked ? 'block' : 'none';
        }

        toggleChequeInfo();
        chequeRadio.addEventListener('change', toggleChequeInfo);
        paypalRadio.addEventListener('change', toggleChequeInfo);
        zelleRadio.addEventListener('change', toggleChequeInfo);
    });
</script>
@endsection

