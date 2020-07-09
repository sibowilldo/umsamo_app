<?php


namespace App\Repositories;


use App\Appointment;
use App\EventDate;
use App\Status;

class EventDateRepository
{


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
        if($appointment->type == Appointment::TYPE_CONSULTING){

            switch ($appointment->status_id){
                case Appointment::STATUS_DELETED:
                case Appointment::STATUS_CANCELLED:
                    $event_date->increment('limit');
                    break;
                case Appointment::STATUS_ACTIVE:
                case Appointment::STATUS_CONFIRMED:
                    $event_date->decrement('limit');
                    break;
            }
        }


       $event_date->limit > 1 ?: $event_date->update(['status_id' => EventDate::STATUS_FULL]);

        return $event_date;
    }
}
