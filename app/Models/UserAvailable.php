<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAvailable extends Model
{
    use HasFactory;

    protected $table = 'user_available';

    protected $fillable = ['user_id','matched_at'];

    public $timestamps = true;


}
