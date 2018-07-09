<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TopicRequest;
use App\Handlers\ImageUploadHandler;
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

      return redirect()->route('topics.show', $topic->id)->with('message', '動態發布成功!');
    }

    public function show(Topic $topic)
    {

        return view('topics.show', compact('topic'));
    }

    public function uploadImage(Request $request, ImageUploader $uploader)
    {
      
    }

    public function edit(Topic $topic)
    {
      $this->authorize('update', $topic);
      //TopicPolicy
      $categories = Category::all();
      return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
      $this->authorize('update', $topic);
      $topic->update($request->all());

      return redirect()->route('topics.show', $topic->id)->with('success', '更新成功！');
    }

    public function destroy(Topic $topic)
    {
      $this->authorize('destroy', $topic);
      $topic->delete();

      return redirect()->back()->with('success', '刪除成功！');
    }
}

