<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(App\Models\Program::class, function (Faker $faker) {
    return [

        'Name' =>$faker->text(50),
        'Description' =>$faker->text(50),
    ];
});