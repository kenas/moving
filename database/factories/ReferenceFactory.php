<?php

use Faker\Generator as Faker;

$factory->define(App\Reference::class, function (Faker $faker) {
    return [
        'content' => $faker->text($maxNbChars = 200)
    ];
});
