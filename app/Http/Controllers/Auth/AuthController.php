<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UnlockAccount;
use App\PinCode;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{


    use SendsPasswordResetEmails;

    public function changeEmailAndCellPhoneNumber(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if($request->cell_number !== $user->profile->cell_number){
            $this->changeCellPhoneNumber($user, $request->cell_number);
        }

        if($request->email !== $user->email){
            $this->changeEmail($user, $request->email);
        }
    }

    public function lock(User $user)
    {
        $token = html_entity_decode(request()->token);
        $normal_token = PinCode::where(['user_id' => $user->id, 'type' => PinCode::ACCOUNT_LOCKED_TYPE ])->firstOrFail();
        if(Hash::check($normal_token->code, $token)){
            $user->is_locked = true;
            $user->save();
            Mail::to($user)->send(new UnlockAccount($user, encrypt($normal_token->code)));
            abort(503, 'Your account is now locked!');
        }else{
            abort(403, 'Supplied token is invalid or has been tempered with!');
        }
    }

    public function locked()
    {
        if(Auth::check()){
            Auth::logout();
        }

        $token = html_entity_decode(\request()->query('t'));
        $user = html_entity_decode(\request()->query('u'));

        $page_title = 'Account Locked!';
        return response()->view('auth.locked', compact('token', 'user','page_title'));
    }

    public function unlock(Request $request)
    {
        DB::transaction(function() use ($request){
            $user = User::whereUuid($request->who)->where(['email' => $request->email, 'is_locked' => true])->firstOrFail();

            $pin_code = PinCode::where(['user_id' => $user->id, 'type' => PinCode::ACCOUNT_LOCKED_TYPE, 'code' => decrypt($request->how) ])->firstOrFail();

            $pin_code->delete();
            $user->password = User::generatePassword();
            $user->is_locked = false;
            $user->save();
        });

        $this->sendResetLinkEmail($request);
        return response()->redirectToRoute('login')->with(['unlocked' => 'Your account has been unlocked, we have sent you an email with instructions on how to reset your password.']);
    }


    private function changeCellPhoneNumber($user, $cell_number)
    {

    }

    private function changeEmail($user, $email)
    {

    }
}
