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

        /**
        //Old Chunk
        if($user->hasAnyRole([User::SUPER_ADMIN_ROLE, User::ADMIN_ROLE])){
        }
        elseif($user->hasRole(USER::CLIENT_ROLE)){

            $appointments = [];

            foreach($user->families as $user_family){
            $appointments[$user_family->id] = AppointmentRepository::GET_APPOINTMENTS($user_family, ['event_date'], ['event_date_id'])->get()->pluck('event_date_id')->toArray();
            }

            $appointments[] = AppointmentRepository::GET_APPOINTMENTS($user, ['event_date'], ['event_date_id'])->get()->pluck('event_date_id')->toArray();
            $appointments =  $this->array_values_recursive($appointments);

            //array_values_recursive return a value, in this case an int if the array passed has 1 value

            $appointments = is_int($appointments)?[$appointments]:$appointments;

            $event_dates = EventDate::whereDate('date_time', '>=', Carbon::now())
                                        ->withCount(['appointments as confirmed_appointments' => function($q){
                                        $q->whereIn('status_id', [Appointment::STATUS_RESCHEDULED, Appointment::STATUS_CONFIRMED]);
                                    }])
                                    ->whereNotIn('id', $appointments??[])
                                    ->orderBy('date_time')
                                    ->get();
        }
    **/

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
