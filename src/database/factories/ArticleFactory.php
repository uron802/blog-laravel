<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
        //
        'title' => 'test_title_' . $faker->unixTime($max = 'now'),
        'text' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'publish' => 1,
        'post_date_time' => now(),
        'author' => 1
    ];
});
