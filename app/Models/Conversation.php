<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'user_one',
    'user_two',

  ];

  public function userOne()
  {
    return $this->belongsTo(User::class, 'user_one');
  }

  public function userTwo()
  {
    return $this->belongsTo(User::class, 'user_two');
  }


  public function users()
  {
    return $this->belongsToMany(User::class, 'user_conversations');
  }

  public function messages()
  {
    return $this->hasMany(Message::class);
  }
}
