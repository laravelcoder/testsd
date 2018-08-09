<?php

$factory->define(App\Audience::class, function (Faker\Generator $faker) {
    return [
        'name'               => $faker->name,
        'value'              => $faker->name,
        'created_by_id'      => factory('App\User')->create(),
        'created_by_team_id' => factory('App\Team')->create(),
        'advertiser_id'      => factory('App\ContactCompany')->create(),
    ];
});
