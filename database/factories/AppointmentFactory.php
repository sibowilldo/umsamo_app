<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    $users = \App\User::pluck('id')->toArray();
    $event_dates = \App\EventDate::pluck('id')->toArray();
    $statuses = \App\Status::where('model_type', 'App\Appointment')->pluck('id');
    $regions = \App\Region::pluck('id');


    return [
        'uuid' => $faker->uuid,
        'user_id' => $users[rand(0, count($users)-1)],
        'event_date_id' => $event_dates[rand(0, count($event_dates)-1)],
        'status_id' => $statuses[rand(0, count($statuses)-1)],
        'region_id' => $regions[rand(0, count($regions)-1)],
        'reserved_at' => $faker->dateTimeBetween('now', '+3 Months'),
    ];
});
