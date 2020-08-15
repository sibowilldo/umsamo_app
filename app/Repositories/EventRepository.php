<?php


namespace App\Repositories;


use App\EventDate;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DatePeriod;

class EventRepository
{
    const EVENT_DATE_ACTIVE_STATUS = 8;

    /**
     * if is_auto is true this method selects dates of the same day in a month of a specified date
     * e.g. if 02 Jun 2020, is on a Tuesday, then returned value will be,
     * an array containing dates of all Tuesdays in Jun 2020 beginning with 02 Jun 2020
     *
     * @param $dates_limit
     * @param bool $is_auto
     * @return array
     * @throws \Exception
     */
    public static function getEventDates($dates_limit = [], $is_auto = false)
    {

        $values=[];
        try {
            $disabled_dates = EventDate::whereDate('date_time', '>', Carbon::now())->pluck('date_time')->toArray();
            if(false){
//                foreach(cache('public_holidays')['response']['holidays'] as $entry){
//                    if($entry['type'][0] === 'National holiday'){
//                        array_push($disabled_dates, new Carbon($entry['date']['iso']));
//                    }
//                }
            }

            if($is_auto){
                $start = new Carbon($dates_limit[0]['date_time']);
                $days = new DatePeriod($start->toDate(), CarbonInterval::week(), $start->endOfMonth());
                foreach ($days as $day){
                    if(!in_array($day, $disabled_dates)){
                        $values[]= ['date_time' => $day->format('Y-m-d'), 'limit' =>  $dates_limit[0]['limit'], 'status_id' => self::EVENT_DATE_ACTIVE_STATUS];
                    }
                }
            }else{
                foreach($dates_limit as $date_limit){
                    $values[]= ['date_time' => $date_limit['date_time'], 'limit' =>  $date_limit['limit'], 'status_id' => self::EVENT_DATE_ACTIVE_STATUS];
                }
            }

            return $values;
        } catch (\Exception $e) {
            return $values;
        }
    }
}
