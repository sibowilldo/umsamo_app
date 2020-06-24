<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    $event_dates = \App\EventDate::pluck('id');
    $statuses = \App\Status::where('model_type', 'App\Appointment')->pluck('id');
    $regions = \App\Region::pluck('id');


    return [
        'uuid' => $faker->uuid,
        'event_date_id' => $faker->randomElement($event_dates),
        'status_id' => $faker->randomElement($statuses),
        'type' => $faker->randomElement(['Consulting', 'Cleansing']),
        'with_family' => $faker->boolean(0),
        'region_id' => $faker->randomElement($regions),
    ];
});
