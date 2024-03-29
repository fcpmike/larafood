<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use App\Models\Table;
use App\Models\Tenant;
use Faker\Generator as Faker;

$factory->define(Table::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        'identify' => uniqid() . Str::random(5),
        'description' => $faker->sentence,
    ];
});
