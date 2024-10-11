<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TwilioProxyController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = (object) $request->validate([
            'key' => 'required|string',
            'to' => 'required|string|phone:US',
            'from' => 'required|string|phone:US',
            'message' => 'required|string|max:160',
        ]);

        $this->validateSenderKey($validated->key, $validated->from);

        $twilioClient = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );

        try {
            $message = $twilioClient->messages->create(
                $validated->to,
                [
                    'from' => $validated->from,
                    'body' => $validated->message,
                ]
            );

            return response()->json(['success' => true, 'message_sid' => $message->sid]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function validateSenderKey(string $key, string $from): void
    {
        if (
            ! Hash::check($from, $key)
        ) {
            throw new AuthenticationException('Key is invalid for this sending number.');
        }
    }
}
