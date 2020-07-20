<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\AccountRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{


    public function show(User $user)
    {
        Gate::authorize('view', $user);
        $page_title = "Update Profile";
        $page_description = "Change your password";
        return response()->view('backend.profile.change-password', compact('user', 'page_title', 'page_description'));
    }

    /**
     * Updates resource
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $user = AccountRepository::UPDATE_PASSWORD($request->only('current_password', 'password', 'password_confirmation'));
        return response()->json([
                    'title' => 'Your password was updated successfully',
                    'message' => 'Please use your new Password to sign in next time',
                    'redirect_url' => route('profiles.overview', $user->uuid)],
                Response::HTTP_ACCEPTED);
    }
}
