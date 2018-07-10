<?php

namespace App\Observers;

use App\Topic;
use App\Handlers\SlugTranslateHandler;

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
        //
    }

    public function saving(Topic $topic)
    {
      $topic->body = clean($topic->body, 'user_topic_body');
      //user_topic_body 是我們在config裡面為topic body所設置的
      $topic->excerpt = make_excerpt($topic->body);
      
      //如果slug字段無內容，即用翻譯對title進行翻譯
      if(!$topic->slug)
      {
        $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        //app() 允許我們使用laravel service container, 此處用來生成slugtranslatehandler 實例
      }
    }
}
