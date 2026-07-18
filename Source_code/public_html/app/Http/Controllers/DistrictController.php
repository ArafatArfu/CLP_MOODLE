<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);
        $districts = District::with('country')->latest();
        if ($request->ajax()) {
            // $districts = $districts->paginate($limit);
            $districts = $districts->get();
            return response()->json(['districts' => $districts]);
        }   
        $districts = $districts->get();
        return view('admin.pages.district.list', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(District::getRules());
            $district = District::create($validatedData);
            session()->flash('success', 'District successfully added!');
            return redirect()->route('districts.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, District $district)
    {
        try {
            $validatedData = $request->validate(District::getRules($district->id));
            $district->update($validatedData);

            session()->flash('success', 'District successfully updated!');
            return redirect()->route('districts.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        $district->delete();
        session()->flash('success', 'District deleted successfully!');
        return redirect()->route('districts.index');
    }
}
