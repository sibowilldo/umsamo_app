<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPatientsList extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    protected $attachment;
    protected $is_actual;

    /**
     * Create a new message instance.
     *
     * @param string $attachment
     * @param bool $is_actual
     */
    public function __construct(string $attachment, bool $is_actual=false)
    {
        $this->attachment = $attachment;
        $this->is_actual = $is_actual;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->is_actual?
            'Please find attached, patients list for today.':
            'Please find attached, patients list for tomorrow. Kindly note, this is a preliminary list and is subject to change.';
        return $this->markdown('mail.admin.appointment.list', compact('message'))
                    ->subject(config('app.name'). ' - Patients List')
                    ->attach($this->attachment);
    }
}
