<?php

use Illuminate\Database\Seeder;
use App\Topic;
use App\User;
use App\Category;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //所有用戶id array, e.g [1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();

        //所有categories id array
        $category_ids = Category::all()->pluck('id')->toArray();

        //獲取faker實例
        $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)
                          ->times(100)
                          ->make()
                          ->each(function($topic, $index)
                              use ($user_ids, $category_ids, $faker)
        {
          $topic->user_id = $faker->randomElement($user_ids);
          $topic->category_id = $faker->randomElement($category_ids);

        });
        
        //將數據集合轉換為array，並插入到db
        Topic::insert($topics->toArray());






    }
}
