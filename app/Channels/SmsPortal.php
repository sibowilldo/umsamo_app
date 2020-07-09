<?php


namespace App\Channels;


use App\Services\SmsPortalClient;
use Illuminate\Http\Client\RequestException;
use Illuminate\Notifications\Notification;

class SmsPortal
{
    /**
     * @param $notifiable
     * @param Notification $notification
     * @throws RequestException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSmsPortal($notifiable);
        $smsClient = new SmsPortalClient();

        $smsClient->sendSms([
            'to' => $message->getRecipient(),
            'message' => $message->getContent()]
        );
    }
}
