<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Grade;
use Faker\Generator as Faker;

$factory->define(App\Models\Grade::class, function (Faker $faker) {
    return [

        'studentID' =>$this->$faker->randomNumber(),
        'courseID'  =>$this->$faker->randomNumber(),
        'Name' =>$this->$faker->text(50),
        'Value' =>$this->$faker->randomNumber(50),
        'Max' =>$this->$faker->randomNumber(50),
    ];
});