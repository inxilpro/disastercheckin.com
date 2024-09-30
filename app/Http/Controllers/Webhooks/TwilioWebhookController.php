<?php

namespace App\Http\Controllers\Webhooks;

use App\Data\SmsCommandType;
use App\Data\SmsParser;
use App\Events\CheckedInViaSms;
use App\Events\OptOutRequested;
use App\Events\PhoneNumberQueried;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Thunk\Verbs\Exceptions\EventNotValid;
use Twilio\TwiML\MessagingResponse;

class TwilioWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $phone_number = $request->input('From');
        $command = SmsParser::parse($request->input('Body'));

        Log::info("Received {$command} from {$phone_number}");

        try {
            return $this->toResponse(match ($command->command) {
                SmsCommandType::Update => CheckedInViaSms::webhook($request, $command),
                SmsCommandType::Search => PhoneNumberQueried::webhook($request, $command),
                SmsCommandType::OptOut => OptOutRequested::webhook($request, $command),
                default => 'To share a public update on disastercheckin.com to anyone who knows your phone number, start your message with "UPDATE" (eg. UPDATE I am doing OK!)',
            });
        } catch (EventNotValid $exception) {
            return $this->toResponse(Str::limit($exception->getMessage(), 160));
        }
    }

    protected function toResponse(MessagingResponse|string $result): Response
    {
        if (is_string($result)) {
            $result = (new MessagingResponse)->message($result);
        }

        if (App::isLocal()) {
            Log::info("Sending: {$result}");
        }

        return response(
            content: (string) $result,
            headers: ['Content-Type' => 'text/xml'],
        );
    }
}
