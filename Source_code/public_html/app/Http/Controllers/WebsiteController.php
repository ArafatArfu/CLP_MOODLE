<?php

namespace App\Http\Controllers;

use App\Mail\volunteerGreet;
use App\Mail\volunteerGreetAdmin;
use App\Models\District;
use App\Models\Division;
use App\Models\GeneralUpdate;
use App\Models\News;
use App\Models\School;
use App\Models\Schoolinfo;
use App\Models\VisitorCount;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function index(): View
    {
        $general = GeneralUpdate::first();
        $latestNews = News::orderBy('id', 'desc')->take(2)->get();

        $todayVisitorCount = VisitorCount::whereDate('created_at', today())
                                ->distinct('ip_address')
                                ->count('ip_address');

        $monthlyVisitorCount = VisitorCount::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count('ip_address');

        return view('website.index', compact('general', 'latestNews', 'todayVisitorCount', 'monthlyVisitorCount'));
    }

    public function team(): View
    {
        return view('website.team');
    }

    public function history(): View
    {
        $general = GeneralUpdate::first();
        return view('website.history', compact('general'));
    }

    public function mission(): View
    {
        return view('website.mission');
    }

    public function impact(): View
    {
        $general = GeneralUpdate::first();
        return view('website.impact', compact('general'));
    }

    public function partners(): View
    {
        return view('website.partners');
    }

    public function clcTeaching(): View
    {
        $general = GeneralUpdate::first();
        return view('website.clc-teaching', compact('general'));
    }

    public function sponsorClc(): View
    {
        $general = GeneralUpdate::first();
        return view('website.sponsor-clc', compact('general'));
    }

    public function remoteVolunteer(): View
    {
        $general = GeneralUpdate::first();
        return view('website.remote-volunteer', compact('general'));
    }

    public function faq(): View
    {
        return view('website.faq');
    }

    public function tokai(): View
    {
        $general = GeneralUpdate::first();
        return view('website.tokai', compact('general'));
    }

    public function sponsorTokai(): View
    {
        $general = GeneralUpdate::first();
        return view('website.sponsor-tokai', compact('general'));
    }

    public function smartClassRoom(): View
    {
        $general = GeneralUpdate::first();
        return view('website.smart-classroom', compact('general'));
    }

    public function sponsorScr(): View
    {
        $general = GeneralUpdate::first();
        return view('website.sponsor-scr', compact('general'));
    }

    public function connectStudents(): View
    {
        return view('website.connect-students');
    }

    public function educationThroughEntertainment(): View
    {
        return view('website.education-entertainment');
    }

    public function trainingMaterial(): View
    {
        return view('website.training-material');
    }

    public function successStories(): View
    {
        return view('website.success-stories');
    }

    public function contactUs(): View
    {
        return view('website.contact-us');
    }

    public function fiveDollarGraduate(): View
    {
        return view('website.five-dollar-graduate');
    }

    public function curriculumDevelopment(): View
    {
        return view('website.curriculum-development');
    }

    public function teacherTrainingProgram(): View
    {
        return view('website.teacher-training');
    }

    public function sherpurPr(): View
    {
        $data = Schoolinfo::where('project', 'sherpur')->whereIn('id', function($query) {
            $query->select(DB::raw('MIN(id)'))
                  ->from('schoolinfos')
                  ->where('project', 'sherpur')
                  ->groupBy('schools_id');
        })->get();
        return view('website.sherpurpr', compact('data'));
    }

    public function schoolInfo(Request $request): View
    {
        $searchQuery = $request->input('query');

//        $totalClcCount = SchoolInfo::where(function ($query) {
//            $query->whereRaw("FIND_IN_SET('clc', clc) > 0")
//                ->orWhereRaw("FIND_IN_SET('clc, scr', clc) > 0");
//        })
//        ->count();

        $totalClcCount = SchoolInfo::where('clc', 'clc, scr')
                            ->orWhere('clc', 'clc')
                            ->count();

        // Count total scr
        $totalScrCount = SchoolInfo::where('clc', 'clc, scr')
                            ->orWhere('clc', 'scr')
                            ->count();

        $schoolsByDistrict = SchoolInfo::with('school.upazila.district')
            ->when($searchQuery, function ($query) use ($searchQuery) {
                // $query->where('school_name', 'like', "%$searchQuery%");
                $query->whereHas('school', function ($subQuery) use ($searchQuery) {
                    $subQuery->where('school_name', 'like', "%$searchQuery%");
                });
            })
            ->get()
            ->groupBy(function ($schoolInfo) {
                $upazila = optional($schoolInfo->school)->upazila;
                $district = optional($upazila)->district;
                return optional($district)->id;
            })
            ->map(function ($schoolInfos) {
                return $schoolInfos->sortBy(function ($schoolInfo) {
                    return strtotime($schoolInfo->start_date) ?? PHP_INT_MAX;
                });
            })
            ->sortBy(function ($schoolInfos, $districtId) {
                $district = District::find($districtId);
                $districtName = optional($district)->state_name;

                // If district name exists, trim leading spaces; otherwise, use an empty string
                $trimmedDistrictName = $districtName ? ltrim($districtName) : '';

                // If district name is empty, assign a higher sorting priority
                // This ensures that districts without names are sorted after those with names
                $sortingPriority = $districtName ? 0 : 1;

                return [$sortingPriority, $trimmedDistrictName];
            });
        return view('website.school-info', compact('schoolsByDistrict', 'totalClcCount', 'totalScrCount'));
    }

    public function searchCenter(): View
    {
        $divisions = Division::select("id", "name")->get();
        $schools = School::latest()->get();
        return view('website.search-center', compact('divisions', 'schools'));
    }

    public function schoolDetails(Request $request): View
    {
        // dd($school->schoolInfo);
        $schoolInfo = SchoolInfo::with('school.upazila.district')->findOrFail($request->schoolInfo);
        $school = School::findOrFail($schoolInfo->schools_id);
        return view('website.school-details', compact('school', 'schoolInfo'));
    }
    public function evaluationReport(): View
    {
        return view('website.evaluation-report');
    }
    public function formativeReports(): View
    {
        return view('website.formative-reports');
    }
    public function annualReport(): View
    {
        return view('website.annual-report');
    }

    public function magazines(): View
    {
        return view('website.magazines');
    }

    public function brochure(): View
    {
        return view('website.brochure');
    }

    public function volunteer(): View
    {
        return view('website.volunteer');
    }

    public function volunteerStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address_one' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'example' => 'required',
        ]);

        $address_two = " ";
        if (is_null($request->get('address_two'))) {
            $address_two = " ";
        } else {
            $address_two = $request->get('address_two');
        }

        $messeage = " ";
        if (is_null($request->get('message'))) {
            $messeage = " ";
        } else {
            $messeage = $request->get('message');
        }

        $examplecheck = " ";
        if (is_null($request->get('examplecheck'))) {
            $examplecheck = "off";
        } else {
            $examplecheck = $request->get('examplecheck');
        }

        $volunteer = new Volunteer([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'address_one' => $request->get('address_one'),
            'address_two' => $address_two,
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
            'country' => $request->get('country'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'message' => $messeage,
            'examplecheck' => $examplecheck,
            'example' => $request->get('example'),
        ]);
        $volunteer->save();

        if ($volunteer->save() == true) {
            Mail::to($volunteer["email"])->send(new volunteerGreet($volunteer));
            Mail::to('clp@clpweb.org')->send(new volunteerGreetAdmin($volunteer));
            return back()->with('success', 'Thanks for staying with CLP. Your respose has been saved.');
        } else {
            return back();
        }
    }
}
