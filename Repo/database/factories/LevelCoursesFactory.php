<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LevelCourses;
use Faker\Generator as Faker;

$factory->define(App\Models\LevelCourses::class, function (Faker $faker) {
    return [

        'level' =>$this->$faker->text(50),
        'course'  =>$this->$faker->randomNumber(),
    ];
});