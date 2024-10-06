<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrel extends Model
{
    use HasFactory;

    protected $casts = [
        'refilled_at' => 'datetime',
        'refill_requested_at' => 'datetime',
        'decommissioned_at' => 'datetime',
    ];
}