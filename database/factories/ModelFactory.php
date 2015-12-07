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

use MediumSpot\UserModel;
use MediumSpot\ArticleModel;
use MediumSpot\TopicModel;

$factory->define(UserModel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(ArticleModel::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->paragraphs,
        'thumbnail' => $faker->image(),
        'user_id' => $faker->randomNumber(),
        'active' => $faker->boolean(),
        'created_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(TopicModel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->title,
        'user_id' => $faker->randomNumber(),
        'active' => $faker->boolean(),
    ];
});
