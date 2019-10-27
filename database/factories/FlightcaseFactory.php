<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

//Using a generator to create unique case numbers
$autoIncrement = autoIncrement();

$factory->define(App\Flightcase::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();
    return [
        'casenumber' => $autoIncrement->current(),
        'departuredate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'flightnumber' => $faker->numberBetween($min = 1000000, $max = 9000000),
        'bookingnumber' => $faker->numberBetween($min = 1000000, $max = 9000000),
        'issue' => $faker->randomElement(['Cancellation', 'Delay', 'Overbooking'])
    ];
});

function autoIncrement()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

