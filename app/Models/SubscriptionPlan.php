<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;
    
    protected $table = 'subscription_plan';

    protected $fillable = ['name', 'price', 'duration', 'features', 'status',];

    public $timestamps = true;

    // public function getFeatures()
    // {
    //     $featureIds = json_decode($this->features, true);

    //     return Feature::whereIn('id', $featureIds)->get();
    // }
}
