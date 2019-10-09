<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HobbyCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $firstName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $firstName)
    {
        $this->title = $title;
        $this->firstName = $firstName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('YOUR NEW HOBBY IS REGISTERED')
            ->markdown('emails.hobbycreated');
    }
}
