<?php

$factory->define(App\ContactCompany::class, function (Faker\Generator $faker) {
    return [
        'name'               => $faker->name,
        'address'            => $faker->name,
        'website'            => $faker->name,
        'email'              => $faker->name,
        'address2'           => $faker->name,
        'city'               => $faker->name,
        'state'              => $faker->name,
        'zipcode'            => $faker->name,
        'country'            => $faker->name,
        'created_by_id'      => factory('App\User')->create(),
        'created_by_team_id' => factory('App\Team')->create(),
    ];
});
