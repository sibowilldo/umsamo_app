<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Hash;

class PasswordChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $unlock_token;
    /**
     * Create a new notification instance.
     *
     * @param string $unlock_token
     */
    public function __construct(string $unlock_token)
    {
        $this->unlock_token = $unlock_token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('auth.lock.account', ['user' => $notifiable->uuid, 'token' => Hash::make($this->unlock_token)]);
        $unlock_token = $this->unlock_token;

        return (new MailMessage)->markdown('mail.users.change-password', compact('unlock_token', 'url'));
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
