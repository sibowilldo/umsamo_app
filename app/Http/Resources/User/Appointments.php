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
            'title' => '[' .$this->reference . '] ' . Appointment::APPOINTMENT_TYPES($this->type),
            'start' => $this->event_date->date_time->format('Y-m-d H:m:s'),
            'end' => $this->event_date->date_time->format('Y-m-d H:m:s'),
            'className' => 'fc-event-'. $this->status->color,
            'url' => route('appointments.show', $this->uuid)
        ];
    }
}
