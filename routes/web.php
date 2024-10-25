<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;

Route::get('/', function () {
    return view('welcome');
});

// Laravel Breeze Auth routes
require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('feed');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

    // Publication routes
    Route::get('/feed', [PublicationController::class, 'index'])->name('feed');
    Route::get('/publication/create', [PublicationController::class, 'create'])->name('publication.create');
    Route::post('/publication/store', [PublicationController::class, 'store'])->name('publication.store');
    Route::get('/publication/{id}', [PublicationController::class, 'show'])->name('publication.show');
    Route::delete('/publication/{id}', [PublicationController::class, 'destroy'])->name('publication.delete');

    // Follow routes
    Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');

    // Comment routes
    Route::post('/publication/{publicationId}/comment', [CommentController::class, 'store'])->name('comment.store');

    // Like routes
    Route::post('/publication/{publicationId}/like', [LikeController::class, 'likePublication'])->name('like.publication');
    Route::post('/comment/{commentId}/like', [LikeController::class, 'likeComment'])->name('like.comment');
    Route::post('/story/{storyId}/like', [LikeController::class, 'likeStory'])->name('like.story');

    // Story routes
    Route::get('/story/create', [StoryController::class, 'create'])->name('story.create');
    Route::post('/story/store', [StoryController::class, 'store'])->name('story.store');
    Route::get('/story/{id}', [StoryController::class, 'show'])->name('story.show');
});
