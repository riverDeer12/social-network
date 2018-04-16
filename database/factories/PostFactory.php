<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(0, 40),
        'content' => $faker->paragraph(4),
    ];
});
