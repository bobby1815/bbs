<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(\App\Comment::class, function(Faker $faker){
	$noticeIds = App\Notice::pluck('id')->toArray();
	$userIds   = App\User::pluck('id')->toArray();

	return [
		'content'   => $faker->paragraph,
		'commentable_type'  =>App\Notice::class,
		'commentable_id'    => function() use ($faker, $noticeIds){

			return $faker->randomElement($noticeIds);
		},
		'user_id'           => function() use($faker , $userIds){

			return $faker->randomElement($userIds);
		}
	];
});