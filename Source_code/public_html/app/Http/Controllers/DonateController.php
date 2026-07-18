<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use Illuminate\Http\Request;

class DonateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donates = Donate::latest()->get();
        return view('admin.pages.donate.list', compact('donates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donate $donate)
    {
        $donate->delete();
        session()->flash('success', 'Donate deleted successfully!');
        return redirect()->route('donates.index');
    }
}
