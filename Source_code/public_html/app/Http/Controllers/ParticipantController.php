<?php

namespace App\Http\Controllers;

use App\Mail\ParticipantRegistered;
use App\Mail\ParticipantConfirmation;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ParticipantController extends Controller
{
    /**
     * Display a particpant register form
     */
    public function index()
    {
        return view('auth.register');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mailing_address' => 'nullable|string|max:255',
            'contact_phone' => 'required|string|max:25',
            'guests' => 'required|integer|min:1',
            'payment_method' => 'required|in:Paypal,Cheque,Zelle',
            'amount' => 'required|numeric|min:100',
            'comment' => 'nullable|string'
        ]);

        $participant = Participant::create($request->all());

        try {
            if ($participant) {
                Mail::to('clp@clpweb.org')->send(new ParticipantRegistered($participant));
                
                Mail::to($participant->email)->send(new ParticipantConfirmation($participant));
                
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

        return redirect()->route('registration.success', ['payment_method' => $request->payment_method])
                         ->with('success', 'Registration successful!');
    }

}
