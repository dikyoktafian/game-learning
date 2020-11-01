<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TaskAnswer;
use Faker\Generator as Faker;

$factory->define(TaskAnswer::class, function (Faker $faker) {

    return [
        'question_id' => $faker->randomDigitNotNull,
        'answer' => $faker->word,
        'label' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
