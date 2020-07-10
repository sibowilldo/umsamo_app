<?php

namespace App\Notifications;

use App\Appointment;
use App\Channels\SmsPortal;
use App\Notifications\Messages\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public $appointment;
    /**
     * Create a new notification instance.
     *
     * @param Appointment $appointment
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', SmsPortal::class];
    }

    public function toSmsPortal($notifiable): SmsMessage
    {
        return (new SmsMessage())
            ->setContent('REF: '. $this->appointment->reference .'. Your appointment for '. $this->appointment->event_date->date_time->format('D, d M Y') . ' was confirmed successfully! uMsamo Institute')
            ->setRecipient($notifiable->profile->cell_number);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $appointment_date = $this->appointment->event_date->date_time->format('D, d M Y');
        $appointment_reference = $this->appointment->reference;

        return (new MailMessage)->markdown('mail.appointment.created', compact('appointment_reference', 'appointment_date'))
                                ->subject('[Umsamo Institute] Appointment Confirmation');
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
