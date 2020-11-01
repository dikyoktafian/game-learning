<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MemberTask;
use Faker\Generator as Faker;

$factory->define(MemberTask::class, function (Faker $faker) {

    return [
        'member_id' => $faker->randomDigitNotNull,
        'task_id' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
