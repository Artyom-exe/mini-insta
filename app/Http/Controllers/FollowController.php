<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;

class FollowController extends Controller
{
    public function follow($id)
    {
        $user = User::findOrFail($id);
        auth()->user()->followings()->attach($user->id);

        return redirect()->back()->with('success', 'You are now following ' . $user->name);
    }

    public function unfollow($id)
    {
        $user = User::findOrFail($id);
        auth()->user()->followings()->detach($user->id);

        return redirect()->back()->with('success', 'You have unfollowed ' . $user->name);
    }
}
