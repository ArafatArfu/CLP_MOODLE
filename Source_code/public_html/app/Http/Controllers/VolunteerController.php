<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $volunteers = Volunteer::get();
        return view('admin.pages.volunteer.list', compact('volunteers'));
        // return view('backend.volunteer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'address_one'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip'=>'required',
            'country'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'example'=>'required'
        ]);

        $address_two = " ";
        if (is_null($request->get('address_two')))
        {
            $address_two = " ";
        }else{
            $address_two = $request->get('address_two');
        }

        $messeage = " ";
        if (is_null($request->get('message')))
        {
            $messeage = " ";
        }else{
            $messeage = $request->get('message');
        }

        $examplecheck = " ";
        if (is_null($request->get('examplecheck')))
        {
            $examplecheck = "off";
        }else{
            $examplecheck = $request->get('examplecheck');
        }

        $volunteer = new Volunteer([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'address_one' => $request->get('address_one'),
            'address_two' => $address_two,
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
            'country' => $request->get('country'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'message' => $messeage,
            'examplecheck' => $examplecheck,
            'example' => $request->get('example')
        ]);
        $volunteer->save();

        if( $volunteer->save() == true)
        {

            Mail::to($volunteer["email"])->send(new volunteerGreet($volunteer));
            Mail::to('clp@clpweb.org')->send(new volunteerGreetAdmin($volunteer));
            return back()->with('success', 'Thanks for staying with CLP. Your respose has been saved.');
        }else{
            return back();
        }

        // return redirect('/volunteer')->with('success', 'Your response has been saved! Thanks for staying with us.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $volunteers = Volunteer::find($id);
        return view('backend.volunteer.view', compact('volunteers'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        session()->flash('success', 'Volunteer deleted successfully!');
        return redirect()->route('admin.volunteers.index');
    }

}
