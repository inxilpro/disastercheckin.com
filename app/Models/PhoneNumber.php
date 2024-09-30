<?php

namespace App\Models;

use Glhd\Bits\Database\HasSnowflakes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;
use Propaganistas\LaravelPhone\PhoneNumber as PhoneNumberParser;

/** @property-read PhoneNumberParser $value */
class PhoneNumber extends Model
{
    use HasFactory;
    use HasSnowflakes;

    public static function findByValue(string $value, string $country = 'US'): ?static
    {
        return static::where('value', e164($value, $country))->first();
    }

    public static function findByValueOrFail(string $value, string $country = 'US'): static
    {
        return static::where('value', e164($value, $country))->firstOrFail();
    }

    public static function findByValueOrCreate(string $value, string $country = 'US'): static
    {
        return static::firstOrCreate(['value' => e164($value, $country)]);
    }

    protected function casts(): array
    {
        return [
            'value' => E164PhoneNumberCast::class.':US',
            'is_opted_out' => 'bool',
        ];
    }

    public function check_ins(): HasMany
    {
        return $this->hasMany(CheckIn::class)->chaperone('phone_number');
    }

    public function getRouteKeyName()
    {
        return 'value';
    }
}
