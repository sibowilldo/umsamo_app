<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Status;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {

    $statuses = [
        ['title' => 'Active', 'color' => 'primary', 'model_type' => 'App\Event'],
        ['title' => 'Closed', 'color' => 'dark', 'model_type' => 'App\Event'],
        ['title' => 'Cancelled', 'color' => 'danger', 'model_type' => 'App\Event'],
        ['title' => 'Postponed', 'color' => 'info', 'model_type' => 'App\Event'],
        ['title' => 'Published', 'color' => 'success', 'model_type' => 'App\Event'],
        ['title' => 'Unpublished', 'color' => 'light', 'model_type' => 'App\Event'],
        ['title' => 'Deleted', 'color' => 'danger', 'model_type' => 'App\Event'],

        ['title' => 'Active', 'color' => 'primary', 'model_type' => 'App\Appointment'],
        ['title' => 'Cancelled', 'color' => 'danger', 'model_type' => 'App\Appointment'],
        ['title' => 'Confirmed', 'color' => 'success', 'model_type' => 'App\Appointment'],
        ['title' => 'Deleted', 'color' => 'danger', 'model_type' => 'App\Appointment'],
        ['title' => 'Postponed', 'color' => 'info', 'model_type' => 'App\Appointment'],

        ['title' => 'Published', 'color' => 'success', 'model_type' => 'App\Item'],
        ['title' => 'Unpublished', 'color' => 'light', 'model_type' => 'App\Item'],

        ['title' => 'Pending', 'color' => 'warning', 'model_type' => 'App\Invoice'],
        ['title' => 'Paid', 'color' => 'success', 'model_type' => 'App\Invoice'],
        ['title' => 'Processing', 'color' => 'secondary', 'model_type' => 'App\Invoice'],
        ['title' => 'On Hold', 'color' => 'warning', 'model_type' => 'App\Invoice'],

        ['title' => 'Published', 'color' => 'success', 'model_type' => 'App\Comment'],
        ['title' => 'Unpublished', 'color' => 'light', 'model_type' => 'App\Comment'],
        ['title' => 'Blocked', 'color' => 'danger', 'model_type' => 'App\Comment'],
        ['title' => 'Deleted', 'color' => 'danger', 'model_type' => 'App\Comment'],
    ];

    static $count = 0;
    $status = $statuses[$count++];

    return [
        'title' => $status['title'],
        'description' => $faker->realText(),
        'model_type' => $status['model_type'],
        'is_active' => $faker->boolean,
        'color' => $status['color']
    ];
});
