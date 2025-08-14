<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLikes extends Model
{
    use HasFactory;

    protected $table = 'user_likes';

    protected $fillable = ['user_id', 'liked_user_id', 'affection','match_email_send_at','count_email','created_at','meeting_status','have_date','follow_up_status','follow_up_at','is_mastering','is_profile_view','reason_profile','reason_description','comments','is_comment_publish','is_connect','is_feedback_pending','want_to_continue'];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo(\App\User::class,'user_id','id');
    }

    public function profile() {
        return $this->belongsTo(\App\User::class, 'liked_user_id','id');
    }
    
    public function userMeetingStatus() {
        return $this->belongsTo(MeetingResponse::class, 'id','user_like_id');
    }
}
