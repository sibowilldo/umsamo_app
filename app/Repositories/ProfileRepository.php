<?php


namespace App\Repositories;


use App\Family;
use App\Profile;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileRepository
{


    /**
     * ProfileRepository constructor.
     */
    public function __construct()
    {
    }

    public static function CREATE_PROFILE(User $user, Request $request)
    {

    }

    /**
     * @param Profile $profile
     * @param Request $request
     * @return array|bool
     */
    public static function DO_SEARCH_SECURITY_CHECK(Profile $profile, Request $request)
    {
        if($profile->id === Auth::user()->profile->id){
            return ['response_text' =>[ 'message' => 'Can\'t search yourself, in this instance.'], 'status_code' => Response::HTTP_NOT_IMPLEMENTED];
        }
        if($profile->user->email_verified_at == null){
            return ['response_text' => ['message' => 'This member has not verified their account!'], 'status_code' => Response::HTTP_NOT_IMPLEMENTED];
        }
        if($profile->user->is_locked){
            return ['response_text' => ['message' => 'This member does not have an active account!'], 'status_code' => Response::HTTP_NOT_IMPLEMENTED];
        }
        $family = Family::whereUuid($request->family)->firstOrFail();
        if($family->users()->where('user_id', $profile->user->id)->first() !== null){
            return ['response_text' => ['message' => 'This member is already part of this family!'], 'status_code' => Response::HTTP_NOT_IMPLEMENTED];
        }

        return true;
    }

    /**
     * @param User $user
     * @param array $data
     * @return array $response_data['title', 'message', 'redirect_url']
     */
    public static function UPDATE_PROFILE(User $user, array $data) : array
    {
        $response_data = [];
        if(array_key_exists('update', $data)){
            switch($data['update']){
                case 'personal:information':
                    $response_data = (new ProfileRepository)->update_personal_information($user, $data);
                    break;
                case 'account:information':
//                    $data = $request->only('email');
                    break;
                case 'password:change':
//                    $data = $request->only();
                    break;
            }
        }
        return $response_data;
    }

    protected function update_personal_information(User $user, array $data)
    {
        $user->profile->update($data);

        //todo Send Email Notification
        return ['title' => 'Update Success', 'message' => 'Your information was updated successfully', 'redirect_url' => route('profiles.overview', $user->uuid)];
    }
}
