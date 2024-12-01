<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bookmarks;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;
use App\Models\Block;
use App\Models\PostUserLike;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

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

    $blockedUserIds = Block::where('user_id', Auth::id())->pluck('blocked_user_id');
    $posts = Post::whereNull('topic_id')
            ->whereNotIn('user_id', $blockedUserIds)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

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
      'topic_id' => 'nullable|exists:topics,id',
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

    if ($request->filled('topic_id')) {
      $post->topic_id = $request->topic_id; // Associate post with topic if topic_id is provided
  }

    $post->save();

    if ($request->filled('topic_id')) {
      return redirect()->route('topics.show', ['topic' => $request->topic_id])->with('success', 'Post created successfully!');
  }

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

  public function unblock(Request $request)
    {
        $request->validate([
            'blocked_user_id' => 'required|exists:users,id',
        ]);

        Block::where('user_id', Auth::id())
            ->where('blocked_user_id', $request->blocked_user_id)
            ->delete();

        return redirect()->back()->with('success', 'User unblocked successfully.');
    }

    public function blockedUsers()
    {
        $blockedUsers = Block::where('user_id', Auth::id())->with('blockedUser')->get();
        return view('content.home.blocked_users', compact('blockedUsers'));
    }

    public function show($id)
    {
        $post = Post::with('comments.user')->findOrFail($id); // Muat komentar beserta data pengguna
        return view('content.home.profile', compact('post'));
    }    
    

    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:500', // Validasi konten komentar
        ]);

        // Simpan komentar ke database
        Comment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(), // ID pengguna yang sedang login
            'content' => $request->input('content'),
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function destroyComment($id) {
    $comment = Comment::findOrFail($id);

    // Pastikan hanya pengguna yang membuat komentar bisa menghapusnya
    if (auth()->id() !== $comment->user_id) {
        return back()->with('error', 'Anda tidak diizinkan menghapus komentar ini.');
    }

    $comment->delete();

    return back()->with('success', 'Komentar berhasil dihapus.');
    }

}
