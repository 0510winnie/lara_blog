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
      $topic->excerpt = make_excerpt($topic->body);
    }
}
