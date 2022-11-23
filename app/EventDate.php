<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDate extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 8;
    const STATUS_FULL = 9;

    protected $fillable = ['event_id', 'status_id', 'date_time', 'limit'];
    protected $withCount = ['appointments'];
    protected $casts = ['date_time'=>'date:Y-m-d'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function scopeConfirmedAppointments($query)
    {
        return $query->withCount(['appointments as confirmed_appointments_count' => function($q){
            $q->whereIn('status_id', [Appointment::STATUS_CONFIRMED, Appointment::STATUS_RESCHEDULED]);
        }]);
    }
}
