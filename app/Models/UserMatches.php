<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMatches extends Model
{
    use HasFactory;

    protected $table = 'user_matches';

    protected $fillable = ['user_id', 'matched_user_id', 'matched_at'];

    public $timestamps = true;

    public function userData() {
        return $this->belongsTo(\App\User::class,'matched_user_id','id');
    }


}
