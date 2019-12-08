<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->words(4, true);
                return [
                    'user_id' => 1,
                    'image' => $faker->imageUrl(),
                    'title' => ucfirst($title),
                    'slug'  => str_slug($title),
                    'text'  => $faker->paragraphs(8, true)
                ];
});
