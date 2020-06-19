<?php

namespace App;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use GeneratesUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'appointment_id',
        'url',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'reservation_id' => 'integer',
        'uuid' => EfficientUuid::class,
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function attachment_meta()
    {
        return $this->hasOne(AttachmentMeta::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Appointment::class);
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
}
