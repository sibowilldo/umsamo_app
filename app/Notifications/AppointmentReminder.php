<?php

namespace App\Notifications;

use App\Channels\SmsPortal;
use App\Notifications\Messages\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentReminder extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];//[SmsPortal::class];
    }

    public function toSmsPortal($notifiable): SmsMessage
    {
        return (new SmsMessage())
            ->setContent('Your appointment is coming up in 2 days')
            ->setRecipient($notifiable->profile->cell_number);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $url =  route('appointments.show', $notifiable->uuid);

        return (new MailMessage)
            ->subject('Appointment Reminder')
            ->markdown('mail.appointment.reminder', ['url'=>$url, 'full_name' => $notifiable->profile->fullname]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
