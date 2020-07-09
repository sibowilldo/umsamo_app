<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Appointment::class, function (Faker $faker) {
    $event_dates = \App\EventDate::pluck('id');
    $statuses = \App\Status::where('model_type', 'App\Appointment')->pluck('id');
    $regions = \App\Region::pluck('id');


    return [
        'uuid' => $faker->uuid,
        'reference' => Str::upper($faker->randomElement(['FAM-', 'SLF-']) . sprintf('%03d', rand(000, 999)) . '-'. Str::random(4)),
        'event_date_id' => $faker->randomElement($event_dates),
        'status_id' => $faker->randomElement($statuses),
        'type' => $faker->randomElement([1,2]),
        'with_family' => $faker->boolean(0),
        'region_id' => $faker->randomElement($regions),
    ];
});
