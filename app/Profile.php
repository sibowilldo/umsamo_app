<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'avatar',
        'first_name',
        'last_name',
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
        'cell_number_verified_at' => 'date'
    ];

    /**
     * @var string[]
     */
    protected $dates = ['profile_completed_at', 'cell_number_verified_at'];

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


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
