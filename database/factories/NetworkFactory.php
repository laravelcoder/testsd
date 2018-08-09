<?php

$factory->define(App\Network::class, function (Faker\Generator $faker) {
    return [
        'network'            => $faker->name,
        'created_by_id'      => factory('App\User')->create(),
        'created_by_team_id' => factory('App\Team')->create(),
        'network_id'         => $faker->name,
    ];
});
