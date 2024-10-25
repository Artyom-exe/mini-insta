<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'bio',
    ];

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    public function messagesSent()
    {
        return $this->hasMany(PrivateMessage::class, 'sender_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(PrivateMessage::class, 'receiver_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function storyLikes()
    {
        return $this->hasMany(StoryLike::class);
    }

    public function commentLikes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function publiLikes()
    {
        return $this->hasMany(Publilike::class);
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}
