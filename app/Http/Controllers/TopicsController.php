<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicsController extends Controller
{
    public function index()
    {
      $topics = Topic::with('user','category')->paginate(9);
      //with()方法提前加載了後面需要的關聯屬性 user & category，並作了緩存
      //所以即使是在iterate data時使用到這兩個關聯屬性
      //數據已被預加載並緩存，因此不會產生多餘SQL 查詢
      return view('topics.index', compact('topics'));
    }
}
