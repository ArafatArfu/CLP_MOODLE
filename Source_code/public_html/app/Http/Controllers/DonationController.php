<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function index(): View
    {
        return view('website.donation.online');
    }

    public function mail(): View
    {
        return view('website.donation.mail');
    }

    public function amazonSmile(): View
    {
        return view('website.donation.amazon');
    }

    public function sponsorComputer(): View
    {
        return view('website.donation.computer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        $donate = new Donate([
            'founds' => $request->get('founds'),
            'other' => $request->get('other'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'address_one' => $request->get('address_one'),
            'address_two' => $request->get('address_two'),
            'city' => $request->get('city'),
            'zip' => $request->get('zip'),
            'country' => $request->get('country'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'message' => $request->get('message'),
            'examplecheck' => $request->get('examplecheck'),
            'example' => $request->get('example'),
        ]);
        $donate->save();
        return redirect()->route('website.donateOnline')->with('success', 'Donate saved!');
    }
}
