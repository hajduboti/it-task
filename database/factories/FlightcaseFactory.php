<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Flightcase::class, function (Faker $faker) {
    return [
        'departuredate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'flightnumber' => $faker->text(6),
        'bookingnumber' => $faker->text(12),
        'issue' => $faker->text(6)
    ];
});

