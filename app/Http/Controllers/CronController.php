<?php

namespace App\Http\Controllers;

use App\EventDate;
use Carbon\Carbon;
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

            $disabled_dates = EventDate::whereDate('date_time', '>', Carbon::now())->pluck('date_time')->toArray();
            foreach(cache('public_holidays')['response']['holidays'] as $entry){
                if($entry['type'][0] === 'National holiday'){
                    array_push($disabled_dates, new Carbon($entry['date']['iso']));
                }
            }

            return response()->json($disabled_dates, 200);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
