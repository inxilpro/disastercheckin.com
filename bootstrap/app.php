<?php

use App\Http\Middleware\TwilioSignatureMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\TrustProxies as BaseTrustProxies;
use Monicahq\Cloudflare\Http\Middleware\TrustProxies as CloudflareTrustProxies;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->replace(BaseTrustProxies::class, CloudflareTrustProxies::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
