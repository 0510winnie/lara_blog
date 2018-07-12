<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar'
        //只有在此屬性定義的字段才允許修改，否則忽略
        //防止用戶對模型數據進行修改
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function topics()
    {
      return $this->hasMany(Topic::class);
    }

    public function isAuthorOf($model)
    {
      return $this->id == $model->user_id;
    }

    public function replies()
    {
      return $this->hasMany(Reply::class);
    }
}
