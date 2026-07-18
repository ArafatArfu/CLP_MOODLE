<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParticipantRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;
    /**
     * Create a new message instance.
     */
    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.participant_registered')
                    ->subject('New Participant Registration')
                    ->with('participant', $this->participant);
    }
}
