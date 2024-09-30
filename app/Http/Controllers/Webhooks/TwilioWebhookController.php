<?php

namespace App\Http\Controllers\Webhooks;

use App\Data\SmsCommandType;
use App\Data\SmsParser;
use App\Events\CheckedInViaSms;
use App\Events\OptOutRequested;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Twilio\TwiML\MessagingResponse;

class TwilioWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $phone_number = $request->input('From');
        $command = SmsParser::parse($request->input('Body'));

        Log::info("Received {$command} from {$phone_number}");

        return $this->toResponse(match ($command->command) {
            SmsCommandType::Update => CheckedInViaSms::webhook($request, $command),
            SmsCommandType::OptOut => OptOutRequested::webhook($request, $command),
            default => 'Please start your message with the word "UPDATE" (eg. UPDATE I am doing OK!)',
        });
    }

    protected function toResponse(MessagingResponse|string $result): Response
    {
        if (is_string($result)) {
            $result = (new MessagingResponse)->message($result);
        }

        return response(
            content: (string) $result,
            headers: ['Content-Type' => 'application/xml'],
        );
    }
}
