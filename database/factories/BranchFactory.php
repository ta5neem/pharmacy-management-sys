<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;

use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    return [
    	'email' =>  $faker->unique()->safeEmail,
        'name' => $faker->name,
        'location_id' => App\Location::all()->random()->id,
        'type_id' => App\TypeBranch::all()->random()->id,
        'num_employee' => $faker->randomDigitNotNull ,


    ];
});
