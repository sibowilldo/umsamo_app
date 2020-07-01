<?php


namespace App\Repositories;


use App\Appointment;
use App\EventDate;
use App\Status;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\This;

class AppointmentRepository
{
    /**
     * @param User $user
     * @param array $relationships
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function GET_APPOINTMENTS($appointmentable, $relationships = [], $columns = [])
    {
        return Auth::user()->hasAnyRole([User::SUPER_ADMIN_ROLE, User::ADMIN_ROLE])
            ? Appointment::with($relationships)->select($columns)->get()
            : $appointmentable->appointments()->with($relationships)->select($columns)->get();
    }

    /**
     * Create a new User Appointment, and set status to Pending
     *
     * @param $appointmentable
     * @param EventDate $event_date
     * @param Request $request
     * @return Appointment
     */
    public static function NEW_APPOINTMENT($appointmentable, EventDate $event_date, Request $request): Appointment
    {
        return $appointmentable->appointments()->updateOrCreate(
            ['event_date_id' => $event_date->id],
            ['region_id' => $event_date->event->regions->first()->id,
                'status_id' => Appointment::STATUS_CONFIRMED,
                'with_family' => $request->with_family,
                'type' => $request->appointment_type]);
    }
}
