<?php

use Faker\Generator as Faker;
use App\Post;

$factory->define(App\Post::class, function (Faker $faker) {
        
        return [
            'title' => $faker->word,
            'content' => $faker->text($maxNbChars = 20),
    ];
});
