<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookmarksController extends Controller
{
  public function index()
  {
    return view(view: "content.bookmarks.bookmarks");
  }
}
