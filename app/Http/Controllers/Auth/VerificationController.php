<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('auth.verify')->with(['page_title' => 'Verify your email address']);
    }



    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function show_cell()
    {
        return response()->view('auth.cell');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function confirm_cell(Request $request)
    {

        $user = User::findOrFail(Auth::id());
        $pin_code = $user->pin_codes()->where('code', $request->onetime)->first();

        if($pin_code === null){
            return back()->with('error',  'One Time Pin Expired!');
        }

        $user->profile->update(['cell_number_verified_at' => now()]);

        $pin_code->delete();

        return response()->redirectToRoute('dashboard');
    }

}
