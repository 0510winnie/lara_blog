<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicsController extends Controller
{
    public function index(Request $request, Topic $topic)
    {
      $topics = $topic->withOrder($request->order)->paginate(9);
      //$request->order 是獲取 /topics?order=recent中的order參數
      return view('topics.index', compact('topics'));

    }

}
