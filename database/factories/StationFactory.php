<?php

$factory->define(App\Station::class, function (Faker\Generator $faker) {
    return [
        "station_label" => $faker->name,
        "channel_number" => $faker->name,
        "affiliate_id" => factory('App\Affiliate')->create(),
        "network_id" => factory('App\Network')->create(),
    ];
});
