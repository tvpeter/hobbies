<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HobbyUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $hobby;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $hobby)
    {
        $this->user = $user;
        $this->hobby = $hobby;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.hobbyupdated');
    }
}
