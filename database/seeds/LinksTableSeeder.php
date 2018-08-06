<?php

use Illuminate\Database\Seeder;
use App\Link;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //生成數據集合
        $links = factory(Link::class)->times(6)->make();

        //將數據集合轉為array,並插入到db
        Link::insert($links->toArray());
    }
}
