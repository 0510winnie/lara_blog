<?php

namespace App\Observers;

use App\Topic;

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
    }
}
