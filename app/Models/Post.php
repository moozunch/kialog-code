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

  public function userLikes()
  {
    return $this->hasMany(PostUserLike::class);
  }
  public function likedByUsers()
  {
      return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id')->withTimestamps();
  }
  public function comments()
  {
<<<<<<< HEAD
      return $this->hasMany(Comment::class);
  }

  public function topic()
{
    return $this->belongsTo(Topic::class);
}
=======
      return $this->hasMany(Comment::class); 
  }
>>>>>>> 5baf51e1ff70d70511c02df22e9ea819613db3a1

}
