<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParticipantConfirmation extends Mailable
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
        return $this->view('mail.participant_confirmed')
                    ->subject('Registration Confirmation - CLP 2025 NJ Convention')
                    ->with('participant', $this->participant);
    }
}
