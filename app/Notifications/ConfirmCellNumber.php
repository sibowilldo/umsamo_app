<?php

namespace App\Notifications;

use App\Channels\SmsPortal;
use App\Notifications\Messages\SmsMessage;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class ConfirmCellNumber extends Notification implements ShouldQueue
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
        return [SmsPortal::class];
    }


    public function toSmsPortal($notifiable): SmsMessage
    {
        $pin_code = $notifiable->pin_codes()->create([
            'code' => Str::upper(Str::random(5)),
            'expires_at' => Carbon::now()->addHours(4),
            'is_active' => true
        ]);

        return (new SmsMessage())
            ->setContent( "Your OTP for Cell Phone Number verification is {$pin_code->code} and is valid for only 4 hours. " . config('app.name'))
            ->setRecipient($notifiable->profile->cell_number);
    }
}
