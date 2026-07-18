@extends('layouts.website')
@section('title', 'CLP | Your Sponsored Center(s)')
@section('pageStyle')
    <style>
        .tableFixHead {
            font-family: 'Noto Serif', serif;
            font-size: 1em;
            border-collapse: collapse;
            color: black;
        }

        .tableFixHead thead th {
            position: sticky;
            top: 70px;
        }

        thead tr th {
            background-color: #f9cdb7;
            color: black;
            text-align: left;
            font-size: 1.3em;
        }

        tr:nth-child(even) {
            background-color: #EEE;
        }

        .district {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    @php
        $green = "#47c9a2";
        $lightGreen = "#b4f1df";
        $red = "#ff9478";
        $sl = 1;
    @endphp
    <div class="container">
        <br>
        <h3 style="text-align:center;">Your Sponsored Center(s)</h3>
        <br>
        <p class="work_para">Computer Literacy Program Volunteers for the Underprivileged (CLP) has spent {{date("Y")-2005}} years
            building and running <strong><a href="{{ route('website.clcTeaching') }}">Computer Literacy Centers
                    (CLCs)</a></strong> to develop a model for computer literacy of the underprivileged youths in rural
            Bangladesh.</p>
        <p class="work_para">Total number of <strong><a href="{{ route('website.clcTeaching') }}">Computer Literacy
                    Centers
                    (CLCs)</a></strong> established to date is
            <strong>{{ $general->total_clc_count ?? 309 }}</strong>.</p>
        <p class="work_para">Total number of <strong><a href="{{ asset('website.smartClassRoom') }}">Smart Classrooms
                    (SCRs)</a></strong> to date is <strong>{{ $general->total_scr_count ?? 209 }}</strong>.</p>
        <p class="work_para">The maintained centers are highlighted with <strong style="color: {{$green}}">light green
                color.</strong></p>
        <p class="work_para">The activated and reactivated centers are highlighted with <strong
                style="color: {{$lightGreen}}">more
                lighther green color.</strong></p>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-header">
                    <form style="margin-right: 20px;" action="{{ route('website.schoolInfo') }}" method="GET">
                        <div class="row">
                            <div class="col" style="float: right">
                                <button id="reset-search" class="btn btn-warning">Reset</button>
                            </div>
                            <div class="col" style="float: right">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                            <div class="col-md-3" style="float: right">
                                <input type="text" class="form-control" placeholder="Search by Center Name" name="query"
                                       value="{{ request()->input('query') }}" style="width: 100%">
                            </div>
                        </div>
                    <form>
                </div>
                <div class="panel-body">

                    <div class="tableFixHead">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th style="width: 1%;">Sl</th>
                                <th style="width: 32%;">Center Name</th>
                                <th style="width: 8%;">District</th>
                                <th style="width: 9%;">Start Date</th>
                                <th style="width: 18%;">Center Type</th>
                                <th style="width: 28%;">Sponsor</th>
                                <th colspan=2>School Link</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($schoolsByDistrict as $districtId => $schools)
                                <tr>
                                    <td colspan="7"
                                        class="text-center bg-warning district"> {{optional(optional(optional($schools[0]->school)->upazila)->district)->state_name}}
                                    </td>
                                </tr>
                                @foreach($schools as $schoolInfo)
                                    <tr style="background-color:
                                    @if ($schoolInfo->support == config('constants.CENTER_STATUS_SUPPORTED'))
                                        {{$green}}
                                    @elseif ($schoolInfo->support == config('constants.CENTER_STATUS_REACTIVATED'))
                                        {{$lightGreen}}
                                    @else
                                        {{'#FFF'}}
                                    @endif">
                                        <td>{{$sl}}</td>
                                        <td>{{optional($schoolInfo->school)->school_name}}</td>
                                        <td>{{optional(optional(optional($schools[0]->school)->upazila)->district)->state_name}}</td>
                                        <!--<td>{{ $schoolInfo->start_date ? date('Y F', strtotime($schoolInfo->start_date)) : '' }}</td>-->
                                        <td>{{ $schoolInfo->start_date }}</td>
                                        <td>
                                            @if(strtolower($schoolInfo->clc) == "clc")
                                                <span class="badge badge-secondary text-uppercase ml-1">
                                                    Computer Literacy Center
                                                </span>
                                            @else(strtolower($schoolInfo->clc) == "scr")
                                                <span class="badge badge-secondary text-uppercase ml-1">
                                                    Smart Classroom
                                                </span>
                                            @endif
                                        </td>
                                        <td>{!!  $schoolInfo->sponsor_name !!}</td>
                                        <td>
                                            <a class="btn btn-primary"
                                               href="{{route('website.schoolDetails', ['schoolInfo' => $schoolInfo->id])}}">View</a>
                                        </td>
                                    </tr>
                                    @php $sl++ @endphp
                                @endforeach

                            @endforeach
                            </tbody>
                        </table>
                        <!-- table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script type="text/javascript">
            $(document).ready(function() {
                const urlParams = new URLSearchParams(window.location.search);
                const hasQuery = urlParams.has('query');
                
                // Disable the Search button if there is any query parameter
                $('#reset-search').prop('disabled', !hasQuery);
                $('#reset-search').click(function(event) {
                    event.preventDefault();
                    window.location.href = window.location.pathname;
                });
            });
        </script>
    @endsection
@endsection
