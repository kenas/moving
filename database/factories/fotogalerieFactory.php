<?php

use Faker\Generator as Faker;

$factory->define(App\Gallery::class, function (Faker $faker) {
    return [
      'path' =>	$faker->imageUrl($width = 250, $height = 250, 'nature'),
      'description' => $faker->sentence($nbWords = 5, $variableNbWords = true),
      'created_at'	=>	null,
      'updated_at'	=>	null
    ];
});
