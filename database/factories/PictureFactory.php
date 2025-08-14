<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Picture::class, function (Faker $faker) {

    return [
        'name' => $faker->firstName,
        'picture_location' => 'https://source.unsplash.com/random?text=' . $faker->firstName
    ];
});
