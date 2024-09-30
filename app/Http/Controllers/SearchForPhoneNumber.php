<?php

namespace App\Http\Controllers;

use App\Events\UserSearchedForPhoneNumber;
use App\Http\Requests\SearchForPhoneNumberRequest;
use Propaganistas\LaravelPhone\PhoneNumber as LaravelPhoneNumber;

class SearchForPhoneNumber extends Controller
{
    public function __invoke(SearchForPhoneNumberRequest $request)
    {
        $phoneNumber = $request->validated('phone_number');

        $number = UserSearchedForPhoneNumber::commit(
            phone_number: (new LaravelPhoneNumber($phoneNumber, 'US'))->formatE164(),
        );

        $number->loadMissing('messages');

        return view('messages', ['number' => $number]);
    }
}
