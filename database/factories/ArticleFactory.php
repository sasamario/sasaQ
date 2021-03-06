<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomNumber(),
        'title' => $faker->word(),
        'tag1' => $faker->word(),
        'tag2' => $faker->word(),
        'tag3' => $faker->word(),
        'body' => $faker->text(),
        'date' => $faker->date(),
        'status' => $faker->numberBetween(0,1),
        'importance' => $faker->numberBetween(0,2),
    ];
});
