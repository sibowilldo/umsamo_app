<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    $users = \App\User::pluck('id');
    $event_dates = \App\EventDate::pluck('id');
    $statuses = \App\Status::where('model_type', 'App\Appointment')->pluck('id');
    $regions = \App\Region::pluck('id');


    return [
        'uuid' => $faker->uuid,
        'user_id' => $faker->randomElement($users),
        'event_date_id' => $faker->randomElement($event_dates),
        'status_id' => $faker->randomElement($statuses),
        'type' => $faker->randomElement(['Consulting', 'Cleansing']),
        'region_id' => $faker->randomElement($regions),
    ];
});
