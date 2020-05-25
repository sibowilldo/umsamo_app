<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status_id',
        'reservation_id',
        'content',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'status_id' => 'integer',
        'reservation_id' => 'integer'
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function status()
    {
        return $this->belongsTo(\App\Status::class);
    }

    public function reservation()
    {
        return $this->belongsTo(\App\Appointment::class);
    }
}
