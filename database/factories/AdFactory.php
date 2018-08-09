<?php

$factory->define(App\Ad::class, function (Faker\Generator $faker) {
    return [
        "ad_label" => $faker->name,
        "ad_description" => $faker->name,
        "total_impressions" => $faker->randomNumber(2),
        "total_networks" => $faker->randomNumber(2),
        "total_channels" => $faker->randomNumber(2),
        "advertiser_id" => factory('App\ContactCompany')->create(),
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
    ];
});
