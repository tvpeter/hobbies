<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HobbyCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $hobby;
    public $firstName;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($hobby, $firstName)
    {
        $this->hobby = $hobby;
        $this->firstName = $firstName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toNexmo($notifiable)
    {
 
        $message = 'Hello '.$this->firstName.', you just add a new hobby '.$this->hobby.' to your list.';
 
        return (new NexmoMessage())
                    ->content($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
