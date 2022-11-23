<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use SoftDeletes;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'contact_number',
        'province',
        'address',
        'coordinates',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public static $provinces = [
        'Eastern Cape' => 'Eastern Cape',
        'Free State' => 'Free State',
        'Gauteng' => 'Gauteng',
        'KwaZulu-Natal' => 'KwaZulu-Natal',
        'Limpopo' => 'Limpopo',
        'Mpumalanga' => 'Mpumalanga',
        'Northern Cape' => 'Northern Cape',
        'North West' => 'North West',
        'Western Cape' => 'Western Cape',
    ];
}
