<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
          [
            'name' => '分享',
            'description' => '分享發現',
          ],
          [
            'name' => '課程',
            'description' => '開發技巧、工具推薦等',
          ],
          [
            'name' => '問答',
            'description' => '互相解答，互相幫助',
          ],
          [
            'name' => '公告',
            'description' => '網站公告',
          ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
        //truncate()方法將清空categories 數據表裡的所有數據
    }
}
