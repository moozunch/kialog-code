<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bookmarks;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;
use App\Models\PostUserLike;
use Kreait\Firebase\Factory;

class PostController extends Controller
{
  protected $firebaseStorage;

  public function __construct()
  {
    $this->middleware('auth');
    $this->firebaseStorage = (new Factory())->withServiceAccount(config('firebase.firebase_credentials'))->createStorage();
  }

  public function index()
  {
    $posts = Post::whereNull('topic_id')->with('user')->orderBy('created_at', 'desc')->get();

    $trendingTopics = Topic::orderBy('created_at', 'desc')->take(5)->get();

    foreach ($posts as $post) {
      if (!$post->user->profile_image) {
        $post->user->profile_image = 'assets/img/avatars/1.png'; // Set the path to your default image
      }
      if (!$post->user->name) {
        $post->user->name = 'Default Name'; // Set the default name
      }
    }

    return view('content.home.home', compact('posts', 'trendingTopics'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'message' => 'nullable|string|max:255',
      'images' => 'nullable',
      'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
    ]);

    if (!$request->message && !$request->hasFile('images')) {
      return redirect()->back()->withErrors(['message' => 'You must provide either a message or an image.']);
    }

    $post = new Post();
    $post->message = $request->message ?? ' ';
    $post->comments = 0;
    $post->user_id = auth()->id();
    $username = auth()->user()->username;

    if ($request->hasFile('images')) {
      $imageUrls = [];
      foreach ($request->file('images') as $index => $image) {
        if ($index < 4) {
          $fileName = $image->getClientOriginalName();
          $firebasePath = 'post_images/' . $username . '/' . $fileName;

          // Upload image to Firebase Storage
          $uploadedFile = $this->firebaseStorage->getBucket()->upload(
            fopen($image->getRealPath(), 'r'),
            ['name' => $firebasePath]
          );

          // Generate a public URL manually
          $bucketName = config('firebase.storage_bucket');
          $imageUrls[] = "https://storage.googleapis.com/{$bucketName}/{$firebasePath}";
        }
      }
      $post->images = json_encode($imageUrls); // Save Firebase URLs as JSON
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

  public function searchPosts(Request $request)
  {
    $query = $request->input('query');
    $posts = Post::where('message', 'LIKE', "%{$query}%")
      ->orWhereHas('user', function($q) use ($query) {
        $q->where('username', 'LIKE', "%{$query}%")
          ->orWhere('name', 'LIKE', "%{$query}%");
      })
      ->with('user')
      ->get();

    return response()->json($posts);
  }

  public function getAllPosts()
  {
    $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
    return response()->json($posts);
  }
}
