<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Model;

use Illuminate\Support\Str;

use Faker\Generator as Faker;

$factory->define(App\Area::class, function (Faker $faker){
    return [
        'name' => $this->faker->text(12),  
        'description' => $this->faker->text(200),        
        'user_id'=>\App\User::inRandomOrder()->first()->id,
       
    ];
});
