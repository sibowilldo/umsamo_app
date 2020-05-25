<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EventDate;
use Faker\Generator as Faker;

$factory->define(EventDate::class, function (Faker $faker) {
    $statuses = App\Status::where('model_type', 'App\Event')->pluck('id');
    $events = App\Event::pluck('id');

    return [
        'event_id' => $events[rand(0, count($events)-1)],
        'status_id' => $statuses[rand(0, count($statuses)-1)],
        'date_time' => $faker->dateTimeBetween('now', '+3 Weeks'),
        'limit' => $faker->numberBetween(10,50),
    ];
});
