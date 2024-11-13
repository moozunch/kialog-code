<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'description',
    'user_id',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function users()
    {
        return $this->belongsToMany(User::class, 'topic_user');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
