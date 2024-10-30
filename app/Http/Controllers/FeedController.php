<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Publications des utilisateurs suivis
        $followedPublications = Publication::whereIn('user_id', $user->followings->pluck('id'))
            ->latest()
            ->with('user', 'likes')
            ->take(20)
            ->get();

        // Publications les plus likées, excluant les suivis
        $popularPublications = Publication::withCount('likes')
            ->whereNotIn('user_id', $user->followings->pluck('id'))
            ->orderBy('likes_count', 'desc')
            ->with('user', 'likes')
            ->take(20)
            ->get();

        return view('publication.feed', compact('followedPublications', 'popularPublications'));
    }
}
