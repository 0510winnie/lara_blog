<?php

namespace App\Observers;
use App\Link;
use Cache;

class LinkObserver
{
    //在保存剛新增的link時，清空cache_key對應的緩存
    public function saved()
    {
      Cache::forget($link->cache_key);
    }
}
