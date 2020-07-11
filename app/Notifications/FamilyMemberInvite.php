<?php

namespace App\Notifications;

use App\Family;
use App\PinCode;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FamilyMemberInvite extends Notification implements ShouldQueue
{
    use Queueable;

    private $family;
    private $sender;

    /**
     * Create a new notification instance.
     *
     * @param Family $family
     * @param User $sender
     */
    public function __construct(Family $family)
    {
        $this->family = $family;
        $this->sender = Auth::user();
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
        $code = $notifiable->pin_codes()->create([
            'code' => Str::random(9),
            'type' => PinCode::FAMILY_INVITE_TYPE,
            'expires_at' => Carbon::now()->addDay(),
            'is_active' =>true,
        ]);
        $sender = $this->sender;
        $family = $this->family;
        $accept_url = route('families.accept', [$family->uuid, $notifiable->uuid, $code->code] );

        return (new MailMessage)->markdown('mail.family.invite.requested', compact('sender', 'family', 'accept_url'))
                                ->subject('uMsamo Institute - You have been invited to join a Family Group.');
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
