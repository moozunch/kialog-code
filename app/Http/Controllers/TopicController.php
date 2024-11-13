<?php
namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

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

        return redirect()->back()->with('success', 'Topic created successfully!');
    }

    public function join(Topic $topic)
    {
        $topic->users()->attach(auth()->id());

        return redirect()->route('topics.show', $topic->id)->with('success', 'Joined topic successfully!');
    }

    public function show(Topic $topic)
    {
        return view('content.topic.show', compact('topic'));
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();

        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully.');
    }
}
