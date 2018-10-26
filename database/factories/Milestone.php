<?php

use Faker\Generator as Faker;
use App\Goal;

$factory->define(App\Milestone::class, function (Faker $faker) {
    return [
        'goal_id' => factory(Goal::class)->create()->id,
        'body'    => $faker->sentence()
    ];
});
