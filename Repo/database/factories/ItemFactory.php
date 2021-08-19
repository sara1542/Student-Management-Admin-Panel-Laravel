<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(App\Models\Item::class, function (Faker $faker) {
    return [
        'courseID' =>$this->$faker->randomNumber(),
        'Name' =>$this->$faker->text(50),
        'Description' =>$this->$faker->text(50),
        'Max' =>$this->$faker->randomNumber(50),
    ];
});