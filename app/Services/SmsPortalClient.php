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
        $this->client_id = config('app.smsportal_client_id');
        $this->api_secret = config('app.smsportal_api_secret');
        $this->test_mode = config('app.smsportal_test_mode');
        $this->_token = $this->getAuthToken();
    }

    protected function getAuthToken(): string
    {
        try{
            Log::info(sprintf('Tying to authorize SMS Portal. Client: %s , API: %s , Test Mode: %s', config('app.smsportal_client_id'), config('app.smsportal_api_secret'), config('app.smsportal_test_mode')));
            $response = Http::withBasicAuth( config('app.smsportal_client_id'), config('app.smsportal_api_secret'))
                ->withHeaders(['content-type' => 'application/json'])
                ->get('https://rest.smsportal.com/v1/Authentication');

            Log::info('SMS Authorize Response: ' . $response);
            if($response->successful()){
                Log::info('Response Successful');
                return $response['token'];
            }else{
             $response->throw();
            }
        } catch (RequestException $e) {
            Log::critical('SMSPortal response: Could not get Token', $e->getTrace());
        }
    }

    public function sendSMS(array $message): bool
    {
        $send_options = ['TestMode' => config('app.smsportal_test_mode')];
        $messages = [
            [
                'Content' => $message['message'],
                'Destination' => $message['to']
            ]
        ];

        Log::info('Sending SMS with token: ' . $this->_token);
        try {
            if(config('app.env') == 'production'){
                $response = Http::withToken($this->_token)
                    ->post('https://rest.smsportal.com/v1/BulkMessages', [
                        'SendOptions' => $send_options,
                        'Messages' => $messages,
                    ]);
                if($response->successful()){
                    Log::info("SMS sent successfully to ". count($messages) . " recipient(s)");
                    return true;
                }else{
                    $response->throw();
                }
            }else{
                Log::info('Fake Sending SMS because environment is: '.config('app.env'));
                return true;
            }
        }catch (RequestException $e){
            Log::critical('Error sending SMS: ', $e->getTrace());
            return false;
        }
    }
}
