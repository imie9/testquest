<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    $res = [
        'name' => $faker->name
    ];

    $max_id = \App\Models\Category::max('id');

    if ($max_id !== 0 && $max_id !== 1) {
        $res['parent_id'] = rand (0, $max_id);
    }

    return $res;
});