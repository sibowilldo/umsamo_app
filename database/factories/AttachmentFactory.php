<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attachment;
use Faker\Generator as Faker;

$factory->define(Attachment::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'url' => ''//$faker->file(storage_path('app/private/attachments'), public_path('storage/attachments'), false),
    ];
});
