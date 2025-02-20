<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Departments;
use Faker\Generator as Faker;

$factory->define(Departments::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'nivel' => $faker->numberBetween(1, 20),
        'employees_quantity' => rand(1, 50),
        'ambassador_id' => $faker->numberBetween(1, 5),
        'superior_id' => $faker->numberBetween(1, 10),
    ];
});
