<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Passenger::class, function (Faker $faker) {
    return [
        'casenumber' => $faker->numberBetween($min = 1, $max = 62),
        'firstname' => $faker->firstName(),
        'lastname' => $faker->lastName(),
        'email' => $faker->email(),
        'phone' => $faker->e164PhoneNumber()
    ];
});

