<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

/** @property-read \Propaganistas\LaravelPhone\PhoneNumber $value */
class PhoneNumber extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'value' => E164PhoneNumberCast::class.':US',
        ];
    }

    public function check_ins(): HasMany
    {
        return $this->hasMany(CheckIn::class);
    }
}
