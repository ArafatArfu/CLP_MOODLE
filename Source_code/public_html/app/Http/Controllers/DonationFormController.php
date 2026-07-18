<?php

namespace App\Http\Controllers;

use App\Mail\DonationAcknowledge;
use App\Mail\DonationConfirmation;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DonationFormController extends Controller
{
    /**
     * Display a particpant register form
     */
    public function index()
    {
        return view('website.donation.form');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            'payment_method' => 'required|in:Paypal,Cheque,Zelle'
        ]);
        $request['name'] = "NotProvided";
        $request['email'] = "NotProvided";

        $donation = Donation::create($request->all());

        try {
            if ($participant) {
                Mail::to('clp@clpweb.org')->send(new DonationAcknowledge($participant));
                
                Mail::to($participant->email)->send(new DonationConfirmation($participant));
                
            }
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error('Error sending registration email: ' . $e->getMessage());
        }

        if ($request->payment_method == 'Paypal') {
            return redirect()->away('https://www.paypal.com/donate?hosted_button_id=TLHRWB5UGFECW');
        }
        if ($request->payment_method == 'Zelle') {
            return redirect()->away('https://www.zellepay.com');
        }

        return redirect()->route('donation.success', ['payment_method' => $request->payment_method])
                         ->with('success', 'Donation successful!');
    }

}
