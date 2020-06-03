<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Comment;
use App\Event;
use App\EventDate;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    const ACTIVE_EVENT_STATUS = 1;
    const PUBLISHED_EVENT_STATUS = 6;

    public function index()
    {
        $page_title = 'Dashboard';
        $user = Auth::user();
        $page_description = "Welcome to your dashboard {$user->profile->fullname}";

        $appointment_types = Appointment::$types;
        $appointments = Appointment::where('user_id', $user->id)->with(['status'=> function($query){
            $query->where('model_type', 'App\Appointment')->select('id', 'title', 'color');
        },'event_date','event_date.event','event_date.event.status'])->select('uuid', 'event_date_id', 'status_id', 'created_at')->get();

        //

        $comments = Comment::where('user_id', $user->id)->latest()->with(['status'=> function($query){
            $query->where('model_type', 'App\Comment')->select('id', 'title', 'color');
        }])->select('status_id', 'body', 'appointment_id', 'created_at')->take(4)->get();

        //Get only the events that have more than 0 Event Dates
        $events = Event::with(['event_dates','status' => function($query){
            $query->where('model_type', 'App\Event')->select('id', 'title', 'color');
        }])->has('event_dates', '>', 0)->take(6)->get();

        //Get only Future Event Dates, that the user does not have an appointment on
        $event_dates = EventDate::whereNotIn('id', $appointments->pluck('event_date_id'))->whereIn('event_id', $events->pluck('id'))->whereDate('date_time', '>', now())->get();

        $events = $events->whereIn('id', $event_dates->pluck('event_id'))->whereIn('status_id', [self::ACTIVE_EVENT_STATUS, self::PUBLISHED_EVENT_STATUS]);


        return view('pages.dashboard', compact('events', 'event_dates', 'appointment_types', 'appointments', 'comments', 'page_title', 'page_description'));
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
