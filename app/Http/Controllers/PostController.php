<?php

namespace App\Http\Controllers;

use App\Models\Bookmarks;
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

  public function like($id)
{
    $post = Post::findOrFail($id);
    $user = auth()->user();

    if (!$user) {
        return redirect()->back()->with('error', 'User not authenticated.');
    }

    // Increment the likes count
    $post->likes += 1;
    $post->save();

    return redirect()->back()->with('success', 'Post liked successfully!');
}

  public function bookmark(Request $request, $postId)
{
    $userId = auth()->id(); // Mengambil ID user yang sedang login

    // Cek apakah postingan sudah di-bookmark oleh user
    $bookmark = Bookmarks::where('user_id', $userId)
                        ->where('post_id', $postId)
                        ->first();

    if (!$bookmark) {
        // Jika belum, tambahkan ke tabel Bookmark
        Bookmarks::create([
            'user_id' => $userId,
            'post_id' => $postId,
        ]);
    }

    return redirect()->back()->with('success', 'Postingan berhasil disimpan ke bookmark!');
}
}
