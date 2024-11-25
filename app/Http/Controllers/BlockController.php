<?php
namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'blocked_user_id' => 'required|exists:users,id',
        ]);

        Block::create([
            'user_id' => Auth::id(),
            'blocked_user_id' => $request->blocked_user_id,
        ]);

        return redirect()->back()->with('success', 'User blocked successfully.');
    }
}
