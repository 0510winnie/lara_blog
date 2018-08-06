<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Traits\ActiveUserHelper;
    use HasRoles;
    use Notifiable {
      notify as protected laravelNotify;
    }
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

    public function notify($instance)
    {
      //如果要通知的人是當前用戶，就不用通知了
      if($this->id == Auth::id()){
        return;
      }
      $this->increment('notification_count');
      $this->laravelNotify($instance);
      //對notify() 做了些許改寫
      //所以現在調用$user->notify()時
      //users 表裡的notification_count 將自動+1
    }

    public function markAsRead()
    {
      $this->notification_count = 0;
      $this->save();
      $this->unreadNotifications->markAsRead();

    }
}
