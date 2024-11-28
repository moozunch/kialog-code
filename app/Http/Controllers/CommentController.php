<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Comment;
=======
use App\Models\Comment; // Ensure you have the Comment model
use Illuminate\Support\Facades\Auth;
>>>>>>> 2b886cbd933ffed857952e0b9acdbd29a3ab6d40

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate(['content' => 'required']);

        Comment::create([
            'post_id' => $postId,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return back();
    }

    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        return back();
    }

    
}