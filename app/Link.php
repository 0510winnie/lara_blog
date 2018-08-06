<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;


class Link extends Model
{
    protected $fillable = ['title', 'link'];

    public $cache_key = 'lara_blog_links';
    protected $cache_expire_in_minutes = 1440;

    public function getAllCached()
    {
      //因為這數據並不會常改變，因此創建此方法來返回緩存過的，所有links 數據表裡的數據

      //嘗試從緩存中取出 cache_key 對應的數據，如果能取到，便直接返回數據
      //否則運行匿名函數中的代碼來取出links表中的所有數據，返回時同時做緩存

      return Cache::remember($this->cache_key, $this->cache_expire_in_minutes, function(){
        return $this->all();
      });
    }
}

