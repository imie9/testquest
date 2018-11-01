<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Item::class, function (Faker $faker) {
    $category_id = \App\Models\Category::max('id');
    return [
        'name' => $faker->name,
        'category_id' => rand(1, $category_id),
        'description' => $faker->text,
        'image_url' => 'image.png'
    ];
});
