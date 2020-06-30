<?php


namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\Request;

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
