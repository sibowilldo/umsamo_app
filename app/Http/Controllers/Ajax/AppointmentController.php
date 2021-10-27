<?php

namespace App\Http\Controllers\Ajax;

use App\Appointment;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $appointments = Appointment::whereHasMorph('appointmentable', ['App\User'],
            function(Builder $builder) use ($user) {
                $builder->where('id', $user->id);
            })->orWhereHasMorph('appointmentable', ['App\Family'],
            function(Builder $builder) use ($user) {
                $builder->whereIn('id', $user->families->pluck('id'));
            });
        return Datatables::of($appointments)
            ->addColumn('action', function(){})
            ->editColumn('created_at', function ($user) {
                return $user->created_at ? with(new Carbon($user->created_at))->format('Y-m-d') : '';
            })
            ->filterColumn('email', function ($query, $keyword) {
                $query->where('email', $keyword);
            })
            ->filter(function ($query) use ($request) {
                if (!$request->has('joined_between')) {
                    return;
                }
                switch (sizeof($request->joined_between)){
                    case 1:
                        $start = new Carbon($request->joined_between[0]);
                        $query->whereDate('users.created_at','=', $start);
                        break;
                    case 2:
                        if($request->joined_between[0] == $request->joined_between[1]){
                            $start = new Carbon($request->joined_between[0]);
                            $query->whereDate('users.created_at','=', $start);
                        }else{
                            $query->whereBetween('users.created_at', $request->joined_between);
                        }
                        break;
                }
            })
            ->make(true);
    }
}
