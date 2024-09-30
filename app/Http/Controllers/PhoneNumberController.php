<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use Illuminate\Contracts\Database\Query\Builder;

class PhoneNumberController extends Controller
{
    public function __invoke(PhoneNumber $phone_number)
    {
        // TODO: Add cache headers and maybe redis

        $phone_number->loadMissing(['check_ins' => fn (Builder $query) => $query->latest()->limit(10)]);

        return view('phone-number', ['phone_number' => $phone_number]);
    }
}
