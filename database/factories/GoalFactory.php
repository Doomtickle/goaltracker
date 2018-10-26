<?php

use App\Goal;
use Faker\Generator as Faker;
use App\User;

$factory->define(Goal::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'user_id' => 1
    ];
});
