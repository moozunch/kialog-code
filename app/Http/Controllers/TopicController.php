<?php
namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        return view('content.topic.topic', compact('topics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $topic = new Topic();
        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->user_id = auth()->id();
        $topic->save();

        $topic->users()->attach(auth()->id());

        return redirect()->back()->with('success', 'Topic created successfully!');
    }

    public function join(Topic $topic)
    {
        $topic->users()->attach(auth()->id());

        return redirect()->route('topics.show', $topic->id)->with('success', 'Joined topic successfully!');
    }

    public function show($id)
    {
        // Fetch the topic by ID
        $topic = Topic::findOrFail($id);

        // Fetch trending topics (example logic, adjust as needed)
        $trendingTopics = Topic::whereDoesntHave('users', function ($query) {
          $query->where('user_id', Auth::id());
      })->orderBy('created_at', 'desc')->take(4)->get();


        return view('content.topic.show', compact('topic', 'trendingTopics'));
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();

        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully.');
    }

    public function quit($id)
    {
        // Fetch the topic by ID
        $topic = Topic::findOrFail($id);

        // Remove the user from the topic's members
        $topic->users()->detach(Auth::id());

        return redirect()->route('topics.index')->with('success', 'You have successfully quit the community.');
    }
}
