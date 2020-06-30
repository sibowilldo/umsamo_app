<?php


namespace App\Repositories;


use App\Appointment;
use App\EventDate;
use App\Family;
use App\FamilyAppointment;
use App\User;
use Illuminate\Http\Request;

class FamilyAppointmentRepository
{
    /**
     * Creates 1 or more Family Appointments for users passed via request as UUID!
     * Returns an array of family appointments
     *
     * @param Family $family
     * @param Appointment $appointment
     * @param array $family_members
     * @param Request $request
     * @return array
     */
    public static function NEW_FAMILY_APPOINTMENT(Family $family, Appointment $appointment, array $family_members, Request $request) : array
    {
        $familyAppointments = [];
        $family_members = User::whereUuid($family_members)->get();

        foreach ($family_members as $family_member){
            $familyAppointment = FamilyAppointment::updateOrCreate(
                ['user_id'=> $family_member->id, 'appointment_id' => $appointment->id,],
                ['family_id' => $family->id,'status_id' => FamilyAppointment::STATUS_CONFIRMED]);
            array_push($familyAppointments, $familyAppointment);
        }
        return $familyAppointments;
    }
}
