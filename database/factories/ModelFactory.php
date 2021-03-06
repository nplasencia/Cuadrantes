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

use Cuadrantes\Commons\BusContract;
use Cuadrantes\Entities\Bus;
use Cuadrantes\Entities\User;
use Cuadrantes\Entities\Driver;
use Cuadrantes\Entities\DriverRestDay;
use Cuadrantes\Entities\DriverHoliday;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name'              => $faker->name,
        'surname'           => $faker->lastName,
        'email'             => $faker->unique()->safeEmail,
        'telephone'         => '6'.$faker->numerify('########'),
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
        'driver_expiration' => $faker->date()
   ];
});

$factory->define(DriverRestDay::class, function (Faker\Generator $faker) {
   return [
        'driver_id'         => $faker->numberBetween(1, 300),
        'weekday_id'        => $faker->numberBetween(1, 7)
   ];
});

$factory->define(DriverHoliday::class, function (Faker\Generator $faker) {
   return [
       'driver_id'          => $faker->numberBetween(1, 300),
       'date_from'          => $faker->date(),
       'date_to'            => $faker->date()
   ];
});

$factory->define(Bus::class, function (Faker\Generator $faker) {
    return [
        BusContract::BRAND_ID          => $faker->numberBetween(1, 5),
        BusContract::LICENSE           => $faker->numerify('####').'-'.strtoupper($faker->randomLetter.$faker->randomLetter.$faker->randomLetter),
        BusContract::SEATS             => $faker->numberBetween(20, 55),
        BusContract::STANDS            => $faker->numberBetween(3, 55),
        BusContract::REGISTRATION      => $faker->date('Y-m-d', 'now')
    ];
});