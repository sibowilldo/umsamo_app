<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{    /**
 * Display overview of a user's profile.
 *
 * @param User $user
 * @return Response
 */
    public function overview(User $user)
    {
        Gate::authorize('view', $user);

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
        Gate::authorize('view', $user);
        $page_title = "Profile";
        $page_description = "Update your Personal Information";
        return response()->view('backend.profile.personal-information', compact('user', 'page_title', 'page_description'));
    }

    public function account_information(User $user)
    {
        Gate::authorize('view', $user);
        $page_title = "Profile";
        $page_description = "Update your Account Information";
        return response()->view('backend.profile.account-information', compact('user', 'page_title', 'page_description'));
    }

    public function manage_family(User $user)
    {
        Gate::authorize('view', $user);
        $page_title = "Manage Family";
        $page_description = "";
        return response()->view('backend.profile.add-family', compact('user', 'page_title', 'page_description'));
    }

}
