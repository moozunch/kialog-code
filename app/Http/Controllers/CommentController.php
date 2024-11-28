<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;

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

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back();
    }
}
