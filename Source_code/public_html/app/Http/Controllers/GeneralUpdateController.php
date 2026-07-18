<?php

namespace App\Http\Controllers;

use App\Models\GeneralUpdate;
use Illuminate\Http\Request;

class GeneralUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gUpdates = GeneralUpdate::first();
        return view('admin.pages.general-update.list', compact('gUpdates'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            // $validatedData = $request->validate(Division::getRules($division->id));
            // Update the existing divi$division item with the validated data
            $gUpdate = GeneralUpdate::first();
            $gUpdate->update($request->all());

            session()->flash('success', 'Successfully updated!');
            return redirect()->route('general-updates.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

}
