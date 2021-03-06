<?php

namespace App\Observers;

use App\Topic;
use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;

class TopicObserver
{
    /**
     * Handle to the topic "created" event.
     *
     * @param  \App\Topic  $topic
     * @return void
     */
    public function created(Topic $topic)
    {
        //
    }

    /**
     * Handle the topic "updated" event.
     *
     * @param  \App\Topic  $topic
     * @return void
     */
    public function updated(Topic $topic)
    {
        //
    }

    /**
     * Handle the topic "deleted" event.
     *
     * @param  \App\Topic  $topic
     * @return void
     */
    public function deleted(Topic $topic)
    {
      \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }

    public function saving(Topic $topic)
    {
      $topic->body = clean($topic->body, 'user_topic_body');
      //user_topic_body 是我們在config裡面為topic body所設置的
      $topic->excerpt = make_excerpt($topic->body);
     
    }

    public function saved(Topic $topic)
    {
       
        //saved 方法對應 eloquent 的saved事件
        //此事件發生在create edit時，數據入db之後
        //以確保分發任務時 $topic->id有值
        //如果slug字段無內容，即用翻譯對title進行翻譯
       if(!$topic->slug)
       {
         //推送任務到queque
         dispatch(new TranslateSlug($topic));
       }
    }


}
