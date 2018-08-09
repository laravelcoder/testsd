<?php

$factory->define(App\Affiliate::class, function (Faker\Generator $faker) {
    return [
        "affiliate" => $faker->name,
    ];
});
