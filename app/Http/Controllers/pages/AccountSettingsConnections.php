<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;
use Illuminate\Support\Facades\Auth;

class AccountSettingsConnections extends Controller
{
    public function index()
    {
        $blockedUsers = Block::where('user_id', Auth::id())->with('blockedUser')->get();
        return view('content.pages.pages-account-settings-connections', compact('blockedUsers'));
    }

}
