<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\AccountRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    use SendsPasswordResetEmails;

    public function lock(User $user)
    {
        AccountRepository::LOCK($user);
    }

    public function locked()
    {
        if(Auth::check()){
            Auth::logout();
            Session::flush();
        }

        $token = html_entity_decode(\request()->query('t'));
        $user = html_entity_decode(\request()->query('u'));

        $page_title = 'Account Locked!';
        return response()->view('auth.locked', compact('token', 'user','page_title'));
    }

    public function unlock(Request $request)
    {
        AccountRepository::UNLOCK($request->only('email', 'how', 'who'));
        $this->sendResetLinkEmail($request);
        return response()->redirectToRoute('login')->with(['unlocked' => 'Your account has been unlocked, we have sent you an email with instructions on how to reset your password.']);
    }
}
