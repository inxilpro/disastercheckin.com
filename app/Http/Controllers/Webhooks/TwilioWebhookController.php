<?php

namespace App\Http\Controllers\Webhooks;

use App\Events\TwilioWebhookReceived;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Twilio\TwiML\MessagingResponse;

class TwilioWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        TwilioWebhookReceived::fire(payload: $request->input());

        $response = new MessagingResponse();
        $response->message('WIP');

        return response($response);
    }
}
