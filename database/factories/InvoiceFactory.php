<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'user_id' => factory(\App\User::class),
        'status_id' => factory(\App\Status::class),
        'amount' => $faker->randomFloat(2, 0, 99999999999.99),
        'discount' => $faker->randomFloat(2, 0, 99999999999.99),
        'notes' =>  $faker->realText(),
    ];
});
