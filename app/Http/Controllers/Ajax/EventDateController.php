<?php

namespace App\Http\Controllers\Ajax;

use App\Appointment;
use App\EventDate;
use App\Http\Controllers\Controller;
use App\Repositories\AppointmentRepository;
use App\User;
use Auth;
use Carbon\Carbon;

class EventDateController extends Controller
{
    public function index()
    {
        $event_dates = EventDate::whereDate('date_time', '>=', Carbon::now())
            ->where(['status_id'=> EventDate::STATUS_ACTIVE])
            ->orderBy('date_time')
            ->confirmedAppointments()
            ->get();
        if(count($event_dates) <1){
            $event_dates = [];
        }
        return response()->json(['data' => $event_dates], 200);
    }

    /**
     * Get all values in a multidimensional array
     *
     * @param $key string
     * @param $arr array
     * @return null|string|array
     */
    private function array_values_recursive(array $arr){
        $val = array();
        array_walk_recursive($arr, function($v, $k) use( &$val){
            array_push($val, $v);
        });
        return count($val) > 1 ? $val : array_pop($val);
    }

}
