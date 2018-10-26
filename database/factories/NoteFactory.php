<?php

use App\Goal;
use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
    return [
        'goal_id' => factory(Goal::class)->create()->id,
        'body' => $faker->paragraph
    ];
});
