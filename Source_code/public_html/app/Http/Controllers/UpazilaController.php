<?php

namespace App\Http\Controllers;

use App\Models\Upazila;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);
        $upazilas = Upazila::with('district')->latest();
        if ($request->ajax()) {
            $upazilas = $upazilas->get();
            // $upazilas = $upazilas->paginate($limit);
            return response()->json(['upazilas' => $upazilas]);
        }   
        $upazilas = $upazilas->get();
        return view('admin.pages.upazila.list', compact('upazilas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(Upazila::getRules());
            $district = Upazila::create($validatedData);
            session()->flash('success', 'Upazila successfully added!');
            return redirect()->route('upazilas.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upazila $upazila)
    {
        try {
            $validatedData = $request->validate(Upazila::getRules($upazila->id));
            $upazila->update($validatedData);

            session()->flash('success', 'Upazila successfully updated!');
            return redirect()->route('upazilas.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upazila $upazila)
    {
        $upazila->delete();
        session()->flash('success', 'Upazila deleted successfully!');
        return redirect()->route('upazilas.index');
    }
}
