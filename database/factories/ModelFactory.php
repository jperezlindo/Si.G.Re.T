<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory $factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        
        'user'					=> $faker->userName,
        'dni' 					=> rand(20000000, 42000000),
        'apellido' 				=> $faker->lastName,
        'fecha_nacimiento' 		=> $faker->date($format = 'Y-m-d', $max = '2004'),
        'name' 					=> $faker->name,
        'sexo'                  => 'Otros',
        'email' 				=> $faker->unique()->freeEmail,
        'direccion' 	        => $faker->streetAddress,
        'password' 				=> $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token' 		=> str_random(10),
    ];
});*/


