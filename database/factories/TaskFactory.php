<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        //
         'body' => $faker->sentence,
        'project_id' => factory(\App\Project::class),
        'completed' => false
    ];
});
