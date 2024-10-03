<?php

namespace App\Models;

use Glhd\Bits\Database\HasSnowflakes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\HtmlString;

class CheckIn extends Model
{
    use HasFactory;
    use HasSnowflakes;

    protected static function booted()
    {
        static::saved(fn (CheckIn $c) => Cache::forget("phone-number-view:{$c->phone_number->value}"));
    }

    protected function htmlBody(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => new HtmlString(
                nl2br(e($attributes['body']), false)
            )
        );
    }

    public function phone_number(): BelongsTo
    {
        return $this->belongsTo(PhoneNumber::class);
    }
}
