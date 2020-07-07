<?php


namespace App\Services;


use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsPortalClient
{
    private $_token;
    private $client_id;
    private $api_secret;
    private $test_mode;

    public function __construct()
    {
        $this->client_id =config('app.smsportal_client_id');
        $this->api_secret = config('app.smsportal_api_secret');
        $this->test_mode = config('app.smsportal_test_mode');
        $this->_token = $this->getAuthToken();
    }

    protected function getAuthToken(): string
    {
        try{
            $response = Http::withBasicAuth($this->client_id, $this->api_secret)
                ->withHeaders(['content-type' => 'application/json'])
                ->get('https://rest.smsportal.com/v1/Authentication');

            if($response->successful()){
                return $response['token'];
            }else{
             $response->throw();
            }
        } catch (RequestException $e) {
            Log::error('SMSPortal Auth Get Token', $e->getTrace());
        }
    }

    public function sendSMS(array $message): bool
    {
        $send_options = ['TestMode' => $this->test_mode];
        $messages = [
            [
                'Content' => $message['message'],
                'Destination' => $message['to']
            ]
        ];


        try {
            $response = Http::withToken($this->_token)->post('https://rest.smsportal.com/v1/BulkMessages', [
                'SendOptions' => $send_options,
                'Messages' => $messages,
            ]);
            Log::info($response);
            if($response->successful()){
                Log::info("SMS sent successfully to ". count($messages) . " recipient(s)");
                return true;
            }else{
                $response->throw();
            }
        }catch (RequestException $e){
            Log::error('SMSPortal Send SMS ', $e->getTrace());
            return false;
        }
    }
}
