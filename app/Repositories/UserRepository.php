<?php


namespace App\Repositories;


use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class UserRepository
{
    /**
     * Registers a new user with a random password.
     * Via UserObserver this methods generate a random token and emails the user
     *
     * @param array $data
     * @return mixed
     */
    public static function NEW_USER(array $data)
    {
        Validator::make($data, [
            'id_number' => ['required', 'string', 'unique:profiles,id'],
            'cell_number' => ['required', 'string', 'unique:profiles,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,uuid'],
        ])->validate();

        $user = User::firstOrCreate(
            ['email' => $data['email']],
            ['password' => User::generatePassword()]
        );

        $user->profile()->updateOrCreate(
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

        return $user;

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id_number' => ['required', 'string', 'unique:profiles'],
            'cell_number' => ['required', 'string', 'unique:profiles'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }
}
