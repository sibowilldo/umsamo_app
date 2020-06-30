<?php

namespace App\Http\Controllers\Ajax;

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
        $user = Auth::user();

        if(!$user->hasAnyRole([User::SUPER_ADMIN_ROLE, User::ADMIN_ROLE])){
            $appointments = [];

            foreach($user->families as $user_family){
                $appointments[$user_family->id] = AppointmentRepository::GET_APPOINTMENTS($user_family, ['event_date'], ['event_date_id'])->pluck('event_date_id')->toArray();
            }
            $appointments[] =AppointmentRepository::GET_APPOINTMENTS($user, ['event_date'], ['event_date_id'])->pluck('event_date_id')->toArray();

            $appointments =  $this->array_values_recursive($appointments);
            $event_dates = EventDate::whereNotIn('id', [$appointments])
                ->whereDate('date_time', '>=', Carbon::now())->orderBy('date_time')->get();
        }else{
            $event_dates = EventDate::whereDate('date_time', '>=', Carbon::now())->orderBy('date_time')->get();
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
