<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    return [
        'user_id' => 1,
        'post_id' => App\Post::all()->random()->id,
        'text' => $faker->paragraph(3, true)
    ];
});
