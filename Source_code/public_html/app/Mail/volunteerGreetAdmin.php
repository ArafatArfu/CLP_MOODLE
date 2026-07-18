<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class volunteerGreetAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->from('clpusa@clpweb.org')->subject('A New Volunteer')->view('volunteerGreetAdmin')->with('volunteer', $this->data);
    
        $html = "<h2>Volunteer Details</h2> <ul> <li><strong>First Name:</strong> " . ($this->data->first_name ?? 'N/A') . "</li> <li><strong>Last Name:</strong> " . ($this->data->last_name ?? 'N/A') . "</li> <li><strong>Address 1:</strong> " . ($this->data->address_one ?? 'N/A') . "</li> <li><strong>Address 2:</strong> " . ($this->data->address_two ?? 'N/A') . "</li> <li><strong>City:</strong> " . ($this->data->city ?? 'N/A') . "</li> <li><strong>State:</strong> " . ($this->data->state ?? 'N/A') . "</li> <li><strong>Zip:</strong> " . ($this->data->zip ?? 'N/A') . "</li> <li><strong>Country:</strong> " . ($this->data->country ?? 'N/A') . "</li> <li><strong>Email:</strong> " . ($this->data->email ?? 'N/A') . "</li> <li><strong>Phone:</strong> " . ($this->data->phone ?? 'N/A') . "</li> <li><strong>Message:</strong> " . ($this->data->message ?? 'N/A') . "</li> <li><strong>Example Check:</strong> " . ($this->data->examplecheck ?? 'N/A') . "</li> <li><strong>Example:</strong> " . ($this->data->example ?? 'N/A') . "</li> </ul>";
        return $this->from('clpusa@clpweb.org')->subject('A New Volunteer')->html($html);
    }
}
