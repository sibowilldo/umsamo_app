<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\EventDate;
use App\Notifications\AppointmentCreated;
use App\Notifications\AppointmentReminder;
use App\Region;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function index()
    {

        $user = Auth::user();
        $page_title = 'Dashboard';
        $page_description = "Welcome {$user->profile->fullname}";
        $provinces = Region::$provinces;
        $appointment_types = Appointment::types();

        $family_appointments = [];
        $appointments = [];
        $members = [];
        $comments = [];

        if($user->hasAnyRole(User::SUPER_ADMIN_ROLE, User::ADMIN_ROLE)){
            $dashboard_view = 'backend.dashboard.administrator';
            $event_date = EventDate::where('date_time', '=', Carbon::today()->format('Y-m-d H:i:s'))
                ->with(['appointments' => function($q){
                    $q->limit(9);
                },'appointments.appointmentable','appointments.status:id,title,color','status:id,title,color'])
                ->first();
            if($event_date){
                $appointments = $event_date->appointments;
            }
        }
        else{
            $dashboard_view = 'backend.dashboard.client';
            $user = User::where('id',$user->id)->with(['appointments', 'appointments.status:id,title,color',
                            'comments.status:id,title,color','comments.appointment',
                            'familyAppointments','familyAppointments.status', 'familyAppointments.appointment',
                            'families', 'families.users', 'families.users.profile'])->first();
            $members  = $user->families;
            $comments = $user->comments->sort()->take(4);

            $family_appointments = $user->familyAppointments;
            $appointments =$user->appointments->where('event_date.date_time', '>=', Carbon::today()->format('Y-m-d'))->sortBy('event_date.date_time')->take(5);

        }
        return response()->view($dashboard_view, compact('user', 'members', 'family_appointments','appointment_types', 'appointments', 'comments', 'page_title', 'page_description', 'provinces'));

    }

    // Quicksearch Result
    public function quickSearch()
    {
        return view('layout.partials.extras._quick_search_result');
    }

    public function testSMS()
    {
        $details = [];
        $details['date_time'] = Carbon::today()->format('M d, Y');
        $appointment = Appointment::first();
        $details['reference'] = $appointment->reference;
        $details['url'] = route('appointments.show', $appointment->uuid);

        $user =  User::where('email', 'sibongiseni.msomi@outlook.com')->firstOrFail();
        $user->notify(new AppointmentReminder($details));

        return response()->json($user, 200);
    }


    public function testNotifications()
    {
        $appointment = Appointment::first();
        $user = User::where('email', 'sibongiseni.msomi@outlook.com')->firstOrFail();
        $user->notify(new AppointmentCreated($appointment));
        return response()->json('OK!', 200);
    }
}
