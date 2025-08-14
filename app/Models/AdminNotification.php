<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AdminNotification extends Model
{
    use HasFactory;

    protected $table = 'admin-notifications';

    protected $fillable = ['admin_id','user_id', 'to_id', 'message', 'read','link'];

    public $timestamps = true;

}
