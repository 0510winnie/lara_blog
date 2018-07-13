<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      
      //獲取用戶所有通知
      $notifications = Auth::user()->notifications()->paginate(20);
      //標記為已讀，未讀數量清空為零
      Auth::user()->markAsRead();
      return view('notifications.index', compact('notifications'));
      //我們即可通過$notification->data拿到再通知class todatabase()裡構建的array
    }

}
