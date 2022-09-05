<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeleteGig extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $listing;

    /**
     * Create a new listing instance.
     *
     * @return void
     */
    public function __construct($listing)
    {
        $this->listing = $listing;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return
            $this->subject("A Gig Was Deleted")
            ->replyTo($this->listing->user->email, $this->listing->user->name)
            ->view('emails.deleted-gig-notification');
    }
}
