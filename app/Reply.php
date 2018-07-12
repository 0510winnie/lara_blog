<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['content'];

    public function topic()
    {
      return $this->belongsTo(Topic::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function scopeRecent($query)
    {
      //按照創建時間排序
      return $query->orderBy('created_at', 'desc');
    }

}
