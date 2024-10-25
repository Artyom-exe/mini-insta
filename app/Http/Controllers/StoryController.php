<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    public function create()
    {
        return view('create-story');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store('stories', 'public');

        Story::create([
            'image_url' => $path,
            'user_id' => auth()->id(),
            'expires_at' => now()->addDay(),
        ]);

        return redirect()->route('feed')->with('success', 'Story created successfully.');
    }

    public function show($id)
    {
        $story = Story::with('user', 'likes')->findOrFail($id);
        return view('story-detail', compact('story'));
    }
}
