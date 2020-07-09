<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Comment;
use App\Event;
use App\EventDate;
use App\Family;
use App\Http\Resources\EventResource;
use App\Region;
use App\Repositories\AppointmentRepository;
use App\Repositories\CommentRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Object_;

class PagesController extends Controller
{
    public function index()
    {
        $provinces = Region::$provinces;
        $appointment_types = Appointment::types();

        $user = User::with(['comments.status','comments.appointment', 'appointments.status:id,title,color',
            'appointments.event_date', 'families', 'familyAppointments', 'families.users', 'families.users.profile',
            'comments' => function($q){
                $q->latest()->take(4);
            }])
            ->findOrFail(Auth::id());
        $members  = $user->families;

        $family_appointments = $user->familyAppointments;
        if($user->hasAnyRole(User::SUPER_ADMIN_ROLE, User::ADMIN_ROLE)){
            $appointments = Appointment::with(['status:id,title,color', 'familyAppointments', 'familyAppointments.user', 'familyAppointments.status:id,title,color'])
                ->get()
                ->where('event_date.date_time', '=', Carbon::today()->format('Y-m-d H:i:s'));
        }else{

            $appointments =$user->appointments->where('event_date.date_time', '>=', Carbon::now()->format('Y-m-d'))->sortBy('event_date.date_time')->take(5);
        }


        $comments = $user->comments->sort();

        $page_title = 'Dashboard';
        $page_description = "Welcome {$user->profile->fullname}";


        return response()->view('pages.dashboard', compact('user', 'members', 'family_appointments','appointment_types', 'appointments', 'comments', 'page_title', 'page_description', 'provinces'));
    }
    
    // Quicksearch Result
    public function quickSearch()
    {
        return view('layout.partials.extras._quick_search_result');
    }
}
