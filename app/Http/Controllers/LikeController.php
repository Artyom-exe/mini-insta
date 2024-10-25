<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Comment;

class LikeController extends Controller
{
    public function likePublication($publicationId)
    {
        $publication = Publication::findOrFail($publicationId);
        $publication->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'You liked the publication.');
    }

    public function likeComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'You liked the comment.');
    }
}
