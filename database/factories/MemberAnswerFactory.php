<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MemberAnswer;
use Faker\Generator as Faker;

$factory->define(MemberAnswer::class, function (Faker $faker) {

    return [
        'member_id' => $faker->randomDigitNotNull,
        'task_id' => $faker->randomDigitNotNull,
        'question_id' => $faker->randomDigitNotNull,
        'answer_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
