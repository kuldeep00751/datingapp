<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id','user_id','like_user_id', 'aspects_highlighted', 'manners', 'photogenic', 'expressiveness', 'opinions_ideas', 'energy', 'willingness', 'comments','attention','sense_humer',
        'comfortable_environment','serious_relationship','not_connect','connect_person','compliment','approximateduration','is_approved','is_admin_review'
    ];
}
