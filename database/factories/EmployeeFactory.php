<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'name' => 'Employee example name',
        'password' => '0000',
        'employer_id' => 1,
        'status' => true,
    ];
});
