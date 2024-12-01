<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
  public function showProfile($username = null)
  {
    // Find the user by username
    $user = $username ? User::where('username', $username)->firstOrFail() : auth()->user();

    // Get the posts for the user (logged-in user or other user)
    $posts = Post::where('user_id', $user->id)->latest()->get();

    // Return the profile view with the user and posts
    return view('content.home.profile', ['user' => $user, 'posts' => $posts]);
  }

  public function show($id)
  {
      $user = User::with(['followers', 'following'])->findOrFail($id);

      // Followers yang diikuti balik
      $mutualFollowers = $user->followers->filter(function ($follower) use ($user) {
          return $user->following->contains($follower);
      });

      // Followers yang tidak diikuti balik
      $nonMutualFollowers = $user->followers->filter(function ($follower) use ($user) {
          return !$user->following->contains($follower);
      });

      return view('content.home.profile', compact('user', 'mutualFollowers', 'nonMutualFollowers'));
  }
}

