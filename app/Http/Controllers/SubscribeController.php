<?php

namespace App\Http\Controllers;

use App\Events\UserRequestedNotificationsOnNumber;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'searcher_phone_number' => 'required',
            'searchee_phone_number' => 'required',
        ]);

        UserRequestedNotificationsOnNumber::fire(
            searcher_phone_number: $request->searcher_phone_number,
            searchee_phone_number: $request->searchee_phone_number,
        );
    }
}
