@extends('layouts.website')
@section('title', 'CLP | Computer Literacy Program')
@section('pageStyle')
<style>
 .registration-button {
    padding: 10px 20px;
    font-size: 1rem;
    background-color: #b21e32;
    color: #EEF;
    border-radius: 8px;
    animation: none;
  }
@media (min-width: 768px) {
  .registration-button {
    display: inline-block;
    padding: 30px 50px;
    font-size: 1.5rem;
    font-weight: bold;
    color: #ffffff;
    background-color: #b21e32; /* red tone */
    border: none;
    border-radius: 12px;
    cursor: pointer;
    text-decoration: none;
    animation: blink 1s infinite;
    box-shadow: 0 0 10px rgba(178, 30, 50, 0.5);
    transition: transform 0.2s ease-in-out;
  }

  .registration-button:hover {
    transform: scale(1.05);
    background-color: #eb4034;
  }

  @keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
  }
}
</style>
@endsection
@section('content')
    @include('website.partials.modals')
    @include('website.partials.slider')
    @include('website.partials.callout')
    @include('website.partials.works')
    @include('website.partials.story')
    @include('website.partials.counter')
    @include('website.partials.help')
    @include('website.partials.testimonials')
    @include('website.partials.actions')
@endsection
