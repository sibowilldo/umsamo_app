<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Appointments as AppointmentResource;
use App\Repositories\AppointmentRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = User::with(['families', 'families.appointments'])->findOrFail(Auth::id());

        $appointments = AppointmentRepository::GET_APPOINTMENTS($user,
            ['status','event_date','event_date.event','event_date.event.status', 'appointmentable'],
            ['uuid','reference', 'event_date_id','appointmentable_type', 'appointmentable_id', 'status_id','type', 'created_at'])->get();

        return AppointmentResource::collection($appointments);
    }
}
