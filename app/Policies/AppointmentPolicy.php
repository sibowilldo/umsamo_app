<?php

namespace App\Policies;

use App\Appointment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AppointmentPolicy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        if ($user->hasAnyRole([User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE])) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function view(User $user, Appointment $appointment)
    {
        switch(class_basename($appointment->appointmentable_type)){
            case 'Family':
                return ($user->families->where('id', $appointment->appointmentable->id)->first() != null);
            case 'User':
                return ($user->id === $appointment->appointmentable->id);
            default:
                return false;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAnyRole([User::CLIENT_ROLE])
            ? Response::allow()
            : Response::deny('You are not allowed to make Appointments.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function update(User $user, Appointment $appointment)
    {
        switch(class_basename($appointment->appointmentable_type)){
            case 'Family':
                return $user->families->where('id', $appointment->appointmentable->id)->first() != null;
            case 'User':
                return $user->id === $appointment->appointmentable->id;
            default:
                return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function delete(User $user, Appointment $appointment)
    {
        return $user->hasAnyRole([User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function restore(User $user, Appointment $appointment)
    {
        return $user->hasAnyRole([User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function forceDelete(User $user, Appointment $appointment)
    {
        return $user->hasAnyRole([User::SUPER_ADMIN_ROLE]);
    }
}
