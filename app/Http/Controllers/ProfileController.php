<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
  public function showProfile($user_id = null)
  {
    // If no user_id is provided, default to the logged-in user
    $user = $user_id ? User::findOrFail($user_id) : auth()->user();

    // Get the posts for the user (logged-in user or other user)
    $posts = Post::where('user_id', $user->id)->latest()->get();

    // Return the profile view with the user and posts
    return view('content.home.profile', ['user' => $user, 'posts' => $posts]);
  }
}

