<?php

namespace App;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Status extends Model
{
    use SoftDeletes, CascadeSoftDeletes, HasFactory;

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
        'color',
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
        'App\EventDate' => 'Event Dates',
        'App\FamilyAppointment' => 'Family Appointments',
        'App\Item' => 'Items',
        'App\Invoice' => 'Invoices'
    ];

    public static $colors = [
        "white"=> "white",
        "primary"=> "primary",
        "secondary"=> "secondary",
        "success"=> "success",
        "info"=> "info",
        "warning"=> "warning",
        "danger"=> "danger",
        "light"=> "light",
        "dark"=> "dark"
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

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getCancelledAttribute()
    {
        return !strcasecmp($this->title, 'cancelled');
    }
}
