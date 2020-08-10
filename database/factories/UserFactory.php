<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Film;
use App\Comment;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});



$factory->define(App\Film::class, function ($faker) {
    return [
        'nameEng' => $faker->word,
        'nameRus' => $faker->title,
        'year' => $faker->numberBetween(1990,2020),
        'ratingImdb' => $faker->numberBetween(0,10),
        'ratingKinopoisk' => $faker->numberBetween(0,10),
        'videourl' => "https://videocdn.so/5lKVPgECfhsG?kp_id=1190387&translation=286&block=JP,MX,US,AU,BR,IN,CN,CH,BE,KP,SG,CA,KR,HK",
        'duration' => $faker->numberBetween(60,180),
        'description' => $faker->sentence,
        'img' => "upload/films/nX6qXV6yhh4fZPAx5ObEkQJloAQUSCLlqNdBf2x3.jpeg",
        
    ];
});


$factory->define(App\Comment::class, function ($faker) {
    return [
        'user_id' => $faker->numberBetween(1,5),
        'film_id' => $faker->numberBetween(131,5131),
        'comment' => $faker->sentence,
    ];
});

$factory->define(App\Liked_disliked_film::class, function ($faker) {
    return [
        'user_id' => $faker->numberBetween(1,5),
        'film_id' => $faker->numberBetween(131,3131),
        'status' => $faker->numberBetween(0,1),
    ];
});