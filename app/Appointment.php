<?php

namespace App;

use Carbon\Carbon;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Appointment extends Model
{

    use GeneratesUuid, SoftDeletes;

    const STATUS_ACTIVE = 11;
    const STATUS_CANCELLED = 12;
    const STATUS_CONFIRMED = 13;
    const STATUS_DELETED = 14;
    const STATUS_PENDING = 15;

    const TYPE_CLEANSING = 1;
    const TYPE_CONSULTING = 2;

    const MORPH_TYPE_USER = 'App\User';
    const MORPH_TYPE_FAMILY = 'App\Family';

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

    protected $appends = ['has_passed'];

    public static function types(){
        return collect([['id' => 1, 'title' => 'Cleansing'], ['id' => 2, 'title' => 'Consulting']]);
    }

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

    public function getHasPassedAttribute()
    {

        return $this->event_date->date_time->lessThan(Carbon::today());
    }

    public static function APPOINTMENT_TYPES(int $int)
    {
        switch($int){
            case 1 :
                return "Cleansing";
            case 2 :
                return "Consulting";
            default :
                return "Invalid";
        }
    }
}
