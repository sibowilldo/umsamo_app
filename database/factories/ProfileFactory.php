<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'avatar' => $faker->imageUrl(300, 300),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'cell_number' => $faker->mobileNumber,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'province' => $faker->state,
        'postal_code' => $faker->postcode,
        'profile_completed_at' => Carbon::now()
    ];
});
