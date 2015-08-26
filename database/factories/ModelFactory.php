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
    return [
        'title' => $faker->realText($maxNbChars = 150),
        'description' => $faker->realText($maxNbChars = 400),
        'link' => $faker->url,
        'author' => $faker->name,
        'category' => $faker->word,
        'comments' => $faker->url,
        'guid' => $faker->uuid,
        'pub_date' => $faker->date,
        'source' => $faker->url,
        'media_type' => $faker->mimeType,
        'media_path' => $faker->imageUrl,
    ];
});
