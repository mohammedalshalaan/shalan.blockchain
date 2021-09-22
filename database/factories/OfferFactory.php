<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker){
    return [
        'title' => $this->faker->text(30),
        'content' => $this->faker->text(500),
        'user_id'=>\App\User::inRandomOrder()->first()->id,
        'area_id'=>\App\Area::inRandomOrder()->first()->id,
            

    ];
});
