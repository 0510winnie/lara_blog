<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TopicRequest;
use App\Topic;
use App\Category;
use App\User;
use Auth;

class TopicsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Topic $topic)
    {
      $topics = $topic->withOrder($request->order)->paginate(9);
      //$request->order 是獲取 /topics?order=recent中的order參數
      return view('topics.index', compact('topics'));

    }

    public function create(Topic $topic)
    {
      $categories = Category::all();
      
      return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
      //store方法第二個參數將創建一個空白的topic instance
      $topic->fill($request->all());
      $topic->user_id = Auth::id();
      $topic->save();

      return redirect()->route('topics.show', $topic->id)->with('message', 'Created Successfully!');
    }

    public function show($id)
    {
        $topic = Topic::find($id);

        return view('topics.show', compact('topic'));
    }

}
