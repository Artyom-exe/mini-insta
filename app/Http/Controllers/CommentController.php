<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Publication;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $publicationId)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $publication = Publication::findOrFail($publicationId);

        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'publication_id' => $publication->id,
        ]);

        return redirect()->route('publication.show', $publication->id)->with('success', 'Comment added successfully.');
    }
}
