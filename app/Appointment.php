<?php

namespace App;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use GeneratesUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'status_id',
        'reserved_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'event_id' => 'integer',
        'status_id' => 'integer',
        'uuid' => EfficientUuid::class,
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function event()
    {
        return $this->belongsTo(\App\Event::class);
    }

    public function status()
    {
        return $this->belongsTo(\App\Status::class);
    }

    /**
     * Binds route key to uuid value
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
