<?php
namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'reason' => 'required|string|max:255',
        ]);

        Report::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'reason' => $request->reason,
        ]);

        return redirect()->back()->with('success', 'Post reported successfully.');
    }
}
