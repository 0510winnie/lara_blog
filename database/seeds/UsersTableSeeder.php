<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //獲取faker實例
        $faker = app(Faker\Generator::class);

        //頭像假數據
        $avatars = [
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
        ];

        //生成數據集合
        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function($user, $index)
                            use($faker, $avatars)
        {
          //從頭像取一個並賦值
          $user->avatar = $faker->randomElement($avatars);
        });

        //讓隱藏字段可見，並將數據集合轉為array
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        //插入到db
        User::insert($user_array);
        
        //單獨處理第一個用戶數據
        $user = User::find(1);
        $user->name = 'Bob';
        $user->email = 'bob@gmail.com';
        $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';
        $user->assignRole('Founder');
        $user->save();

        //將2號用戶指派為管理員
        $user = User::find(2);
        $user->assignRole('Maintainer');
        $user->save();

    }
}
