<?php


namespace App\Repositories;


use App\Family;
use App\Notifications\ConfirmCellNumber;
use App\Profile;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $user->profile->update($data);
        return ['title' => 'Update Success', 'message' => 'Your information was updated successfully', 'redirect_url' => route('profiles.overview', $user->uuid)];
    }

    /**
     * @param Profile $profile
     * @param array $data
     * @return Profile
     */
    public static function UPDATE_CELL(Profile $profile, array $data) : Profile
    {
        Validator::make($data, [
            'cell_number' => ['required', 'string', 'unique:profiles'],
        ])->validate();
        $profile->update($data);
        $profile->cell_number_verified_at = null;
        $profile->save();

        $profile->user->notify(new ConfirmCellNumber());

        return $profile;
    }
}
