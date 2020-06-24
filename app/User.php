<?php

namespace App;

use App\Mail\WelcomeNewUserMail;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
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
        return $this->belongsToMany(Family::class);
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
     * A user hasOne profile
     *
     * @return MorphMany
     */
    public function appointments()
    {
        return $this->morphMany(Appointment::class, 'appointmentable');
    }

    public static function sendWelcomeEmail($user)
    {
        // Send email
        Mail::to($user)->queue(new WelcomeNewUserMail($user));
    }

}
