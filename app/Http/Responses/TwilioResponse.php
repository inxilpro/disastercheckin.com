<?php

namespace App\Http\Responses;

use App\Data\SmsCommandType;
use Illuminate\Http\Response;
use Illuminate\Support\Traits\ForwardsCalls;
use Twilio\TwiML\MessagingResponse;

/** @mixin MessagingResponse */
class TwilioResponse extends Response
{
    use ForwardsCalls;

    public static function make(): static
    {
        return new static(new MessagingResponse);
    }

    public static function forSmsCommand(SmsCommandType $command)
    {
        return static::make()->message(match ($command) {
            SmsCommandType::Update => 'Your update has been saved. Anyone with your phone number can find your message at disastercheckin.com. Send "CANCEL" to remove all your updates.',
            SmsCommandType::OptOut => 'Your phone number and any updates you have sent will be removed from disastercheckin.com shortly.',
            default => null,
        });
    }

    public function __construct(
        public MessagingResponse $response,
    ) {
        parent::__construct(
            content: (string) $response,
            headers: ['Content-Type' => 'application/xml'],
        );
    }

    public function __call($method, $parameters)
    {
        return $this->forwardDecoratedCallTo($this->response, $method, $parameters);
    }
}
