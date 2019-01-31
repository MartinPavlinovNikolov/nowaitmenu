<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'name'     => 'Admin example name',
        'password' => Hash::make('qwerty')
    ];
});
