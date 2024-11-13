<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'email',
    'username',
    'password',
    'profile_image',
    'institution',
    'bio',
    'country'
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];
  public function bookmarks()
  {
    return $this->hasMany(Bookmarks::class);
  }
  public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimestamps();
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_user');
    }
}
