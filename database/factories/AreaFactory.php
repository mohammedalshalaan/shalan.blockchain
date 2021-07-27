<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Model;

use Illuminate\Support\Str;

use Faker\Generator as Faker;

$factory->define(App\Area::class, function (Faker $faker){
    return [
        'title' => $this->faker->text(30),  
        'description' => $this->faker->text(200),  
            
        'user_id'=>\App\User::inRandomOrder()->first()->id,
       
    ];
});
