<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  public function show()
  {
      $user = Auth::user();
      $posts = Post::where('user_id', $user->id)->get(); // Ambil postingan pengguna

      return view('content.home.profile', compact('user', 'posts'));
  }
}
