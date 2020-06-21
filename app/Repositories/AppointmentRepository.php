<?php


namespace App\Repositories;


use App\Appointment;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AppointmentRepository
{
    /**
     * @param array $relationships
     * @param array $columns
     * @return Builder[]|Collection
     */
    public static function ALL_APPOINTMENTS($relationships = [], $columns = ['*'])
    {
      return  Appointment::with($relationships)->select($columns)->get();
    }

    /**
     * @param User $user
     * @param array $relationships
     * @param array $columns
     * @return Collection
     */
    public static function USER_APPOINTMENTS(User $user, $relationships = [], $columns = [])
    {
      return  $user->appointments()->with($relationships)->select($columns)->get();
    }
}
