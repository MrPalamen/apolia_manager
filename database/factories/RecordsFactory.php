<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Records;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Records::class, function (Faker $faker) {

    return [
        'surname' => $faker->firstName,
        'name' => $faker->lastName,
        'number' => $faker->bothify('??########') ,
        'name_agent' => 'MrPalamen',
        'grade_agent' => 'Kontraktniki'
    ];
});
