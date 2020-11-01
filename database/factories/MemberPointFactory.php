<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MemberPoint;
use Faker\Generator as Faker;

$factory->define(MemberPoint::class, function (Faker $faker) {

    return [
        'member_id' => $faker->randomDigitNotNull,
        'model_type' => $faker->word,
        'model_id' => $faker->randomDigitNotNull,
        'point' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
