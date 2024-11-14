<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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
}

