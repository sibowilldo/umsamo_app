<?php


namespace App\Repositories;


use App\EventDate;
use App\Status;

class EventDateRepository
{
    /**
     * Decrease Event Date limit by 1 if Appointment Type is Consulting"
     * Set or Create EventDate Status to Full if limit is less 1
     *
     * @param EventDate $event_date
     * @param string $appointment_type
     * @return EventDate
     */
    public static function UPDATE_LIMIT(EventDate $event_date, string $appointment_type)
    {
        if($appointment_type == 'Consulting'){
            $event_date->update(['limit' => $event_date->limit - 1]);
        }

        if($event_date->limit < 1){
            $status = Status::firstOrCreate(['title'=> 'Full', 'model_type' => 'App\EventDate'], ['description' => 'Assigned to an Event Date that no longer has available spaces.']);
            $event_date->update(['status_id' => $status->id]);
        }
        return $event_date;
    }
}
