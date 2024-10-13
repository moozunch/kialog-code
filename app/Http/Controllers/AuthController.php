<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
  public function signin(Request $request)
  {
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended('home'); // Change 'home' to your intended route
    }

    return redirect()->route('landingpage')->withErrors('Login failed');
  }

  public function signup(Request $request)
  {
    $request->validate([
      'email' => 'required|email|unique:users',
      'username' => 'required|unique:users',
      'password' => 'required|min:6',
    ]);

    $user = User::create([
      'email' => $request->email,
      'username' => $request->username,
      'password' => bcrypt($request->password),
    ]);

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->intended('home'); // Change 'home' to your intended route
  }
}
