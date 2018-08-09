<?php

$factory->define(App\Campaign::class, function (Faker\Generator $faker) {
    return [
        'name'               => $faker->name,
        'start_date'         => $faker->date('m/d/Y', $max = 'now'),
        'finish_date'        => $faker->date('m/d/Y', $max = 'now'),
        'created_by_id'      => factory('App\User')->create(),
        'created_by_team_id' => factory('App\Team')->create(),
        'advertiser_id'      => factory('App\ContactCompany')->create(),
    ];
});
