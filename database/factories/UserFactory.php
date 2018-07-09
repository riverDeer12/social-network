<?php

use Faker\Generator as Faker;

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

$factory->define(App\Message::class, function (Faker $faker) {
    do {
        $from = rand(1, 40);
        $to = rand(1, 40);
    } while ($from === $to);

    return [
        'from' => $from,
        'to' => $to,
        'message' => $faker->sentence,
    ];
});

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 40),
        'post_id' => rand(1, 100),
        'content' => $faker->sentence,
    ];
});

$factory->define(App\Friendship::class, function (Faker $faker) {
    do {
        $requester = rand(1, 40);
        $requested_user = rand(1, 40);
    } while ($requester === $requested_user);

    $status = [0,1];
    return [
        'requested_user' => $requested_user,
        'requester' => $requester,
        'status' => array_rand($status),
    ];
});