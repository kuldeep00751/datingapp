<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MeetingResponse extends Model
{
    use HasFactory;

    protected $table = 'meeting_responses';

    protected $fillable = ['user_id', 'meeting_date', 'meeting_place', 'status','user_like_id','meeting_status','cancel_status','already_meet','continue_meet','cancel_reason','more_time_status'];

    public $timestamps = true;

    public function userLikeStatus() {
        return $this->belongsTo(UserLikes::class, 'liked_user_id','id');
    }
}