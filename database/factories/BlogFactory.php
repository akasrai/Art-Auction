<?php

use Faker\Generator as Faker;

$factory->define(App\Blog::class, function (Faker $faker) {
    
    return [
        'title'         => $faker->text(50),
        'body'          => $faker->text(250),
        'slug'          => 'slug-'.str_random(10),
        'auther_id'     => 1,        
        'title'         => $faker->text(50),
        'body'          => $faker->text(250),
        'excerpt'       => $faker->text(30),
        'featured_image'=> rand(1, 30).'jpg',
        'status'        => 1,
        'type'          => 1,
        'comment_count' => 1,
        'published_at'  => date("Y-m-d H:i:s"),
        'created_at'    => date("Y-m-d H:i:s")
    ];
});
