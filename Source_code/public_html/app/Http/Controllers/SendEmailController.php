<?php

namespace App\Http\Controllers;

use App\Jobs\GreetMailJob;
use App\Jobs\SendPledgeMailJob;
use App\Mail\greetMail;
use App\Mail\greetMail2;
use App\Mail\SendPledgeMail;
use App\Models\Sponsor;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function send(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|min:3|max:20',
            'last_name' => 'required|min:3|max:20|string',
            'email' => 'required|email',
            'zip' => 'nullable|min:3|max:20',
            'phone' => 'nullable|min:9|max:13',
        ]);

        //  $volunteer = new Volunteer(
        $data = new Subscriber([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'zip' => $request->zip,
            'phone' => $request->phone,
        ]);

        $data->save();

        if ($data->save() == true) {
            //Mail::to('clp@clpweb.org')->send(new SendMail($data));
            Mail::to($data["email"])->send(new greetMail2($data));
            // Mail::to('clp@clpweb.org')->send(new greetMailAdmin($data));
            return back()->with('success', 'Thanks for Subscribe!');
        } else {
            return back();
        }
    }
    public function sendPledgeForm(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|string|min:5|max:60',
            'address_one' => 'required|string|max:100',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:50',
            'zip' => 'required|max:30',
            'country' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|min:9|max:15',
            'valid' => 'required|numeric|min:2',
        ]);

        if ($request->exampleCheck3 === '1') {
            $chk3 = "Yes";
        } else {
            $chk3 = "No";
        }

        $data = [
            'full_name' => $request->full_name ?? "",
            'address_one' => $request->address_one ?? "",
            'city' => $request->city ?? "",
            'address_two' => $request->address_two ?? "",
            'state' => $request->state ?? "",
            'country' => $request->country ?? "",
            'email' => $request->email ?? "",
            'zip' => $request->zip ?? "",
            'phone' => $request->phone ?? "",
            'instituition' => $request->instituition ?? "",
            'location' => $request->location ?? "",
            'contact' => $request->contact ?? "",
            'phone2' => $request->phone2 ?? "",
            'donateBy' => $request->donateBy ?? "",
            'memory' => $request->memory ?? "",
            'instruction' => $request->instruction ?? "",
            'exampleCheck3' => $chk3 ?? "",
        ];

        $sponsor = Sponsor::create($data);

        Mail::to('clpusa@clpweb.org')->send(new SendPledgeMail($data));
        Mail::to('vabnj@hotmail.com')->send(new SendPledgeMail($data));
        Mail::to($data["email"])->send(new greetMail($data));

        return back()->with('success', 'Thanks for Contact!');
        
        // SendPledgeMailJob::dispatch($data);
        // GreetMailJob::dispatch($data);
         
       // return redirect()->away('https://na01.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.paypal.com%2Fdonate%3Fhosted_button_id%3DTLHRWB5UGFECW&amp;data=04%7C01%7C%7Cf24ef802b2da4b07daad08d8bbd824e5%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637465884285128282%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C1000&amp;sdata=rRTVMs1SaMJig5DNQlN4YJduXsaLxadqo7ynOyaopjQ%3D&amp;reserved=0');

    }
}
