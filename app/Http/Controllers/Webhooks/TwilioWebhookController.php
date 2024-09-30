<?php

namespace App\Http\Controllers\Webhooks;

use App\Data\SmsCommandType;
use App\Data\SmsParser;
use App\Events\OptOutRequested;
use App\Events\UpdateShared;
use App\Http\Responses\TwilioResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TwilioWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $phone_number = $request->input('From');
        $sms = SmsParser::parse($request->input('Body'));

        return match ($sms->command) {
            SmsCommandType::Update => UpdateShared::commit($phone_number, $sms->message, $request->all()),
            SmsCommandType::OptOut => OptOutRequested::commit($phone_number, $request->all()),
            default => TwilioResponse::make()->message('Please start your message with the word "UPDATE" (eg. UPDATE I am doing OK!)'),
        };
    }
}
