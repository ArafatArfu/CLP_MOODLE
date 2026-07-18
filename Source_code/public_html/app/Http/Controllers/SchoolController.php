<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);
        $schools = School::with('upazila')->latest();
        if ($request->ajax()) {
            // $schools = $schools->paginate($limit);
            $schools = $schools->get();
            return response()->json(['schools' => $schools]);
        }   
        $schools = $schools->get();
        return view('admin.pages.school.list', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(School::getRules());
            $school = School::create($validatedData);
            session()->flash('success', 'School successfully added!');
            return redirect()->route('schools.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        try {
            $validatedData = $request->validate(School::getRules($school->id));
            $school->update($validatedData);

            session()->flash('success', 'School successfully updated!');
            return redirect()->route('schools.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        $school->delete();
        session()->flash('success', 'School deleted successfully!');
        return redirect()->route('schools.index');
    }
}
