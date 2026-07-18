<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);
        $centers = Center::with('division', 'district', 'upazila', 'school')->latest();
        if ($request->ajax()) {
            $centers = $centers->get();
            // $centers = $centers->paginate($limit);
            return response()->json(['centers' => $centers]);
        }   
        $centers = $centers->get();
        return view('admin.pages.center.list', compact('centers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(Center::getRules());
            $center = Center::create($validatedData);
            session()->flash('success', 'Center successfully added!');
            return redirect()->route('centers.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Center $center)
    {
        try {
            $validatedData = $request->validate(Center::getRules($center->id));
            $center->update($validatedData);

            session()->flash('success', 'Center successfully updated!');
            return redirect()->route('centers.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Center $center)
    {
        $center->delete();
        session()->flash('success', 'Center deleted successfully!');
        return redirect()->route('centers.index');
    }
}
