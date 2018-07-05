<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];
    //以上字段允許填充

    public function category()
    {
      return $this->belongsTo(Category::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    //透過以上關聯設定，後面開發可透過 $topic->user, $topic->category 
    //來獲取對應的分類和作者

    //定義作用域只需在方法前加上scope
    public function scopeWithOrder($query, $order)
    {
      //不同的排序，使用不同的數據讀取邏輯
      switch($order){
        case 'recent':
              $query->recent();
              break;

        default:
              $query->recentReplied();
              break;
      }
      //預加載防止 N+1 問題
      return $query->with('user','category');
    }

    public function scopeRecentReplied($query)
    {
      //當話題有新回覆時，我們將編寫邏輯來更新topic model的reply count 屬性
      //此時會自動觸發框架對數據模型 updated_at timestamp的更新
      return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
      //按照創建時間排序
      return $query->orderBy('created_at', 'desc');
    }

    //When the functon is called, don't need to add the prefix scope

    
}
