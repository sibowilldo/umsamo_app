<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attachment;
use Faker\Generator as Faker;

$factory->define(Attachment::class, function (Faker $faker) {
    $appointments = \App\Appointment::pluck('id');

    return [
        'uuid' => $faker->uuid,
        'appointment_id' => $appointments[rand(0, count($appointments)-1)],
        'url' => $faker->file(storage_path('app/private/attachments'), public_path('storage/attachments'), false),
        'type' => $faker->word,
    ];
});
