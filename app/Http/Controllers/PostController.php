<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $posts = Post::with('user')->orderBy('created_at', 'desc')->get();

    foreach ($posts as $post) {
      if (!$post->user->profile_image) {
        $post->user->profile_image = 'assets/img/avatars/1.png'; // Set the path to your default image
      }
      if (!$post->user->name) {
        $post->user->name = 'Default Name'; // Set the default name
      }
    }

    return view('content.home.home', compact('posts'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'message' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $post = new Post();
    $post->message = $request->message;
    $post->likes = 0;
    $post->comments = 0;
    $post->user_id = auth()->id();

    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('uploads', 'public');
      $post->image = $imagePath;
    }

    $post->save();

    return redirect()->back()->with('success', 'Post created successfully!');
  }
}
