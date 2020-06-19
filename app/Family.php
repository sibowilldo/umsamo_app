<?php

namespace App;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use GeneratesUuid, SoftDeletes;

    protected $fillable = ['uuid', 'name'];

    protected $dates = ['deleted_at'];


    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(['is_leader']);
    }
}
