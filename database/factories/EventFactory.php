<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    $items = App\Item::pluck('id');
    $statuses = App\Status::where('model_type', 'App\Event')->pluck('id');

    return [
        'uuid' => $faker->uuid,
        'status_id' => $statuses[rand(0, count($statuses)-1)],
        'item_id' => $items[rand(0, count($items)-1)],
        'title' => "$faker->dayOfWeek of $faker->monthName",
        'description' => $faker->realText(),
    ];
});
