<?php


namespace App\Repositories;


use App\Appointment;
use App\EventDate;
use App\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\This;

class AppointmentRepository
{
    /**
     * @param $appointmentable
     * @param array $relationships
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function GET_APPOINTMENTS($appointmentable, $relationships = [], $columns = [])
    {
        return Auth::user()->hasAnyRole([User::SUPER_ADMIN_ROLE, User::ADMIN_ROLE])
            ? Appointment::with($relationships)->select($columns)
            : $appointmentable->appointments()->with($relationships)->select($columns);
    }

    /**
     * Create a new User Appointment, and set status to Pending
     *
     * @param $appointmentable
     * @param EventDate $event_date
     * @param Request $request
     * @param string $reference_prepend
     * @return Appointment
     */
    public static function NEW_APPOINTMENT($appointmentable, EventDate $event_date, Request $request, $reference_prepend='slf'): Appointment
    {
        return $appointmentable->appointments()->updateOrCreate(
            ['event_date_id' => $event_date->id],
            [   'reference' => self::GENERATE_REFERENCE($reference_prepend),
                'region_id' => $event_date->event->regions->first()->id,
                'status_id' => Appointment::STATUS_CONFIRMED,
                'with_family' => $request->with_family,
                'type' => $request->appointment_type]);
    }


    /**
     * @param string $prepend
     * @return string
     */
    public static function GENERATE_REFERENCE($prepend = 'slf') : string
    {
        do
        {
            $now = Carbon::now();
            $ref_ymd = $now->format('ymdh');
            $ref_hms = $now->format('ms');
            $ref_rand_str = Str::random(3);
            $reference = Str::upper(sprintf("%s-%d-%04d%s", $prepend, $ref_ymd, $ref_hms,$ref_rand_str));// Str::upper($prepend .'-'. sprintf('%04d', rand(0000, 9999)) . '-'. Str::random(4));
            $result = Appointment::where('reference', $reference)->first();
        }
        while($result);
        return $reference;
    }

    /**
     * @param string $custom_date
     * @param array $appointment_statuses
     * @return Collection
     */
    public static function CUSTOM_DATE_APPOINTMENTS(string $custom_date, array $appointment_statuses) : Collection
    {
        $event_date = EventDate::where('date_time', '=', $custom_date)
            ->with(['appointments' => function($q) use ($appointment_statuses){
                $q->with([
                    'familyAppointments', 'familyAppointments.user', 'familyAppointments.status:id,title,color',
                    'status:id,title,color'
                ])->whereIn('status_id', $appointment_statuses);
            }])
            ->first();

        return $event_date?$event_date->appointments:Collect([]);
    }
}
