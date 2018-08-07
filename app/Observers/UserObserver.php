<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    public function saving(User $user)
    {
        //default avatar
        //使用模型監控器來實現此功能，在用戶數據即將入db之前，如為空
        //則設定成預設頭像
        
        if(empty($user->avatar)){
          $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/30/1/TrJS40Ey5k.png';
        }
    }
}
