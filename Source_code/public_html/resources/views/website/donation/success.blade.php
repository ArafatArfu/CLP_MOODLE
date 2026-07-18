@extends('layouts.website')
@section('title', 'Donation Success')
@section('content')
    <section class="inner-banner">
        <div class="container">
            <div class="box text-center">
                <h1>Donation Successful</h1>
                <div class="breadcumb-wrapper">
                    <ul class="list-inline link-list">
                        <li>
                            <a href="{{route('website.home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            Donation Successful
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of inner-banner -->

    <section style="padding: 100px">
      <div class="container">
          <div class="row justify-content-center donation-form">
              <div class="col-md-12">
                <div class="alert alert-success text-center">
                  <strong>Thank you for donating!</strong>
                  <div class="mt-4">
                    Please Mail Check payable to CLP, 6 Tharp Lane, Marlboro, NJ 07746.
                  </div>
                </div>
              </div>
          </div>
      </div>
    </section>

    <!-- End of search-popup -->
    @include('website.partials.actions')
@endsection
