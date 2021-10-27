<?php

namespace App\Http\Controllers\Ajax;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Appointments as AppointmentResource;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with(['families', 'families.appointments'])->findOrFail(Auth::id());

        $appointments = Appointment::whereHasMorph('appointmentable', ['App\User'],
            function(Builder $builder) use ($user) {
                $builder->where('id', $user->id);
            })->orWhereHasMorph('appointmentable', ['App\Family'],
            function(Builder $builder) use ($user) {
                $builder->whereIn('id', $user->families->pluck('id'));
            })->get();

        return AppointmentResource::collection($appointments);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
