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
      return response()->json(['success' => true, 'redirect' => route('home')]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid username or password.']);
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

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); // Redirect to the landing page or login page
  }

  //account settings
  public function updateAccountSettings(Request $request)
  {
    $request->validate([
      'username' => 'required|string|max:255',
      'name' => 'nullable|string|max:255',
      'email' => 'required|string|email|max:255',
      'institution' => 'nullable|string|max:255',
      'bio' => 'nullable|string|max:255',
      'country' => 'nullable|string|max:255',
      'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
    ]);

    $user = Auth::user();

    // Handle profile image upload
    if ($request->hasFile('profile_image')) {
      // Store the image and set the path in the database
      $imagePath = $request->file('profile_image')->store('profile_images', 'public');

      // Optionally delete the old image if it exists
      if ($user->profile_image && \Storage::exists('public/' . $user->profile_image)) {
        \Storage::delete('public/' . $user->profile_image);
      }

      // Update profile image path
      $user->profile_image = $imagePath;
    }

    // Update other fields
    $user->username = $request->input('username');
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->institution = $request->input('institution');
    $user->bio = $request->input('bio');
    $user->country = $request->input('country');

    // Save updated user details
    $user->save();

    return redirect()->back()->with('success', 'Account settings updated successfully.');
  }


}
