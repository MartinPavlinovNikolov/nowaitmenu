<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Employee::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'employer_id' => rand(1, 20),
        'password' => '0000'
    ];
});
