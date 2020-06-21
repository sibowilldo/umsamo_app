<?php

namespace App\Http\Controllers;

use App\Event;
use App\Repositories\EventRepository;
use App\Status;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DatePeriod;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page_title = 'Events';
        $events = Event::with(['event_dates', 'regions', 'status'])->select('uuid', 'status_id', 'title', 'description', 'created_at')->get();

        $statuses =$events->pluck('status');

        return response()->view('backend.event.index', compact('events', 'statuses', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page_title = 'Create Event';
        $statuses = Status::where('model_type', 'App\Event')->pluck('title', 'id');
        return response()->view('backend.event.create', compact('statuses', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $repo_event_dates=[];
        $repo_event_dates = EventRepository::getEventDates($request['event_date'], $request->has('auto_select_dates'));

        $event = Event::create($request->only('title', 'description', 'item_id', 'status_id'));
        $event_dates = $event->event_dates()->createMany($repo_event_dates);

        return response()->redirectToRoute('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
