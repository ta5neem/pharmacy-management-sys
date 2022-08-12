<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypeBranch;

use Faker\Generator as Faker;

$factory->define(TypeBranch::class, function (Faker $faker) {
    return [
    	'type' => $faker->word,
    ];
});
