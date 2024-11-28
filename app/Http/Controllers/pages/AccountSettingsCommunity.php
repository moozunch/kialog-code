<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;


class AccountSettingsCommunity extends Controller
{
  public function index()
  {
      $userId = Auth::id();
      $topics = Topic::whereHas('users', function ($query) use ($userId) {
          $query->where('user_id', $userId);
      })->get();

      return view('content.pages.pages-settings-community', compact('topics'));
  }
}
