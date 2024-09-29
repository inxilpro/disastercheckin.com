<?php

namespace App\Http\Controllers;

use App\Actions\NormalizePhoneNumber;
use App\Events\UserSearchedForPhoneNumber;
use Illuminate\Http\Request;

class SearchForPhoneNumber extends Controller
{
    public function __construct(protected NormalizePhoneNumber $normalizePhoneNumber)
    {

    }
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required|string',
        ]);

        // TODO: Do we want to use a package or do anything more robust here?
        // https://stackoverflow.com/questions/4708248/formatting-phone-numbers-in-php
        $phone = ($this->normalizePhoneNumber)($validated['phone_number']);

        UserSearchedForPhoneNumber::fire(
            phone_number: $phone,
        );
    }
}
