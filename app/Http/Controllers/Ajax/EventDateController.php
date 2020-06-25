<?php

namespace App\Http\Controllers\Ajax;

use App\EventDate;
use App\Http\Controllers\Controller;
use App\Repositories\AppointmentRepository;
use Auth;
use Carbon\Carbon;

class EventDateController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if(!$user->hasAnyRole(['kingpin', 'administrator'])){
            $appointments = AppointmentRepository::GET_APPOINTMENTS($user, ['event_date'], ['event_date_id']);
            $event_dates = EventDate::whereNotIn('id', $appointments->pluck('event_date_id'))->whereDate('date_time', '>=', Carbon::now())->orderBy('date_time')->get();
        }else{
            $event_dates = EventDate::whereDate('date_time', '>=', Carbon::now())->orderBy('date_time')->get();
        }
        return response()->json(['data' => $event_dates], 200);
    }
}
