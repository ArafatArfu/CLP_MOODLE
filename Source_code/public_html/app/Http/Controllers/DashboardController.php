<?php

namespace App\Http\Controllers;

use App\Models\Upazila;
use App\Models\Schoolinfo;
use App\Models\District;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $schoolInfo = Schoolinfo::count();
        $volunteers = Volunteer::count();
        $districts = District::count();
        $upazilas = Upazila::count();
        return view('admin.pages.dashboard', compact('schoolInfo', 'volunteers', 'districts', 'upazilas'));
    }
}
