<?php

$factory->define(App\Brand::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "slug" => $faker->name,
    ];
});
