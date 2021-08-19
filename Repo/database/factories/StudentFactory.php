<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(App\Models\Student::class, function (Faker $faker) {
    return [

        'FirstName' =>$faker->text(50),
        'LastName'  =>$faker->text(50),
        'Identifier' =>$faker->text(50),
        'Email'  =>$faker->text(50),
        'DateOfBirth' =>$faker->text(50),
        'Level'  =>$faker->text(50),
        'Program'  =>$faker->text(50),


    ];
});