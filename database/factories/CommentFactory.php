<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        //
        'contributor'       => 'test_title_'.$faker->unixTime($max = 'now'),
        'text'              => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'parent_article_id' => function () {
            return factory(App\Models\Article::class)->create()->id;
        },
        'approval_flg'     => true,
        'approval_user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});
