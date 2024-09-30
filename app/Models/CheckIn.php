<?php

namespace App\Models;

use Glhd\Bits\Database\HasSnowflakes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class CheckIn extends Model
{
    use HasFactory;
    use HasSnowflakes;

    protected static function booted()
    {
        static::saved(fn (CheckIn $c) => Cache::forget("phone-number-view:{$c->phone_number->value}"));
    }

    public function phone_number(): BelongsTo
    {
        return $this->belongsTo(PhoneNumber::class);
    }
}
