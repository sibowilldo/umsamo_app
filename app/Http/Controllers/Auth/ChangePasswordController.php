<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\PasswordChangedNotification;
use App\PinCode;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'password'],
            'password' => ['required', new MatchOldPassword],
            'password_confirmation' => ['same:password'],

        ]);


        $unlock_token = $this->getUnlockToken();
        $user = User::findOrFail(Auth::id());
        DB::transaction(function() use ($unlock_token, &$user, $request){
            $user->update(['password'=> Hash::make($request->password)]);

            $user->pin_codes()->create([
                'code' => $unlock_token,
                'type' => PinCode::ACCOUNT_LOCKED_TYPE,
                'is_active' => true
            ]);
        });

        $user->notify(new PasswordChangedNotification($unlock_token));

        Auth::logoutOtherDevices($request->password);

        return response()->json(['title' => 'Your password was updated successfully', 'message' => 'Please use your new Password to sign in next time',
                                'redirect_url' => route('profiles.overview', $user->uuid)],
                            Response::HTTP_ACCEPTED);
    }

    private function getUnlockToken()
    {
        return Str::upper(Str::random(7));
    }
}
