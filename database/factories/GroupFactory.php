<?php

use Faker\Generator as Faker;

$factory->define(App\Group::class, function (Faker $faker) {
    $createdAndUpdate = $faker
        ->dateTimeBetween($startDate = '-2 years', $endDate = '+2 years', $timezone = null)
        ->format('Y-m-d H:i:s');

    return [
        'name' => $faker->company,
        'description' => $faker->paragraph($nbSentences = 3),
        'created_at' => $createdAndUpdate,
        'updated_at' => $createdAndUpdate,
    ];
});
