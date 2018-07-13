<?php

namespace App\Observers;

use App\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored


class ReplyObserver
{
    public function created(Reply $reply)
    {
      $reply->topic->increment('reply_count', 1);
      //$reply->topic = $reply->topic()->get()
      //動態屬性，得到collection
    }
    //我們監控created事件，當eloquent模型數據成功創建時
    //created 方法將會被調用

    public function creating(Reply $reply)
    {
      $reply->content = clean($reply->content, 'user_topic_body');

      // topic 回覆內容限定和reply內容無異，因此這裡使用一樣的過濾規則
    }
}

