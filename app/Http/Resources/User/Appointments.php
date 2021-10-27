<?php

namespace App\Http\Resources\User;

use App\Appointment;
use Illuminate\Http\Resources\Json\JsonResource;

class Appointments extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'appointment_id' => $this->uuid,
            'title' => $this->reference ,
            'start' => $this->event_date->date_time->format('Y-m-d'),
            'end' => $this->event_date->date_time->format('Y-m-d'),
            'className' => 'fc-event-'. $this->status->color,
            'editable' => true,
            'description' => Appointment::APPOINTMENT_TYPES($this->type),
            'appointment_type' => Appointment::APPOINTMENT_TYPES($this->type)
//            'url' => route('appointments.show', $this->uuid)
        ];
    }
}
