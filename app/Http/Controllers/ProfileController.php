<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return Response
     */
    public function overview(User $user)
    {
        return response()->view('backend.profile.overview', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Profile $profile
     * @return Response | Profile
     */
    public function show(Profile $profile)
    {
        return \request()->wantsJson()
            ?new Response(['profile' => $profile, 'family'=>$profile->user->families()->get()], 200)
            :$profile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
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
