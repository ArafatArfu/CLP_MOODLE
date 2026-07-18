<?php

namespace App\Http\Controllers;

use App\Models\Schoolinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schoolInfos = Schoolinfo::with('school')->latest()->get();
        // dd($schoolInfos[0]);
        return view('admin.pages.school-info.list', compact('schoolInfos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.school-info.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schoolinfo $school_info)
    {
        $school_info->load('school');
        // dd($school_info);
        return view('admin.pages.school-info.edit', compact('school_info'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(Schoolinfo::getRules());
            $validatedData['clc'] = implode(', ', $validatedData['clc']);
            $validatedData['plaquefile'] = $validatedData['plaquefile1'] = $validatedData['plaquefile2'] = $validatedData['photofile'] = $validatedData['photofile1'] = $validatedData['photofile2'] = 'no image';
            if($request->plaquefile){
                $imageName = saveImage($request->file('plaquefile'), 'school_image');
                $validatedData['plaquefile'] = $imageName;
            }
            if($request->plaquefile1){
                $imageName = saveImage($request->file('plaquefile1'), 'school_image');
                $validatedData['plaquefile1'] = $imageName;
            }
            if($request->plaquefile2){
                $imageName = saveImage($request->file('plaquefile2'), 'school_image');
                $validatedData['plaquefile2'] = $imageName;
            }
            if($request->photofile){
                $imageName = saveImage($request->file('photofile'), 'school_image');
                $validatedData['photofile'] = $imageName;
            }
            if($request->photofile1){
                $imageName = saveImage($request->file('photofile1'), 'school_image');
                $validatedData['photofile1'] = $imageName;
            }
            if($request->photofile2){
                $imageName = saveImage($request->file('photofile2'), 'school_image');
                $validatedData['photofile2'] = $imageName;
            }
            $school_info = Schoolinfo::create($validatedData);
            session()->flash('success', 'School successfully added!');
            return redirect()->route('school-infos.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schoolinfo $school_info)
    {
        try {
            $validatedData = $request->validate(Schoolinfo::getRules($school_info->id));
            $validatedData['clc'] = implode(', ', $validatedData['clc']);
            $fields = ['plaquefile', 'plaquefile1', 'plaquefile2', 'photofile', 'photofile1', 'photofile2'];
            foreach ($fields as $field) {
                if ($request->hasFile($field)) {
                    $imageName = saveImage($request->file($field), 'school_image');

                    // Delete previous image if it exists
                    if ($school_info->$field) {
                        Storage::delete('public/assets/images/school_image/' . $school_info->$field);
                    }

                    $validatedData[$field] = $imageName;
                }
            }
            // Update the existing news item with the validated data
            $school_info->update($validatedData);

            session()->flash('success', 'School info successfully updated!');
            return redirect()->route('school-infos.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schoolinfo $school_info)
    {
        $school_info->delete();
        session()->flash('success', 'School info deleted successfully!');
        return redirect()->route('school-infos.index');
    }
}
