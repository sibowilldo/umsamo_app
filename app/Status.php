<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    /**
     *
     *
     * @var array
     */
    protected $cascadeDeletes = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'model_type',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_active' => 'boolean',
    ];

    public static $model_types = [
        'App\Appointment' => 'Appointments',
        'App\Comment' => 'Comments',
        'App\Event' => 'Events',
        'App\Item' => 'Items',
        'App\Invoice' => 'Invoices'
    ];

    public static function statusExists($title = null, $model_type = null)
    {
      return Status::where(['title'=> $title, 'model_type' => $model_type])->first();
    }
    //events, items, invoices, reservations comments
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
