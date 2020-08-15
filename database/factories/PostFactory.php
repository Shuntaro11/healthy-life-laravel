<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(Post::class, function (Faker $faker) {

    $testImage = UploadedFile::fake()->image('test.jpg', 100, 100);

    return [
        'title' => $faker->sentence(rand(1,10)),
        'image' => $testImage,
        'content' => $faker->realText(30),
    ];
});
