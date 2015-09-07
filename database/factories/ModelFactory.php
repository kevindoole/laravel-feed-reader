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
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\RssItem::class, function (Faker\Generator $faker) {
    $url = $faker->url;
    return [
        'title' => $faker->realText($maxNbChars = 150),
        'link' => $url,
        'categories' => $faker->word,
        'pub_date' => $faker->date,
        'guid' => $url,
        'viewed' => $faker->boolean,
    ];
});
