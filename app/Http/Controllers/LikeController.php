<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Publication;
use App\Models\Story;
use App\Models\CommentLike;
use App\Models\PubliLike;
use App\Models\StoryLike;

class LikeController extends Controller
{
    public function likeComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        if (!$comment->likes()->where('user_id', auth()->id())->exists()) {
            CommentLike::create([
                'user_id' => auth()->id(),
                'comment_id' => $commentId,
            ]);
        }
        return redirect()->back();
    }

    public function likePublication($publicationId)
    {
        $publication = Publication::findOrFail($publicationId);
        if (!$publication->likes()->where('user_id', auth()->id())->exists()) {
            PubliLike::create([
                'user_id' => auth()->id(),
                'publication_id' => $publicationId,
            ]);
        }
        return redirect()->back();
    }

    public function likeStory($storyId)
    {
        $story = Story::findOrFail($storyId);
        if (!$story->likes()->where('user_id', auth()->id())->exists()) {
            StoryLike::create([
                'user_id' => auth()->id(),
                'story_id' => $storyId,
            ]);
        }
        return redirect()->back();
    }

    public function unlikeComment($commentId)
    {
        CommentLike::where('comment_id', $commentId)->where('user_id', auth()->id())->delete();
        return redirect()->back();
    }

    public function unlikePublication($publicationId)
    {
        PubliLike::where('publication_id', $publicationId)->where('user_id', auth()->id())->delete();
        return redirect()->back();
    }

    public function unlikeStory($storyId)
    {
        StoryLike::where('story_id', $storyId)->where('user_id', auth()->id())->delete();
        return redirect()->back();
    }
}
