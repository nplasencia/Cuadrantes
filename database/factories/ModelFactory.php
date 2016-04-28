<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Cuadrantes\Entities\Bus;
use Cuadrantes\Entities\User;
use Cuadrantes\Entities\Driver;
use Cuadrantes\Entities\DriverRestDay;
use Cuadrantes\Entities\DriverHoliday;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->safeEmail,
        'password'          => bcrypt(str_random(10)),
        'remember_token'    => str_random(10),
    ];
});

$factory->define(Driver::class, function (Faker\Generator $faker) {
   return [
        'first_name'        => $faker->firstName,
        'last_name'         => $faker->lastName,
        'dni'               => $faker->numerify('########').strtoupper($faker->randomLetter),
        'telephone'         => '6'.$faker->numerify('########'),
        'extension'         => $faker->numerify('####'),
        'email'             => $faker->email,
        'cap'               => $faker->date(),
        'driver_expiration' => $faker->date(),
        'active'            => $faker->randomElement([0, 1])
   ];
});

$factory->define(DriverRestDay::class, function (Faker\Generator $faker) {
   return [
        'driver_id'         => $faker->numberBetween(1, 300),
        'weekday_id'       => $faker->numberBetween(1, 7),
        'active'            => $faker->randomElement([0, 1])
   ];
});

$factory->define(DriverHoliday::class, function (Faker\Generator $faker) {
   return [
       'driver_id'          => $faker->numberBetween(1, 300),
       'date_from'          => $faker->date(),
       'date_to'            => $faker->date(),
       'active'             => $faker->randomElement([0, 1])
   ];
});

$factory->define(Bus::class, function (Faker\Generator $faker) {
    return [
        'brand'             => $faker->randomElement(['Irisbus', 'Irizar', 'Iveco', 'Scania', 'Mercedes']),
        'license'           => $faker->numerify('####').'-'.strtoupper($faker->randomLetter.$faker->randomLetter.$faker->randomLetter),
        'seats'             => $faker->numberBetween(20, 55),
        'stands'            => $faker->numberBetween(3, 55),
        'registration'      => $faker->date('Y-m-d', 'now'),
        'active'            => $faker->randomElement([0, 1])
    ];
});