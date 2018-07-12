<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['content'];

    public function topic()
    {
      return $this->belognsTo(Topic::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
