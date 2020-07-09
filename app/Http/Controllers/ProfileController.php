<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Profile;
use App\Repositories\ProfileRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /**
     * Display overview of a user's profile.
     *
     * @param User $user
     * @return Response
     */
    public function overview(User $user)
    {
        $page_title = 'Profile Overview';
        $page_description = "";

        $user = User::with([ 'comments' => function($q){
            $q->latest()->take(4);
        },
            'comments.status','comments.appointment', 'appointments.status:id,title,color','appointments.event_date', 'families',
            'familyAppointments', 'families.users', 'families.users.profile'])->findOrFail($user->id);


        $family_appointments = $user->familyAppointments;
        $appointments = $user->appointments->where('event_date.date_time', '>=', now())->sortBy('event_date.date_time')->take(5);
        $families = $user->families;
        $comments = $user->comments->sort();
        $appointment_types = Appointment::types();
        return response()->view('backend.profile.overview', compact('appointment_types','user', 'families', 'family_appointments', 'appointments', 'comments', 'page_title', 'page_description'));
    }

    public function personal_information(User $user)
    {
        $page_title = "Profile";
        $page_description = "Update your Personal Information";
        return response()->view('backend.profile.personal-information', compact('user', 'page_title', 'page_description'));
    }

    public function account_information(User $user)
    {
        $page_title = "Profile";
        $page_description = "Update your Account Information";
        return response()->view('backend.profile.account-information', compact('user', 'page_title', 'page_description'));
    }

    public function change_password(User $user)
    {
        $page_title = "Profile";
        $page_description = "Update your password";
        return response()->view('backend.profile.change-password', compact('user', 'page_title', 'page_description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Profile $profile
     * @return Response | Profile
     */
    public function show(Profile $profile)
    {
        return \request()->wantsJson()
            ?new Response(['profile' => $profile, 'family'=>$profile->user->families()->get()], 200)
            :$profile;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Profile $profile
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Profile $profile)
    {
        $user = $profile->user;
        $data= $request->only('update', 'first_name', 'last_name', 'address', 'city', 'province', 'postal_code',
            'email', 'current_password', 'password', 'password_confirmation');

        $response_message = ProfileRepository::UPDATE_PROFILE($user, $data);

        return response()->json($response_message, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
