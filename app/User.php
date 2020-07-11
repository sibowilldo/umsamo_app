<?php

namespace App;

use App\Mail\WelcomeNewUserMail;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable, SoftDeletes, GeneratesUuid, HasRoles;

    const CLIENT_ROLE = 'client';
    const ADMIN_ROLE = 'administrator';
    const SUPER_ADMIN_ROLE = 'kingpin';

    protected $with = ['profile'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'uuid' => EfficientUuid::class,
    ];

    public static function generatePassword()
    {
        return bcrypt(Str::random());
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

    /**
     * A user hasOne profile
     *
     * @return hasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * A user hasOne profile
     *
     * @return BelongsToMany
     */
    public function families()
    {
        return $this->belongsToMany(Family::class)->withPivot(['is_head', 'joined_at']);
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
     *A user hasMany Pin Code
     *
     * @return HasMany
     */
    public function pin_codes()
    {
        return $this->hasMany(PinCode::class);
    }

    /**
     * A user hasOne profile
     *
     * @return HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     *
     * @return MorphMany
     */
    public function appointments()
    {
        return $this->morphMany(Appointment::class, 'appointmentable');
    }

    public static function sendWelcomeEmail($profile)
    {
        // Send email
        Mail::to($profile->user)->queue(new WelcomeNewUserMail($profile->user));
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }


}
