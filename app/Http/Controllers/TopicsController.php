<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicsController extends Controller
{
    public function index()
    {
      $topics = Topic::paginate(9);
      return view('topics.index', compact('topics'));
    }
}
