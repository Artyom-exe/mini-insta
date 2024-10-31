<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Story;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Récupérer les stories des utilisateurs suivis, triées par date de création (les plus récentes en premier)
        $followedStories = Story::whereIn('user_id', $user->followings->pluck('id'))
            ->latest() // Trie par created_at DESC
            ->with('user', 'likes')
            ->take(20)
            ->get();

        // Récupérer les publications des utilisateurs suivis
        $followedPublications = Publication::whereIn('user_id', $user->followings->pluck('id'))
            ->latest()
            ->with('user', 'likes')
            ->take(20)
            ->get();

        // Récupérer les publications les plus likées (hors utilisateurs suivis)
        $popularPublications = Publication::withCount('likes')
            ->whereNotIn('user_id', $user->followings->pluck('id'))
            ->orderBy('likes_count', 'desc')
            ->with('user', 'likes')
            ->take(20)
            ->get();

        return view('publication.feed', compact('followedStories', 'followedPublications', 'popularPublications'));
    }
}
