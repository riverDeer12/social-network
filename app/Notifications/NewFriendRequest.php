<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewFriendRequest extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail', 'broadcast', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You received a new friend request from' . $this->user->name)
                    ->action('View users profile', route('profile', ['username' => $this->user->username]))
                    ->line('Thank you for using our social network!');
    }

    public function toArray($notifiable)
    {
        return [
            'name' => $this->user->name,
            'username' => $this->user->username,
            'message' => ' sent you a friend request.'
        ];
    }
}
