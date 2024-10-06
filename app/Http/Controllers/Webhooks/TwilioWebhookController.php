<?php

namespace App\Http\Controllers\Webhooks;

use App\Data\SmsCommandType;
use App\Data\SmsParser;
use App\Events\BarrelRefillRequested;
use App\Events\CheckedInViaSms;
use App\Events\OptOutRequested;
use App\Events\PhoneNumberQueried;
use App\Events\TwilioWebhookReceived;
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
        TwilioWebhookReceived::fire(payload: $request->all());

        $phone_number = $request->input('From');
        $command = SmsParser::parse($request->input('Body'));

        Log::info("Received {$command} from {$phone_number}");

        try {
            return $this->toResponse(match ($command->command) {
                SmsCommandType::Update => CheckedInViaSms::webhook($request, $command),
                SmsCommandType::Search => PhoneNumberQueried::webhook($request, $command),
                // SmsCommandType::WaterInfo => BarrelInfo::webhook($request, $command),
                SmsCommandType::WaterRefill => BarrelRefillRequested::webhook($request, $command),
                SmsCommandType::OptOut => OptOutRequested::webhook($request, $command),
                default => 'To send updates on DisasterCheckin site to anyone who knows your number, start your msg with "UPDATE" (UPDATE I am OK) SEARCH to find others (SEARCH 8285550000)',
            });
        } catch (EventNotValid $exception) {
            return $this->toResponse(Str::limit($exception->getMessage(), 160));
        }
    }

    protected function toResponse(MessagingResponse|string $result): Response
    {
        if (config('running_fake_sms_command', false)) {
            dd($result);
        }

        if (is_string($result)) {
            $message = $result;
            $result = new MessagingResponse;
            $result->message($message);
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
