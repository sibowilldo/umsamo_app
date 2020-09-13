<?php


namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserRepository
{
    /**
     * Registers a new user with a random password.
     * Via ProfileObserver this methods generate a random token and emails the user
     *
     * @param array $data
     * @return mixed
     */
    public static function NEW_USER(array $data)
    {
        Validator::make($data, [
            'id_number' => ['required', 'string', 'unique_encrypted:profiles,id'],
            'cell_number' => ['required', 'string', 'unique_encrypted:profiles,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique_encrypted:users,uuid'],
        ], ['unique_encrypted' => 'The :attribute is already taken.'])->validate();

        $user = User::where('email', $data['email'])->first();
        if($user){
            return $user;
        }

        $user = User::firstOrCreate(
            ['email' => $data['email']],
            ['password' => User::generatePassword()]
        );

        $user->profile()->firstOrCreate(
            ['id_number' => $data['id_number']],
            [
                'avatar' => 'media/users/blank.png',
                'date_of_birth' => $data['date_of_birth'],
                'cell_number' => $data['cell_number'],
                'gender' => $data['gender'],
                'first_name' => $data['first_name'], 'last_name' => $data['last_name'],
                'address' => $data['address'], 'city' => $data['city'],
                'province' => $data['province'], 'postal_code' => $data['postal_code']
            ]);

        //If the user has a super admin or an admin role, do nothing, otherwise give them a client role
        $user->hasAnyRole([User::SUPER_ADMIN_ROLE, User::ADMIN_ROLE]) ? : $user->syncRoles(['client']);

        return $user;
    }

    public static function UPDATE_EMAIL(User $user, array $data) : User
    {
        $messages = [
            'unique_encrypted' => 'The :attribute has already been taken.'
        ];

        Validator::make($data, [
            'email' => ['required', 'string', 'unique_encrypted:users,email'],
        ], $messages)->validate();

        $user->email = $data['email'];
        $user->email_verified_at = null;
        $user->save();

        $user->sendEmailVerificationNotification();

        array_key_exists('ignore_logout', $data)?:Auth::logout();

        return $user;
    }
}
