<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

$factory->define(App\Employer::class, function (Faker $faker) {
    return [
        'name' => 'Company example name',
        'email' => 'company@example.com',
        'password' => Hash::make('qwerty'),
        'last_login' => Carbon::parse('-1 day'),
        'status' => true
    ];
});

$factory->state(App\Employer::class, 'active', function(Faker $faker){
    return [
        'status' => true
    ];
});

$factory->state(App\Employer::class, 'disabled', function(Faker $faker){
    return [
        'status' => false
    ];
});