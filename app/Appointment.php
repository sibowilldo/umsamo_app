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
        'event_date_id',
        'region_id',
        'status_id',
        'type'
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

    public static $types = [
        'cleansing' => 'Cleansing',
        'consulting' => 'Consulting'
    ];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function comments()
    {
        $this->hasMany(Comment::class);
    }

    public function event_date()
    {
        return $this->belongsTo(\App\EventDate::class);
    }

    public function status()
    {
        return $this->belongsTo(\App\Status::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
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
