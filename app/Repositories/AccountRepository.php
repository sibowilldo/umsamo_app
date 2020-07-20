<?php


namespace App\Repositories;


use App\Mail\UnlockAccount;
use App\Notifications\PasswordChangedNotification;
use App\PinCode;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AccountRepository
{
    public static function LOCK(User $user)
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

    public static function UNLOCK(array $data)
    {
        DB::transaction(function() use ($data){
            $user = User::whereUuid($data['who'])->where(['email' => $data['email'], 'is_locked' => true])->firstOrFail();
            $pin_code = PinCode::where(['user_id' => $user->id, 'type' => PinCode::ACCOUNT_LOCKED_TYPE, 'code' => decrypt($data['how'])])->firstOrFail();
            $pin_code->delete();
            $user->password = User::generatePassword();
            $user->is_locked = false;
            $user->save();
        });

    }

    /**
     * Updates users password
     * Generates an account unlock token, in case of malicious activity
     * Terminates sessions from other logged in devices
     * Notifies user of password change.
     *
     * @param array $data
     * @return User
     */
    public static function UPDATE_PASSWORD(array $data) : User
    {
        Validator::make($data, [
            'current_password' => ['required', 'password'],
            'password' => ['required', new MatchOldPassword],
            'password_confirmation' => ['same:password'],
        ])->validate();

        $unlock_token = (new UserRepository())->getUnlockToken();
        $user = User::findOrFail(Auth::id());
        DB::transaction(function() use ($unlock_token, &$user, $data){
            $user->update(['password'=> Hash::make($data['password'])]);
            $user->pin_codes()->create([
                'code' => $unlock_token,
                'type' => PinCode::ACCOUNT_LOCKED_TYPE,
                'is_active' => true
            ]);
        });

        Auth::logoutOtherDevices($data['password']);
        $user->notify(new PasswordChangedNotification($unlock_token));

        return $user;
    }

    private function getUnlockToken()
    {
        return Str::upper(Str::random(7));
    }
}
