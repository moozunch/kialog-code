<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\MessageSent;



class MessageController extends Controller
{
  public function index()
  {
    $conversations = Conversation::with(['userOne', 'userTwo'])
      ->where('user_one', Auth::id())
      ->orWhere('user_two', Auth::id())
      ->get();

    return view('content.message.message', compact('conversations'));
  }


  public function chat($user_id)
  {
    $otherUser = User::findOrFail($user_id);

    // Check if there's an existing conversation
    $conversation = Conversation::where(function ($query) use ($user_id) {
      $query->where('user_one', Auth::id())
        ->where('user_two', $user_id);
    })
      ->orWhere(function ($query) use ($user_id) {
        $query->where('user_one', $user_id)
          ->where('user_two', Auth::id());
      })
      ->first();

    // If no conversation exists, create a new one
    if (!$conversation) {
      $conversation = Conversation::create([
        'user_one' => Auth::id(),
        'user_two' => $user_id,
      ]);
    }

    // Fetch all conversations for the authenticated user
    $conversations = Conversation::where('user_one', Auth::id())
      ->orWhere('user_two', Auth::id())
      ->get();

    // Pass the conversation, other user, and all conversations to the view
    return view('content.message.message', compact('conversation', 'otherUser', 'conversations'));
  }



  public function sendMessage(Request $request)
  {
    $request->validate([
      'content' => 'required|string',
      'conversation_id' => 'required|exists:conversations,id'
    ]);

    $content = $request->input('content'); // Explicitly retrieve content
    $conversationId = $request->input('conversation_id'); // Explicitly retrieve conversation ID

    $message = Message::create([
      'conversation_id' => $conversationId,
      'sender_id' => Auth::id(),
      'content' => $content,
    ]);


    broadcast(new MessageSent($message))->toOthers();

    return response()->json(['message' => $message], 200);
  }

  public function searchUsers(Request $request)
  {
    $query = $request->input('query');
    $users = User::where('username', 'LIKE', "%{$query}%")->get();

    return response()->json($users);
  }


}
