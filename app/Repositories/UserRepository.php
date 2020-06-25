<?php


namespace App\Repositories;


use App\User;
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

        $user->syncRoles(['client']);

        return $user;

    }
}
