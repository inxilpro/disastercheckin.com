<?php

namespace App\Http\Controllers;

use App\Events\UserSearchedForPhoneNumber;
use Illuminate\Http\Request;

class SearchForPhoneNumber extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required|string',
        ]);

        // TODO: Do we want to use a package or do anything more robust here?
        // https://stackoverflow.com/questions/4708248/formatting-phone-numbers-in-php
        $phone = $this->normalizePhoneNumber($validated['phone_number']);


        UserSearchedForPhoneNumber::fire(
            phone_number: $phone,
        );
    }

    protected function normalizePhoneNumber($phone) {
        $phone = preg_replace('/\D/', '', $phone);

        if (strlen($phone) === 10) {
            $phone = '1' . $phone;
        }

        return '+' . $phone;
    }
}
