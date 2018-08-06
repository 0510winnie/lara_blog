<?php 

namespace App\Traits;

use App\Topic;
use App\Reply;
use Carbon\Carbon;
use DB;
use Cache;

//將有關active users所有的邏輯戴法放置於我們自己
//定義的trait, 然後再user model裡加載
//用trait的以便於查閱以及保持user model的清爽


trait ActiveUserHelper
{
  //用於存放臨時用戶數據
  protected $users = [];

  //配置信息
  protected $topic_weight = 4; //話題權重
  protected $reply_weight = 1; //回覆權重
  protected $pass_days = 7; //多少天內發表過內容
  protected $user_number = 6; //取出來多少用戶

  //緩存相關配置
  protected $cache_key = 'larablog_active_users';
  protected $cache_expire_in_minutes = 65;

  public function getActiveUsers()
  {
    //嘗試從緩存中取出 cache_key對應的數據。如果能取到，變直接反回數據。
    //否則運行匿名函數中的代碼來取出活躍用戶數據，返回的同時做了緩存。

    return Cache::remember($this->cache_key, $this->cache_expire_in_minutes, function(){
      return $this->calculateActiveUsers();
    });
  }

  public function calculateAndCacheActiveUsers()
  {
    //取出活躍用戶列表
    $active_users = $this->calculateActiveUsers();
    //並加以緩存
    $this->cacheActiveUsers($active_users);
  }

  private function calculateActiveUsers()
  {
    $this->calculateTopicScore();
    $this->calculateReplyScore();

    //數組按照得分順序
    $users = array_sort($this->users, function($user){
      return $user['score'];
    });

    //我們需要的是倒敘，高分在前，第二個餐數為抱持array key不變
    $users = array_reverse($users, true);

    //只獲取我們想要的數量
    $users = array_slice($users, 0, $this->user_number, true);

    //新建一個空集合
    $active_users = collect();

    //specify a key column
    foreach($users as $user_id => $user){
      //找尋下是否可以找到該用戶
      $user = $this->find($user_id);

      //如果數據庫裡有該用戶的話
      if($user) {
        //將此用戶實例放進集合的末端
        $active_users->push($user);
      }
      
    }

    //返回數據
    return $active_users;
    
  }

  private function calculateTopicScore()
  {
    //從topic數據表裡取出時間範圍($pass_days)內，有發表過topic的users
    //並且同時取出用戶此段時間內發布的topic數量
    $topic_users = Topic::query()->select(DB::raw('user_id, count(*) as topic_count'))
                                 ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
                                 ->groupBy('user_id')
                                 ->get();
    //根據topic數量計算得分
    foreach($topic_users as $value){
      $this->users[$value->user_id]['score'] = $value->topic_count * $this->topic_weight;
    }
  }

  private function calculateReplyScore()
  {
    //從回覆數據表裡取車限定時間範圍($pass_days)內, 有發表過回覆的用戶
    //並且同時取出用戶此段時間內發布回復的數量
    $reply_users = Reply::query()->select(DB::raw('user_id, count(*) as reply_count'))
                                 ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
                                 ->groupBy('user_id')
                                 ->get();

    //根據回覆數量計算得分
    foreach($reply_users as $value) {
      $reply_score = $value->reply_count * $this->reply_weight;
      if(isset($this->users[$value->user_id]))
      {
        $this->users[$value->user_id]['score'] += $reply_score;
      } else {
        $this->users[$value->user_id]['score'] = $reply_score;
      }
    }

  }

  private function cacheActiveUsers($active_users)
  {
    //將數據放入緩存中
     Cache::put($this->cach_key, $active_users, $this->cache_expire_in_minutes);
  }
}