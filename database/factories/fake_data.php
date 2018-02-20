<?php

use Faker\Generator as Faker;

$factory->define(App\fake_data::class, function (Faker $faker) {
    return [
        'fake_name' => $faker->name,
        'fake_text' => $faker->text
    ];
});
