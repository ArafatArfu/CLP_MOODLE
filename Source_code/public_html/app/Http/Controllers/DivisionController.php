<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);
        $divisions = Division::latest();
        if ($request->ajax()) {
            // $divisions = $divisions->paginate($limit);
            $divisions = $divisions->get();
            return response()->json(['divisions' => $divisions]);
        }   
        $divisions = $divisions->get();
        return view('admin.pages.division.list', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(Division::getRules());
            $division = Division::create($validatedData);
            session()->flash('success', 'Division successfully added!');
            return redirect()->route('divisions.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division)
    {
        try {
            $validatedData = $request->validate(Division::getRules($division->id));
            // Update the existing divi$division item with the validated data
            $division->update($validatedData);

            session()->flash('success', 'Division successfully updated!');
            return redirect()->route('divisions.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        $division->delete();
        session()->flash('success', 'Division deleted successfully!');
        return redirect()->route('divisions.index');
    }
}
