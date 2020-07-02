<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Profile extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'avatar',
        'id_number',
        'gender',
        'first_name',
        'last_name',
        'date_of_birth',
        'cell_number',
        'address',
        'city',
        'province',
        'postal_code',
        'profile_completed_at',
        'cell_number_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'profile_completed_at' => 'date',
        'cell_number_verified_at' => 'date',
        'deleted_at' =>'date',
        'date_of_birth' => 'date'
    ];

    /**
     * @var string[]
     */
    protected $dates = ['date_of_birth', 'profile_completed_at', 'cell_number_verified_at', 'deleted_at'];


    protected $appends = ['avatar_url', 'fullname'];

    /**
     *
     * A Profile belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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
        return 'id_number';
    }


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function getAvatarUrlAttribute()
    {
        return asset($this->avatar);
    }

    public function getMaskedIdNumberAttribute()
    {
        return str_replace(Str::substr($this->id_number, 6, 5), '*****', $this->id_number);
    }
}
