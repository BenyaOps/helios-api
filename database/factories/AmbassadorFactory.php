<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Ambassador;
use Faker\Generator as Faker;

$factory->define(Ambassador::class, function (Faker $faker) {
    return [
        'name' => $faker->name,

    ];
});
