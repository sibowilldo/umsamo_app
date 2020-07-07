<?php

namespace App;

use Carbon\Carbon;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Appointment extends Model
{

    use GeneratesUuid;

    const STATUS_CANCELLED = 12;
    const STATUS_CONFIRMED = 13;
    const STATUS_PENDING = 15;

    protected $with = ['event_date', 'appointmentable'];

    protected $dateFormat = 'Y-m-d H:i:s';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'reference',
        'event_date_id',
        'region_id',
        'status_id',
        'with_family',
        'type',

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


    public function appointmentable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
      return  $this->hasMany(Comment::class);
    }

    public function event_date()
    {
        return $this->belongsTo(EventDate::class);
    }

    /**
     *
     *A user hasMany Family Appointments
     *
     * @return HasMany
     */
    public function familyAppointments()
    {
        return $this->hasMany(FamilyAppointment::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
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

    public function scopeDueToday($query)
    {
        return $query->where('event_date.date_time', '=', Carbon::today()->format('Y-m-d H:i:s'));
    }

}
