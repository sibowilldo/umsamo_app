<?php

namespace App\Http\Controllers;

use App\Event;
use App\Region;
use App\Repositories\EventRepository;
use App\Status;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DatePeriod;
use Dyrynda\Database\Casts\EfficientUuid;
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
        $events = Event::with(['event_dates', 'regions', 'status'])->select('id','uuid', 'status_id', 'title', 'description', 'created_at')->get();

        $statuses =$events->pluck('status')->unique();

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $repo_event_dates=[];
        $repo_event_dates = EventRepository::getEventDates($request['event_date'], $request->has('auto_select_dates'));

        $event = Event::create($request->only('title', 'description', 'item_id', 'status_id'));


        Region::first()->events()->attach($event->id);

        foreach ($repo_event_dates as $event_date){
            $event_dates = $event->event_dates()->updateOrCreate($event_date);
        }

        return response()->redirectToRoute('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $uuid
     * @return Response
     */
    public function show($event)
    {

        $data = ['appointments' => $event->event_dates->sum('appointments_count'),
                'total_limits' => $event->event_dates->sum('limit')];

        $data['appointments'] == 0
            ? $data['percentage'] = 0
            : $data['percentage'] = ceil(($event->event_dates->sum('appointments_count')/$event->event_dates->sum('limit'))*100);

        return request()->wantsJson()
            ? new Response([$data])
            : response()->view('backend.event.show', compact('event'));
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
