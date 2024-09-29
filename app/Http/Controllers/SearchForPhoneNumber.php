<?php

namespace App\Http\Controllers;

use App\Events\UserSearchedForPhoneNumber;
use Illuminate\Http\Request;

class SearchForPhoneNumber extends Controller
{
    public function __invoke(Request $request, string $phone_number)
    {
        $request->validate([
            'phone_number' => 'required|phone_number',
        ]);

        UserSearchedForPhoneNumber::fire(
            phone_number: $phone_number,
        );
    }
}
