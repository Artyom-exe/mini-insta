<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    public function create()
    {
        return view('story.create-story');
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
        // Récupère uniquement la story si elle n'a pas expiré
        $story = Story::with('user', 'likes')
            ->where('expires_at', '>', now())
            ->findOrFail($id);
        return view('story.story-detail', compact('story'));
    }
}
