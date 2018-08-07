<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // 添加三個外鍵約束
    // 1.當用戶刪除時，刪除其發布的話題
    // 2.當用戶刪除時，刪除其發布的回覆
    // 3.當話題刪除時，刪除其所屬的回覆
    
    public function up()
    {
        Schema::table('topics', function (Blueprint $table){
          //當user_id對應的users數據被刪除時，刪除topic
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('replies', function (Blueprint $table){
          //當user_id對應的users表數據被刪除時，刪除此reply
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

          //當topic_id對應的topics表數據被刪除時，刪除此條reply
          $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function (Blueprint $table){
          //移除外鍵約束
          $table->dropForeign(['user_id']);
        });

        Schema::table('replies', function (Blueprint $table){
          $table->dropForeign(['user_id']);
          $table->dropForeign(['topic_id']);
        });
    }
    
}
