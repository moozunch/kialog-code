<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    // Relasi Comment milik satu Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relasi Comment milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
