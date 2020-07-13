<?php

namespace App\Http\Controllers;

use App\Family;
use App\Notifications\FamilyMemberInvite;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $family = Family::create(['name' => $request->family_name]);
            Auth::user()->families()->attach($family->id, ['is_head' => true, 'joined_at' => now()]);
        });

        return response()->json([
                            'title' => 'Family created successfully',
                            'message' => 'You can now invite members from the Overview screen.',
                            'redirect_url' => route('profiles.overview', Auth::user()->uuid)], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        return \request()->wantsJson()
            ?new Response(['data' => $family], Response::HTTP_ACCEPTED):$family;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        //
    }

    /**
     *
     *
     * @param \App\Family $family
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function invite($id, Request $request)
    {
        $family = Family::whereUuid($id)->firstOrFail();

        $profile = Profile::where('id_number', $request->member)->firstOrFail();
        DB::transaction(function () use (&$family, &$profile){
            $profile->user->families()->detach($family->id);
            $profile->user->families()->attach($family->id, ['is_head' => false]);
        });

        $profile->user->notify(new FamilyMemberInvite($family));
        return response()->json(['title' => 'Success', 'message' => $profile->fullname. ' was invited successfully',
            'redirect_url' => route('profiles.overview', Auth::user()->uuid)],Response::HTTP_CREATED);
    }

    /**
     *
     *
     * @param $fam
     * @param User $user
     * @param $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept($fam, User $user, $code)
    {
        Auth::id() === $user->id?:abort(403, 'This action is unauthorized. Please use an account that received this invitation.');
        $family = Family::whereUuid($fam)->firstOrFail();

        DB::transaction(function () use(&$family, &$user, $code){
            $user->families()->updateExistingPivot($family->id, ['joined_at' => now(), 'is_head' => false]);
            $verify = $user->pin_codes()->where('code', $code)->firstOrFail();
            $verify->delete();
        });

        return response()->redirectToRoute('dashboard');
    }
}
