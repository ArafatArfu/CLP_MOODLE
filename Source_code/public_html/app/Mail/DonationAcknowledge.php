<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationAcknowledge extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;
    /**
     * Create a new message instance.
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.donation_acknowledge')
                    ->subject('New Donation Completed')
                    ->with('donation', $this->donation);
    }
}
