<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Reply;

class TopicReplied extends Notification implements ShouldQueue
{
    use Queueable;
    public $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
        //注入回覆實例，方便 toDatabase 方法中使用
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
        // return ['database','mail'];
        //via 方法決定了通知在哪個頻道上發送
        //這裡寫上database來作為通知的頻道
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      $url = $this->reply->topic->link(['#reply' . $this->reply->id]);

      return (new MailMessage)
                    ->line('您的動態有新回覆！')
                    ->action('請查看回覆！', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    { 
      //因為使用db頻道，我們需要定義todatabse(), 
      //此方法接受notifiable實例參數並返回一個普通array
      //這個array將被轉為json格式並儲存到數據表的data字段中
      $topic = $this->reply->topic;
      $link = $topic->link(['#reply'. $this->reply->id]);

      //存入數據庫的數據
      return [
        'reply_id' => $this->reply->id,
        'reply_content' => $this->reply->content,
        'user_id' => $this->reply->user->id,
        'user_name' => $this->reply->user->name,
        'user_avatar' => $this->reply->user->avatar,
        'topic_link' => $link,
        'topic_id' => $topic->id,
        'topic_title' => $topic->title,
      ];
    }
}
