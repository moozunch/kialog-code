<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
  public function signin(Request $request)
  {
    $request->validate([
      'username' => 'required|string',
      'password' => 'required|string',
    ]);

    $user = DB::table('users')->where('username', $request->username)->first();

    if ($user && Hash::check($request->password, $user->password)) {
      Session::put('user_id', $user->id);
      Session::put('username', $user->username);
      return redirect('/home');
    } else {
      return response()->json(['success' => false, 'message' => 'Invalid username or password']);
    }
  }

  public function signup(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'username' => 'required|string',
      'password' => 'required|string',
    ]);

    $password = Hash::make($request->password);

    $user_id = DB::table('users')->insertGetId([
      'email' => $request->email,
      'username' => $request->username,
      'password' => $password,
      'created_at' => now(),
    ]);

    Session::put('user_id', $user_id);
    Session::put('username', $request->username);

    return redirect('/home');
  }
}
