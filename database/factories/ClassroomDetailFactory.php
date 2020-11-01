<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ClassroomDetail;
use Faker\Generator as Faker;

$factory->define(ClassroomDetail::class, function (Faker $faker) {

    return [
        'classroom_id' => $faker->randomDigitNotNull,
        'member_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
