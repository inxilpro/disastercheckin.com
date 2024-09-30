<?php

namespace App\Http\Controllers;

use App\Events\SubscribedToPhoneNumber;
use App\Http\Requests\SubscribeRequest;

class SubscribeController extends Controller
{
    public function __invoke(SubscribeRequest $request)
    {
        $phone_number = SubscribedToPhoneNumber::commit(
            phone_number: $request->validated('phone_number'),
            email: $request->validated('email'),
        );

        session()->flash('message.success', 'You will be notified when this person checks in.');

        return to_route('phone-number', $phone_number);
    }
}
