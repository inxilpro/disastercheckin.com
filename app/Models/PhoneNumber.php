<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhoneNumber extends Model
{
    use HasFactory;

    // Note: could cast `phone` here with Laravel-Phone if useful
    // @see https://github.com/Propaganistas/Laravel-Phone#attribute-casting

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
