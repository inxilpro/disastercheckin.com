<?php

namespace App\Http\Responses;

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

    public function __construct(
        protected MessagingResponse $response,
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
