<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Promocode extends Model
{
    protected $fillable = [
        'code',
        'discount_type',
        'discount',
        'expires_at',
        'duration',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function isValid(): bool
    {
        return (!$this->expires_at || $this->expires_at->isFuture());
    }
}
