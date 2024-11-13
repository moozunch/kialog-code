<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Google\Cloud\Storage\StorageClient;

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

    return redirect()->intended('home');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
  }

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

    // Handle profile image upload to Firebase Storage
    if ($request->hasFile('profile_image')) {
      $image = $request->file('profile_image');
      $imageName = 'photo_profile/' . $user->username . '.' . $image->getClientOriginalExtension();

      // Initialize Firebase Storage bucket
      $storage = app(StorageClient::class);
      $bucket = $storage->bucket(config('firebase.storage_bucket'));

      // Upload to Firebase under 'photo_profile' folder
      $bucket->upload(
        file_get_contents($image->getRealPath()),
        [
          'name' => $imageName,
        ]
      );

      // Firebase image URL
      $imageUrl = "https://storage.googleapis.com/" . config('firebase.storage_bucket') . "/" . $imageName;

      // Optionally delete the old image if stored in Firebase or another service
      if ($user->profile_image) {
        $oldImageName = basename($user->profile_image);
        $bucket->object('photo_profile/' . $oldImageName)->delete();
      }

      // Update the user's profile image URL in the database
      $user->profile_image = $imageUrl;
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

  public function deleteAccount(Request $request)
  {
    $user = Auth::user();
    Auth::logout();
    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Your account has been deleted.');
  }
}
