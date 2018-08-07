<?php

namespace App\Traits;

use Redis;
use Carbon\Carbon;


trait LastActivedAtHelper
{
  //緩存相關
  protected $hash_prefix = 'larablog_last_actived_at_';
  protected $field_prefix = 'user_';

  public function recordLastActivedAt()
  {
    // //獲取今天的日期
    // $date = Carbon::now()->toDateString();

    //Redis hash 表命名，如：larablog_last_actived_at_2018-10-21  
    $hash = $this->getHashFromDateString(Carbon::now()->toDateString());

    //字段名稱，如：user_1
    $field = $this->getHashField();
    // dd(Redis::hGetAll($hash));
    
    //當前時間，如：2018-10-21 08:23:12
    $now = Carbon::now()->toDateTimeString();

    //數據寫入 Redis，字段已存在會被更新
    Redis::hSet($hash, $field, $now);

  }

  public function syncUserActivedAt()
  {
    // 獲取昨天的日期，格式如 2017-10-21
    // $yesterday_date = Carbon::yesterday()->toDateString();

    //Redis Hash表的命名，如:larablog_last_actived_at_2017-10-21
    $hash = $this->getHashFromDateString(Carbon::yesterday()->toDateString());

    //從Redis中獲取所有hash表的數據
    $dates = Redis::hGetAll($hash);

    // 遍歷，並同步到DB
    foreach($dates as $user_id => $actived_at){
      //會將 user_1 轉換為 1
      $user_id = str_replace($this->field_prefix, '', $user_id);

      //只有當用戶存在時才更新到數據庫中
      if($user = $this->find($user_id)){
        $user->last_actived_at = $actived_at;
        $user->save();
      }
    }

    //既已同步，即可刪除
    Redis::del($hash);

  }


  public function getLastActivedAtAttribute($value)
  {
    //獲取今天的日期
    // $date = Carbon::now()->toDateString();

    //Redis Hash 表的命名，如:larablog_last_actived_at_2017-10-21
    $hash = $this->getHashFromDateString(Carbon::now()->toDateString());
    //字段名稱，如: user_1
    $field = $this->field_prefix . $this->id;

    //三元運算符，優先選擇redis數據，反則使用數據庫中
    $datetime = Redis::hGet($hash, $field) ? : $value;

    //如果存在的話，返回時間對應的carbon實例
    if($datetime){
      return new Carbon($datetime);
    } else {
      //否則使用用戶註冊時間
      return $this->created_at;
    }
  }

  public function getHashFromDateString($date)
  {
    //Redis Hash 表的命名，如:larablog_last_actived_at_2017-10-21
    return $this->hash_prefix . $date;
  }

  public function getHashField()
  {
    //字段名稱，如：user_1
    return $this->field_prefix . $this->id;
  }

}