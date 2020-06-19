<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AttachmentMeta;
use Faker\Generator as Faker;

$factory->define(AttachmentMeta::class, function (Faker $faker) {

    $data = [];
    $data['ext'] = $faker->fileExtension;
    $data['mime-type'] = $faker->mimeType;
    $data['size'] = (round($faker->numberBetween(500000, 10000000) / 1e+6,  2) ). ' Megabytes';

    return [
        "metadata" => $data
    ];
});
