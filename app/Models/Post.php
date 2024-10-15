<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;

  protected $fillable = ['message', 'image', 'likes', 'comments', 'user_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function bookmarks()
{
    return $this->hasMany(Bookmarks::class);
}

public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'post_user_likes')->withTimestamps();
    }
}
