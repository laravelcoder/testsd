<?php

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        "category" => $faker->name,
        "slug" => $faker->name,
    ];
});
