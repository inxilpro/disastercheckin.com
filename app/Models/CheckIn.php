<?php

namespace App\Models;

use Glhd\Bits\Database\HasSnowflakes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckIn extends Model
{
    use HasFactory;
    use HasSnowflakes;

    public function phone_number(): BelongsTo
    {
        return $this->belongsTo(PhoneNumber::class);
    }
}
