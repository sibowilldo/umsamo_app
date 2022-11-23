<?php

namespace App;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use GeneratesUuid, SoftDeletes;
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $fillable = ['uuid', 'name'];
    protected $with = ['users'];
    protected $withCount = ['users'];


    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(['is_head', 'joined_at']);
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

    /**
     *
     * @return MorphMany
     */
    public function appointments()
    {
        return $this->morphMany(Appointment::class, 'appointmentable');
    }

    /**
     * Binds route key to uuid value
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

}
