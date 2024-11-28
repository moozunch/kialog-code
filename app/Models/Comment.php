<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Allow mass assignment for these attributes
    protected $fillable = [
        'post_id',
        'user_id',
        'content',
    ];
    
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