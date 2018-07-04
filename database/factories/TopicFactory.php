<?php

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
        
        $sentence = $faker->sentence();

        //隨機取一個月內的時間
        $updated_at = $faker->dateTimeThisMonth();
        //傳參為生成時間最大不超過的時間
        $created_at = $faker->dateTimeThisMonth($updated_at);

        return [
          'title' => $sentence,
          'body' => $faker->text(),
          'excerpt' => $sentence,
          'created_at' => $created_at,
          'updated_at' => $updated_at,
    ];
});
