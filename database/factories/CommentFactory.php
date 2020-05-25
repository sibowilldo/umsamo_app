<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $users = \App\User::pluck('id')->toArray();
    $statuses = \App\Status::where('model_type', 'App\Comment')->pluck('id');
    $appointments = \App\Appointment::pluck('id');

    return [
        'user_id' => $users[rand(0, count($users)-1)],
        'status_id' => $statuses[rand(0, count($statuses)-1)],
        'appointment_id' => $appointments[rand(0, count($appointments)-1)],
        'body' =>  $faker->realText(),
    ];
});
