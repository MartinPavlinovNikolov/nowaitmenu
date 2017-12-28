<?php

use Faker\Generator as Faker;

/**
 * When use this factory, define statusable_id and statusable_type!(polymorphic relations)
 */
$factory->define(App\Status::class, function (Faker $faker) {
    return [
        'active' => true
    ];
});
