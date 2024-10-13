<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bookmarks;
use Illuminate\Http\Request;

class BookmarksController extends Controller
{
  public function index()
  {
    $userId = auth()->id();
    $data = Bookmarks::where("user_id", $userId)->get();
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
}
