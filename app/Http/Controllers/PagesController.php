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

        $appointments = AppointmentRepository::USER_APPOINTMENTS($user, ['status','event_date','event_date.event','event_date.event.status'], ['uuid', 'event_date_id', 'status_id', 'created_at']);
        $comments = CommentRepository::USER_COMMENTS($user,'created_at', 'asc',['status', 'appointment'], ['status_id', 'body', 'appointment_id', 'created_at'], 4);

        //Get only the events that have more than 0 Event Dates
        $events = Event::with(['event_dates','status'])->has('event_dates', '>', 0)->take(6)->get();

        //Get only Future Event Dates, that the user does not have an appointment on
        $event_dates = EventDate::whereNotIn('id', $appointments->pluck('event_date_id'))->whereIn('event_id', $events->pluck('id'))->whereDate('date_time', '>', now())->get();

//        $events = $events->whereIn('id', $event_dates->pluck('event_id'))->whereIn('status_id', [self::ACTIVE_EVENT_STATUS, self::PUBLISHED_EVENT_STATUS]);


        return response()->view('pages.dashboard', compact('events', 'event_dates', 'appointment_types', 'appointments', 'comments', 'page_title', 'page_description', 'provinces'));
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
