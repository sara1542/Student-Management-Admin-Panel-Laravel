<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enrollment;
use Faker\Generator as Faker;

$factory->define(App\Models\Enrollment::class, function (Faker $faker) {
    return [

        'student' =>$this->$faker->randomNumber(),
        'course'  =>$this->$faker->randomNumber(),
    ];
});