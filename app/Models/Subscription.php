<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    protected $fillable = ['user_id', 'plan', 'status', 'start_date', 'end_date','payment_id','renew_status','payment_status','paused_until', 'paused_hide', 'is_renew','last_expire_reminder'];

    public $timestamps = true;

    protected $dates = ['start_date', 'end_date'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function planDetail() {
        return $this->belongsTo(SubscriptionPlan::class, 'plan','id');
    }

    public function user() {
        return $this->belongsTo(\App\User::class, 'user_id','id');
    }
}
