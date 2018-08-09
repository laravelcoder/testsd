<?php

$factory->define(App\Demographic::class, function (Faker\Generator $faker) {
    return [
        "demographic" => $faker->name,
        "value" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
        "advertiser_id" => factory('App\ContactCompany')->create(),
    ];
});
