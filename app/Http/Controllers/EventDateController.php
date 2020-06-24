<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event_dates = EventDate::whereDate('date_time', '>=', Carbon::now())->orderBy('date_time')->get();
        return response()->view('');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EventDate  $eventDates
     * @return \Illuminate\Http\Response
     */
    public function show(EventDate $eventDates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventDate  $eventDates
     * @return \Illuminate\Http\Response
     */
    public function edit(EventDate $eventDates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventDate  $eventDates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventDate $eventDates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventDate  $eventDates
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventDate $eventDates)
    {
        //
    }
}
