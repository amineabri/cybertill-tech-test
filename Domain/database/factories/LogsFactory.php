<?php

/** @var Factory $factory */

use Domain\Models\LogModel;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(LogModel::class, function (Faker $faker) {
    return [
        'uuid'              => $faker->uuid,
        'ipAddress'         => $faker->ipv4,
        'responseType'      => $faker->randomElement([200,500,407]),
        'responseTime'      => $faker->randomNumber(3),
        'countryOfOrigin'   => $faker->randomElement([$faker->country,$faker->country ,$faker->country]),
        'path'              => $faker->url,
    ];
});
