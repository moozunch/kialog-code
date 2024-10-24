<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bookmarks;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostUserLike;

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
      if (!$post->user->name) {
        $post->user->name = 'Default Name';
      }
    }

    return view('content.home.home', compact('posts'));
  }


  public function store(Request $request)
  {
    $request->validate([
      'message' => 'nullable|string|max:255',
      'images' => 'nullable',
      'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Validate each image
    ]);

    if (!$request->message && !$request->hasFile('images')) {
      return redirect()->back()->withErrors(['message' => 'You must provide either a message or an image.']);
    }

    $post = new Post();
    $post->message = $request->message ?? ' ';
    $post->comments = 0;
    $post->user_id = auth()->id();

    if ($request->hasFile('images')) {
      $imagePaths = [];
      foreach ($request->file('images') as $index => $image) {
        if ($index < 4) { // Limit to 4 images
          $imagePaths[] = $image->store('uploads', 'public');
        }
      }
      $post->images = json_encode($imagePaths); // Save paths as JSON
    }

    $post->save();

    return redirect()->back()->with('success', 'Post created successfully!');
  }


  public function like($id)
  {
    $userId = auth()->id();

    $like = PostUserLike::where('user_id', $userId)->where('post_id', $id)->first();
    if ($like) {
      PostUserLike::where('user_id', $userId)->where('post_id', $id)->delete();
    } else {
      PostUserLike::create([
        'user_id' => $userId,
        'post_id' => $id,
      ]);
    }

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

  public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Delete associated images if any
        // if ($post->images) {
        //     $images = json_decode($post->images);
        //     foreach ($images as $image) {
        //         Storage::delete('public/' . $image);
        //     }
        // }

        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully!');
    }
}
