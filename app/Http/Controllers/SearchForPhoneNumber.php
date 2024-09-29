<?php

namespace App\Http\Controllers;

use App\Events\UserSearchedForPhoneNumber;
use App\Http\Requests\SearchForPhoneNumberRequest;
use Propaganistas\LaravelPhone\PhoneNumber;

class SearchForPhoneNumber extends Controller
{
    public function __invoke(SearchForPhoneNumberRequest $request)
    {
        $phoneNumber = $request->validated('phone_number');

        UserSearchedForPhoneNumber::fire(
            phone_number: (new PhoneNumber($phoneNumber, 'US'))->formatE164(),
        );
    }
}
