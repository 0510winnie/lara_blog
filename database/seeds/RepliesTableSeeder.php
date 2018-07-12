<?php

use Illuminate\Database\Seeder;
use App\Reply;
use App\User;
use App\Topic;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //所有用戶id array
        $user_ids = User::all()->pluck('id')->toArray();

        //所有topic id array
        $topic_ids = Topic::all()->pluck('id')->toArray();

        //獲取faker 實例
        $faker = app(Faker\Generator::class);

        $replies = factory(Reply::class)
                          ->times(1000)
                          ->make()
                          ->each(function($reply, $index)
                              use($user_ids, $topic_ids, $faker)
        {
          //從用戶id array中隨機取出一個並賦值
          $reply->user_id = $faker->randomElement($user_ids);

          //topic id 同上
          $reply->topic_id = $faker->randomElement($topic_ids);

        });
        
        //將數據集合轉為array，並且insert 到 db中
        Reply::insert($replies->toArray());

    }
}
