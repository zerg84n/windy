<?php

$factory->define(App\Filter::class, function (Faker\Generator $faker) {
    return [
        "query" => $faker->name,
        "slug" => $faker->name,
    ];
});
