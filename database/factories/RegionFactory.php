<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Region;
use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Point;

$factory->define(Region::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'description' => $faker->realText(),
        'contact_number' => $faker->mobileNumber,
        'province' => $faker->state,
        'address' => $faker->streetAddress,
    ];
});
