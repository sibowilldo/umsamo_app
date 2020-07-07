<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventDate extends Model
{
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

}
