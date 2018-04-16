<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;
    $name = $faker->name;
    $gender = [0, 1];
    return [
        'name' => $name,
        'email' => $faker->unique()->safeEmail,
        'username' => str_slug($name),
        'gender' => array_rand($gender),
        'dob' => $faker->dateTimeThisCentury,
        'avatar' => 'public/defaults/avatars/female.png',
        'cover' => 'public/defaults/covers/cover.jpg',
        'password' => $password ?: $password = bcrypt('secret'), // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'location' => $faker->city,
        'about' => $faker->paragraph(4),
        'profession' => $faker->jobTitle,
    ];
});

$factory->define(App\Friendship::class, function (Faker $faker) {
    return [
        'requester' =>  $faker->unique()->numberBetween(1, 40),
        'requested_user' => $faker->unique()->numberBetween(1, 40),
        'status' => 1,
    ];
});

