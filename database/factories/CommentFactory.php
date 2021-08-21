<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $this->faker->text(60),
        
        'user_id'=>\App\User::inRandomOrder()->first()->id,
        'offer_id'=>\App\Offer::inRandomOrder()->first()->id,
            
    ];
});
