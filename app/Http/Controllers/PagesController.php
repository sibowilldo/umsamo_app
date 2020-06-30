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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Object_;

class PagesController extends Controller
{
    public function index()
    {
        $page_title = 'Dashboard';
        $page_description = "Welcome to your dashboard";

        $provinces = Region::$provinces;
        $appointment_types = Appointment::$types;

        $user = User::with(['comments.status','comments.appointment', 'appointments.status:id,title,color',
            'appointments.event_date', 'families', 'familyAppointments', 'families.users', 'families.users.profile',
            'comments' => function($q){
                $q->latest()->take(4);
            }])
            ->findOrFail(Auth::id());

        $members  = $members = $user->families;
        $family_appointments = $user->familyAppointments;
        $appointments =$user->appointments->where('event_date.date_time', '>=', now())->sortBy('event_date.date_time')->take(5);

        $comments = $user->comments->sort();

        return response()->view('pages.dashboard', compact('user', 'members', 'family_appointments','appointment_types', 'appointments', 'comments', 'page_title', 'page_description', 'provinces'));
    }

    /**
     * Demo methods below
     */

    // Datatables
    public function datatables()
    {
        $page_title = 'Datatables';
        $page_description = 'This is datatables test page';

        return view('pages.datatables', compact('page_title', 'page_description'));
    }

    // KTDatatables
    public function ktDatatables()
    {
        $page_title = 'KTDatatables';
        $page_description = 'This is KTdatatables test page';

        return view('pages.ktdatatables', compact('page_title', 'page_description'));
    }

    // Select2
    public function select2()
    {
        $page_title = 'Select 2';
        $page_description = 'This is Select2 test page';

        return view('pages.select2', compact('page_title', 'page_description'));
    }

    // Quicksearch Result
    public function quickSearch()
    {
        return view('layout.partials.extras._quick_search_result');
    }
}
