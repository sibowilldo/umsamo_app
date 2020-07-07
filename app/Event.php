<?php

namespace App;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes, GeneratesUuid;

    protected $with = ['event_dates'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'item_id',
        'title',
        'description',
        'limit',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'region_id' => 'integer',
        'status_id' => 'integer',
        'uuid' => EfficientUuid::class,
    ];

    public function event_dates()
    {
        return $this->hasMany(EventDate::class);
    }

    /**
     * @return BelongsToMany
     */
    public function regions()
    {
        return $this->belongsToMany(Region::class);
    }


    /**
     * @return BelongsTo
     */
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
}
