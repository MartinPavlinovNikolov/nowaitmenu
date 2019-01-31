<?php

use Faker\Generator as Faker;

$factory->define(App\Tablet::class, function (Faker $faker) {
    return [
        'employer_id' => '1',
        'password'    => '0000',
        'status'      => true,
    ];
});
