<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\School;
use App\Models\Upazila;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function districts(Request $request)
    {
        $districts = District::select("state_name", "id")->where("country_id", $request->division_id)->get();
        return response()->json($districts);
    }

    public function upazilas(Request $request)
    {
        $upazilas = Upazila::select("name", "id")->where("state_id", $request->district_id)->get();
        return response()->json($upazilas);
    }

    public function schools(Request $request)
    {
        $schools = School::select("school_name", "id")->where("cities_id", $request->upazila_id)->get();
        return response()->json($schools);
    }
}
