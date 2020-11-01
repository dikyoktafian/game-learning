<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TaskQuestion;
use Faker\Generator as Faker;

$factory->define(TaskQuestion::class, function (Faker $faker) {

    return [
        'task_id' => $faker->randomDigitNotNull,
        'image' => $faker->word,
        'attach' => $faker->word,
        'question' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
