<?php

namespace App\Http\Controllers\Ajax;

use App\EventDate;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventDateController extends Controller
{
    public function index()
    {
        $event_dates = EventDate::whereDate('date_time', '>=', Carbon::now())->orderBy('date_time')->get();
        return response()->json(['data' => $event_dates], 200);
    }
}
