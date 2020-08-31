<?php

namespace App\Http\Controllers\Ajax;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Button;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:kingpin|administrator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $users = User::select(['users.id','uuid', 'email', 'is_locked', 'users.created_at']);
        return Datatables::of($users->role('client'))
                ->addColumn('action', function ($user) {
                    $edit_url = route('users.edit', $user->uuid);
                    $delete_url = route('api.users.destroy', $user->uuid);
                    $edit = "<a href='{$edit_url}' class='btn btn-icon btn-sm btn-clean'><i class='la la-edit'></i></a>";
                    $delete = "<button type='button' data-url='{$delete_url}' class='btn btn-icon btn-sm btn-clean deleteBtn'><i class='la la-trash-alt'></i></button>";
                    return $edit . $delete;})
                ->editColumn('created_at', function ($user) {
                    return $user->created_at ? with(new Carbon($user->created_at))->format('Y-m-d') : '';
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
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $request['ignore_logout'] = true;
        $data = $request->only(['id_number','date_of_birth','first_name','last_name','gender','address','city','province','postal_code']);
        Validator::make($data, [
            'id_number' => ['required', 'string', Rule::unique('profiles')->ignore($user->profile->id)],
            'date_of_birth' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'postal_code' => ['required'],
        ])->validate();

        if($user->email !== $request->email){
            $user = UserRepository::UPDATE_EMAIL($user, $request->only('email', 'ignore_logout' ));
        }
        if($user->profile->cell_number !== $request->cell_number){
            $profile = ProfileRepository::UPDATE_CELL($user->profile, $request->only('cell_number'));
        }
        $update_response = ProfileRepository::UPDATE_PROFILE($user, $data);

        return response()->json(['title' => $update_response['title'], 'message' => $update_response['message'], 'url' => route('users.index')], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        DB::transaction(function ()  use($user){
            $user->appointments()->update(['status_id'=> Appointment::STATUS_DELETED]);
            $user->familyAppointments()->delete();
            $user->families()->delete();
            $user->delete();
            $user->profile()->delete();
        });
        return response()->json(['title' => 'Success', 'message' => "Patient sent to bin!", 'redirect_url' => route('users.index')]);
    }

    /**
     * Toggle User Lock Status.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleLock(User $user)
    {
        $user->is_locked = !$user->is_locked;
        $user->save();
        $status = $user->is_locked?'lock':'unlock';
        return response()->json(['title' => 'Success', 'message' => "Account set to {$status}, successfully!"]);
    }
}
