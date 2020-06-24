<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeNewUserMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;
    protected $token;
    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        ;
        return $this->markdown('emails.users.welcome')
                    ->with(['url' => route('password.reset', $this->getToken()),
                            'user' => $this->user]);
    }

    protected function getToken()
    {
        return $this->token = app('auth.password.broker')->createToken($this->user);
    }
}
