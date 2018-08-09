<?php

$factory->define(App\Contact::class, function (Faker\Generator $faker) {
    return [
        "company_id" => factory('App\ContactCompany')->create(),
        "first_name" => $faker->name,
        "last_name" => $faker->name,
        "email" => $faker->name,
        "skype" => $faker->name,
        "address" => $faker->name,
        "notes" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
    ];
});
