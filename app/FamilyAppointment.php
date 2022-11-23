<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyAppointment extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_CANCELLED=27;
    public const STATUS_CONFIRMED=28;
    public const STATUS_DELETED=29;
    public const STATUS_PENDING=30;
    public const STATUS_POSTPONED=31;

    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id','family_id','appointment_id','status_id'];
    protected $with = ['user','appointment', 'status', 'family'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
