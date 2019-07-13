<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
    	// 'cover_picture' =>	$faker->imageUrl($width = 350, $height = 250, 'nature'), // 'http://lorempixel.com/640/480/'
        'title' 		=> 	$faker->sentence($nbWords = 5, $variableNbWords = true),
        'slug' 			=>	$faker->slug,
        'content' 		=>	$faker->text($maxNbChars = 2000),
        'category_id' 	=>	$faker->numberBetween($min = 1, $max = 11), //ramdom from 1 to 11
        'author'		=> 	$faker->name($gender = 'male'|'female'), //users
        'publish'		=>	$faker->numberBetween($min = 1, $max = 1), // visible 1
        'deleted_at'	=>	null,
        'updated_at'	=>	null
    ];
});
