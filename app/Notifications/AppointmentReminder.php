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
    protected $details;

    /**
     * Create a new notification instance.
     *
     * @param array $details
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', SmsPortal::class];//
    }

    public function toSmsPortal($notifiable): SmsMessage
    {
        return (new SmsMessage())
            ->setContent('Thokozani bogogo nomkhulu. This is a reminder for your appointment with us, on '. $this->details['date_time'] . '. ' . config('app.name'))
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
        return (new MailMessage)
            ->subject(config('app.name') .' - Appointment Reminder')
            ->markdown('mail.appointment.reminder', ['url'=> $this->details['url'], 'date_time' => $this->details['date_time']]);
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
