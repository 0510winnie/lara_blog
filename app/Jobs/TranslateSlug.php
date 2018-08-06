<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Topic;
use App\Handlers\SlugTranslateHandler;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     * 
     */

    protected $topic;
    
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
        //接收了eloquent model. 將只會序列化模型的id
        //這樣在執行任務時，queque系統會從db自動根據id檢索出topic instance
        //以避免序列化完整的模型可能在queque出現的問題
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //請求百度api接口進行翻譯
        $slug = app(SlugTranslateHandler::class)->translate($this->topic->title);

        //為了避免模型監控器死循環，調用db class 直接對db做操作，避免使用eloquent模型接口，如save(), update()
        \DB::table('topics')->where('id', $this->topic->id)->update(['slug'=> $slug]);
    }
}
