<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Twilio\Security\RequestValidator;

class TwilioSignatureMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($this->isValid($request)) {
            return $next($request);
        }

        abort(401, 'Invalid signature.');
    }

    protected function isValid(Request $request): bool
    {
        if (! App::isProduction()) {
            return true;
        }

        [$signature, $url, $data] = $this->parse($request);

        foreach (config()->array('services.twilio.auth_tokens') as $token) {
            if ((new RequestValidator(trim($token)))->validate($signature, $url, $data)) {
                return true;
            }
        }

        Log::warning("Invalid Twilio signature: '{$signature}'");

        return false;
    }

    protected function parse(Request $request): array
    {
        return [
            $request->header('X-Twilio-Signature'),
            $request->fullUrl(),
            $request->has('bodySHA256') ? $request->getContent() : $request->post(),
        ];
    }
}
