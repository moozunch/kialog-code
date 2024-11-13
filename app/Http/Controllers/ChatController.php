<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;

class ChatController extends Controller
{
  public function createConversation(Request $request)
  {
    $conversation = Conversation::create([
      'user_one_id' => $request->user()->id,
      'user_two_id' => $request->input('user_id')
    ]);

    return response()->json($conversation);
  }

  public function sendMessage(Request $request)
  {
    $message = Message::create([
      'conversation_id' => $request->input('conversation_id'),
      'sender_id' => $request->user()->id,
      'content' => $request->input('content')
    ]);

    // Trigger an event for real-time updates
    event(new \App\Events\MessageSent($message));

    return response()->json($message);
  }

  public function getMessages($conversationId)
  {
    $messages = Message::where('conversation_id', $conversationId)->orderBy('created_at', 'asc')->get();
    return response()->json($messages);
  }

  public function markAsRead($messageId)
  {
    $message = Message::find($messageId);
    if ($message) {
      $message->is_read = true;
      $message->save();
    }

    return response()->json(['status' => 'Message marked as read']);
  }
}
