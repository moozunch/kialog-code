<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bookmarks;
use App\Models\Block;
use Illuminate\Http\Request;

class BookmarksController extends Controller
{
  public function index()
  {
    $userId = auth()->id();
    $blockedUserIds = Block::where('user_id', $userId)->pluck('blocked_user_id');

    $data = Bookmarks::where('user_id', $userId)
        ->whereNotIn('post_id', function ($query) use ($blockedUserIds) {
            $query->select('id')
                ->from('posts')
                ->whereIn('user_id', $blockedUserIds);
        })
        ->get();
    return view("content.bookmarks.bookmarks", ['bookmarks' => $data]);
  }
  public function toggleBookmark($postId)
  {
    $userId = auth()->id();

    // Check if the bookmark exists
    $dataExist = Bookmarks::where([
      'user_id' => $userId,
      'post_id' => $postId,
    ])->exists(); // Use exists() to check if any records exist

    if ($dataExist) {
      // Delete the bookmark if it exists
      Bookmarks::where([
        'user_id' => $userId,
        'post_id' => $postId,
      ])->delete(); // Use delete() instead of destroy() for a query
    } else {
      // Create a new bookmark if it does not exist
      Bookmarks::create([
        'user_id' => $userId,
        'post_id' => $postId,
      ]);
    }

    // Optionally, redirect or return a response
    return redirect()->route('posts.index')->with('success', 'Bookmark toggled successfully!');
  }

  public function store(Request $request, $postId)
  {
      $request->validate([
          'topic_id' => 'nullable|exists:topics,id',
      ]);

      $userId = auth()->id();

      // Check if the bookmark exists
      $bookmark = Bookmarks::where([
          'user_id' => $userId,
          'post_id' => $postId,
      ])->first();

      if ($bookmark) {
        // Delete the bookmark if it exists
        $bookmark->delete();
    } else {
        // Create a new bookmark if it doesn't exist
        Bookmarks::create([
            'user_id' => $userId,
            'post_id' => $postId,
        ]);
    }

    if ($request->filled('topic_id')) {
        return redirect()->route('topics.show', ['topic' => $request->topic_id])->with('success', 'Bookmark toggled successfully!');
    }

    return redirect()->back()->with('success', 'Bookmark toggled successfully!');
}
}
