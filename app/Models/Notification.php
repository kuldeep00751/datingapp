<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = ['user_id', 'to_id', 'message', 'message-spanish','read','link'];

    public $timestamps = true;

    public function userData() {
        return $this->belongsTo(\App\User::class,'to_id','id');
    }
}
