@extends('layouts.website')
@section('title', 'CLP | Search Center')
@section('pageStyle')
    <style>
        label {
            color: black;
        }
    </style>
@endsection
@section('content')
    <div class="container" style="padding-top: 70px; padding-bottom: 250px;">
        <div class="row">
            <div class="col-md-6">
                <div style="margin: 0 auto; max-width: 100%;" class="panel panel-success">
                    <div class="panel-heading"><h3 style="text-align: center;">Search Center</h3></div>
                    <div class="panel-body">
                        <form method="GET" action="{{ route('website.schoolDetails') }}">
                            <div class="form-group">
                                <label for="division">Select Division</label>
                                <select id="division" class="form-control" required>
                                    <option selected disabled>Select</option>
                                    @foreach($divisions as $div)
                                        <option value="{{$div->id}}"> {{$div->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="district" >Select District</label>
                                <select id="district" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="upazila">Select Upazila</label>
                                <select id="upazila" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="school">Select School</label>
                                <select name="school" id="school" class="form-control" required>
                                </select>
                            </div>
                            <div class="card-body">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> SEARCH
                                </button>
                                <button type="reset" class="btn btn-primary"><i class="fa fa-refresh"></i> CLEAR ENTRY</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div style="margin: 0 auto; max-width: 100%;" class="panel panel-success">
                    <div class="panel-heading"><h3 style="text-align: center;">Search Center By School</h3></div>
                    <div class="panel-body">
                        <form method="GET" action="{{ route('website.schoolDetails') }}">
                            <div class="form-group">
                                <label for="schoolName">Select School</label>
                                <select id="schoolName" class="form-control" name="school" required>
                                    <option value="" selected disabled>Select</option>
                                    @foreach($schools as $school)
                                        <option value="{{$school->id}}"> {{$school->school_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-body">
                                <button type="submit" class="btn btn-success"><i class="fa fa-eye"></i> View
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#schoolName').select2();
        });
        $('#division').change(function () {
            var divisionID = $(this).val();
            if (divisionID) {
                $.ajax({
                    type: "GET",
                    url: "{{route('ajax.districts')}}?division_id=" + divisionID,
                    success: function (res) {
                        if (res) {
                            $("#district").empty();
                            $("#district").append('<option>Select</option>');
                            $.each(res, function (key, value) {
                                $("#district").append(`<option value="${value.id}">${value.state_name}</option>`);
                            });
                        } else {
                            $("#district").empty();
                        }
                    }
                });
            } else {
                $("#district").empty();
                $("#upazila").empty();
                $("#school").empty();
            }
        });

        $('#district').on('change', function () {
            var districtID = $(this).val();
            if (districtID) {
                $.ajax({
                    type: "GET",
                    url: "{{route('ajax.upazilas')}}?district_id=" + districtID,
                    success: function (res) {
                        if (res) {
                            $("#upazila").empty();
                            $("#upazila").append('<option>Select</option>');
                            $.each(res, function (key, value) {
                                $("#upazila").append(`<option value="${value.id}">${value.name}</option>`);
                            });
                        } else {
                            $("#upazila").empty();
                        }
                    }
                });
            } else {
                $("#upazila").empty();
                $("#school").empty();
            }
        });

        $('#upazila').on('change', function () {
            var citiesID = $(this).val();
            if (citiesID) {
                $.ajax({
                    type: "GET",
                    url: "{{route('ajax.schools')}}?upazila_id=" + citiesID,
                    success: function (res) {
                        if (res) {
                            $("#school").empty();
                            $("#school").append('<option>Select</option>');
                            $.each(res, function (key, value) {
                                $("#school").append(`<option value="${value.id}">${value.school_name}</option>`);
                            });
                        } else {
                            $("#school").empty();
                        }
                    }
                });
            } else {
                $('#school').empty();
            }
        });
    </script>
@endsection
