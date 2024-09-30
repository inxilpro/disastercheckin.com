<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Twilio\Security\RequestValidator;

class TwilioSignatureMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        [$signature, $url, $data] = $this->parse($request);

        if (App::isLocal() || $this->validator()->validate($signature, $url, $data)) {
            return $next($request);
        }

        abort(401, 'Invalid signature.');
    }

    protected function parse(Request $request): array
    {
        return [
            $request->header('X-Twilio-Signature'),
            $request->fullUrl(),
            $request->has('bodySHA256') ? $request->getContent() : $request->post(),
        ];
    }

    protected function validator(): RequestValidator
    {
        return new RequestValidator(config('services.twilio.auth_token'));
    }
}
