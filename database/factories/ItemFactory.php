<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    $statuses = \App\Status::where('model_type', 'App\Item')->pluck('id');

    return [
        'status_id' => $statuses[rand(0, count($statuses)-1)],
        'name' => $faker->realText(10, 2),
        'description' => $faker->realText(),
        'price' => $faker->randomFloat(2, 100.00, 999.99),
        'featured' => $faker->boolean,
        'type_is' => $faker->realText(10),
        'category_is' => $faker->realText(10),
        'rate_is' => 14,
        'thumbnail' => $faker->imageUrl(),
    ];
});
