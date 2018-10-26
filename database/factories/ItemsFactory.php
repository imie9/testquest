<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Item::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category_id' => rand(1, 12),
        'description' => $faker->text,
        'image_url' => $faker->imageUrl
    ];
});
