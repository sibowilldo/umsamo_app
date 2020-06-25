<?php


namespace App\Repositories;


use App\Appointment;
use App\EventDate;
use App\Status;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AppointmentRepository
{
    const APPOINTMENT_STATUS_PENDING = 15;
    const APPOINTMENT_STATUS_CONFIRMED = 13;

    public static function GET_APPOINTMENTS(User $user, $relationships = [], $columns = [])
    {
        return $user->hasAnyRole(['kingpin', 'administrator'])
            ? Appointment::with($relationships)->select($columns)->get()
            : $user->appointments()->with($relationships)->select($columns)->get();
    }

    /**
     * Create a new User Appointment, and set status to Pending
     *
     * @param $appointmentable
     * @param EventDate $event_date
     * @param Request $request
     * @return Model
     */
    public static function NEW_APPOINTMENT($appointmentable, EventDate $event_date, Request $request)
    {
        $status = Status::findOrFail(self::APPOINTMENT_STATUS_PENDING)->select('id')->first();

        return $appointmentable->appointments()->updateOrCreate(
            ['event_date_id' => $event_date->id],
            ['region_id' => $event_date->event->regions()->first()->id,
            'status_id' => $status->id,
            'with_family' => $request->with_family,
            'type' => $request->appointment_type]);
    }
}
