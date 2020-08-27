<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Content;
use Faker\Generator as Faker;

$factory->define(Content::class, function (Faker $faker) {
    $title = $faker->name;

    return [
        'title' => $title,
        'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title))),
        'description' => $faker->text,
        'image_url' => $faker->imageUrl('1000', '800'),
        'content_url' => $faker->url,
        'status' => 200
    ];
});
