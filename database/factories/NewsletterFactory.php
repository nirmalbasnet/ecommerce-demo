<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Newsletter::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
    ];
});
