<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\ConfirmCellNumber;
use App\PinCode;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{

    /**
 * Show the email verification notice.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return mixed
 */
    public function show()
    {
        $page_title = 'Verify your Cell Phone Number';
        return response()->view('auth.cell', compact('page_title'));
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function confirm(Request $request)
    {

        $user = User::findOrFail(Auth::id());
        $pin_code = $user->pin_codes()->where('code', $request->onetime)->first();

        if($pin_code === null){
            return response()->json(['title'=>'Error!','message' =>  'One Time Pin Expired!'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->profile->update(['cell_number_verified_at' => now()]);
        $pin_code->delete();

        return response()->json(['title'=>'OTP verified!',
            'message' =>  'You now have full access to the Appointment System!',
            'redirect_url' => route('dashboard')], Response::HTTP_ACCEPTED);
    }


    /**
     * Show the email verification notice.
     *
     * @param User $user
     * @return mixed
     */
    public function request(User $user)
    {
        $pin_codes = PinCode::where(['user_id' => $user->id, 'type' => PinCode::VERIFY_OTP_TYPE])->delete();
        $user->notify(new ConfirmCellNumber());
        return response()->json(['title'=>' Done!',
            'message' =>  'A fresh One Time Pin has been sent!'], Response::HTTP_OK);
    }
}
