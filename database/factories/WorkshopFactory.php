<?php

use Faker\Generator as Faker;

$factory->define(App\Workshop::class, function (Faker $faker) {
    $createdAndUpdate = $faker
        ->dateTimeBetween($startDate = '-2 years', $endDate = '+2 years', $timezone = null)
        ->format('Y-m-d H:i:s');

    return [
        'title' => $faker->jobTitle.' workshop',
        'description' => $faker->paragraph($nbSentences = 3),
        'difficulty' => $faker->numberBetween($min = 1, $max = 3),
        'created_at' => $createdAndUpdate,
        'updated_at' => $createdAndUpdate,
    ];
});
