<?php


namespace App\Repositories;


use App\Appointment;
use App\EventDate;
use App\Status;

class EventDateRepository
{
    const APPOINTMENT_STATUS_CANCELLED = 12;
    const APPOINTMENT_STATUS_DELETED = 14;
    const APPOINTMENT_STATUS_ACTIVE = 11;
    const EVENT_DATE_STATUS_ACTIVE = 8;
    const EVENT_DATE_STATUS_FULL = 9;

    /**
     * Decrease Event Date limit by 1 if Appointment Type is Consulting"
     * Set or Create EventDate Status to Full if limit is less 1
     *
     * @param EventDate $event_date
     * @param Appointment $appointment
     * @return EventDate
     */
    public static function UPDATE_LIMIT(EventDate $event_date, Appointment $appointment) : EventDate
    {

        if(strcasecmp($appointment->type, 'Consulting') == 0){

            switch ($appointment->status_id){
                case self::APPOINTMENT_STATUS_DELETED:
                case self::APPOINTMENT_STATUS_CANCELLED:
                    $event_date->increment('limit');
                    break;
                case self::APPOINTMENT_STATUS_ACTIVE:
                    $event_date->decrement('limit');
                    break;
            }
        }


       $event_date->limit > 1 ?: $event_date->update(['status_id' => self::EVENT_DATE_STATUS_FULL]);

        return $event_date;
    }
}
