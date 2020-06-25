<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Comment;
use App\Event;
use App\EventDate;
use App\Http\Resources\EventResource;
use App\Region;
use App\Repositories\AppointmentRepository;
use App\Repositories\CommentRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    const ACTIVE_EVENT_STATUS = 1;
    const PUBLISHED_EVENT_STATUS = 6;

    public function index()
    {
        $page_title = 'Dashboard';
        $user = User::findOrFail(Auth::id());

        $page_description = "Welcome to your dashboard {$user->profile->fullname}";
        $provinces = Region::$provinces;
        $appointment_types = Appointment::$types;

        $families = $user->families;
        $appointments = AppointmentRepository::GET_APPOINTMENTS($user,['status','event_date','event_date.event','event_date.event.status'],['uuid', 'event_date_id', 'status_id','type', 'created_at']);
        $comments = CommentRepository::USER_COMMENTS($user,'created_at', 'asc',['status', 'appointment'], ['status_id', 'body', 'appointment_id', 'created_at'], 4);

        return response()->view('pages.dashboard', compact('appointment_types', 'appointments', 'comments', 'families', 'page_title', 'page_description', 'provinces'));
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
