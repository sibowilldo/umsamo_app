<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use HolidayAPI\Client as HolidayClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CronController extends Controller
{
    public function getPublicHolidays()
    {
        try {

            $key = config('app.holiday_api_key');
            $year = now()->format('Y');
            $request_url = 'https://calendarific.com/api/v2/holidays?api_key='.$key.'&country=ZA&year='. $year;

            cache()->remember('public_holidays', now()->addYear(), function () use ($request_url){
                $response = Http::get($request_url);
                return $response->json();
            });

            return response()->json(cache('public_holidays')['response']['holidays'], 200);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }
}
