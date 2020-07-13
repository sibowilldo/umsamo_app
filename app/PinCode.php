<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PinCode extends Model
{

    const VERIFY_OTP_TYPE = 1;
    const FAMILY_INVITE_TYPE = 2;
    const ACCOUNT_LOCKED_TYPE = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'code',
        'type',
        'expires_at',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
