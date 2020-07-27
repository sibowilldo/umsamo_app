<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {

    $id_number =  $faker->idNumber;
    return [
        'avatar' => 'media/users/blank.png',
        'id_number' => $id_number,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->randomElement(['M','F']),
        'date_of_birth' => $faker->date('Y-m-d', Carbon::now()->subDecade()),
        'cell_number' => $faker->mobileNumber,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'province' => $faker->state,
        'postal_code' => $faker->postcode,
        'profile_completed_at' => Carbon::now(),
        'cell_number_verified_at' => now()
    ];
});
