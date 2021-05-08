<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categori;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Categori::class, function (Faker $faker) {
    return [
        'nama_kategori' => $faker->unique()->name,
        'slug' => Str::slug($faker->unique()->name,  '-'),
    ];
});
