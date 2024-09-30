<?php

namespace App\Http\Controllers;

use App\Events\PhoneNumberQueried;
use App\Http\Requests\SearchRequest;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request)
    {
        $phone_number = PhoneNumberQueried::commit(
            phone_number: $request->validated('phone_number'),
        );

        // TODO: Rate limit this

        return to_route('phone-number', $phone_number);
    }
}
