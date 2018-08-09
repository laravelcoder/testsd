<?php

$factory->define(App\Phone::class, function (Faker\Generator $faker) {
    return [
        "phone_number" => $faker->name,
        "contact_id" => factory('App\Contact')->create(),
        "advertiser_id" => factory('App\ContactCompany')->create(),
        "agent_id" => factory('App\Agent')->create(),
    ];
});
