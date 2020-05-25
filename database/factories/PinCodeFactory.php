<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PinCode;
use Faker\Generator as Faker;

$factory->define(PinCode::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'code' => $faker->word,
        'expires_at' => $faker->dateTime(),
        'is_active' => $faker->boolean,
    ];
});
