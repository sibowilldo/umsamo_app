<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Profile;
use App\Repositories\ProfileRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{

    /**
     * Search the specified resource in storage.
     *
     * @param Profile $profile
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Profile $profile)
    {
        if($profile->id === Auth::user()->profile->id){
            return response()->json(['message' => 'Can\'t search yourself, in this instance.'], Response::HTTP_NOT_IMPLEMENTED);
        }

        return response()->json(['profile' => $profile, 'family'=>$profile->user->families()->get()], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Profile $profile
     * @return Response | Profile
     */
    public function show(Profile $profile)
    {
        Gate::authorize('view', $profile);
        return \request()->wantsJson()
            ?new Response(['profile' => $profile, 'family'=>$profile->user->families()->get()], 200)
            :$profile;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Profile $profile
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Profile $profile)
    {
        Gate::authorize('update', $profile);

        $user = $profile->user;
        $data= $request->only('update', 'first_name', 'last_name', 'address', 'city', 'province', 'postal_code',
            'email', 'current_password', 'password', 'password_confirmation');

        $response_message = ProfileRepository::UPDATE_PROFILE($user, $data);

        return response()->json($response_message, 200);
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
