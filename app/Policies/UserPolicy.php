<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $currentUser, User $user)
    {
      return $currentUser->id === $user->id;
      //接受兩個參數，1st: 當前登入用戶實例, 2nd: 要進行授權的用戶實例
      //當兩個id相同則表示兩個用戶為相同用戶，用戶通過授權
    }
}
