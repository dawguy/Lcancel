<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Matches::class, function (Faker\Generator $faker) {
    return [
        'winner_character' => rand(0,26),
        'loser_character' => rand(0,26),
        'winner_stocks' => rand(1,4),
        'loser_stocks' => 0,
        'winner' => App\User::all()->random()->id,
        'loser' => App\User::all()->random()->id,
        'stage' => 'battlefield'
    ];
});
