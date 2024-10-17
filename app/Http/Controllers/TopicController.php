<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
  public function index()
  {
    $topics = Topic::all();
    return view('content.topic.topic', compact('topics'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string',
    ]);

    $topic = new Topic();
    $topic->title = $request->title;
    $topic->description = $request->description;
    $topic->user_id = auth()->id();
    $topic->save();

    return redirect()->back()->with('success', 'Topic created successfully!');
  }
}
