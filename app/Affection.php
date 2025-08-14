<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affection extends Model
{
    protected $table = 'user_likes';
    protected $fillable = [
        'user_id', 'liked_user_id', 'affection'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
