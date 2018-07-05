<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Topic;
use App\User;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Topic $topic)
    {
      $topics = $topic->withOrder($request->order)
                ->where('category_id', $category->id)
                ->paginate(9);
      //讀取分類id關聯的topics

      return view('topics.index', compact('topics', 'category'));
      //傳$topics 和分類到view template中
      
    }
}
