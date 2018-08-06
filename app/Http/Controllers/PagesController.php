<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class PagesController extends Controller
{
    public function root(){
      return view('pages.root');
    }

    public function test()
    {
      return view('test');
    }

    public function test2()
    {
      $topics = Topic::all();
      return view('test2', compact('topics'));
    }
}
