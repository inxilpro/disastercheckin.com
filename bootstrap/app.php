<?php

use App\Http\Middleware\ReadOnlySesssionMiddleware;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\TrustProxies as BaseTrustProxies;
use Illuminate\Support\Facades\Route;
use Monicahq\Cloudflare\Http\Middleware\TrustProxies as CloudflareTrustProxies;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: fn () => Route::middleware([
            EncryptCookies::class,
            ReadOnlySesssionMiddleware::class,
        ])->group(__DIR__.'/../routes/web-bare.php')
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->replace(BaseTrustProxies::class, CloudflareTrustProxies::class);

        // It's possible that a session won't be started yet, so we need to skip csrf on the search endpoint
        $middleware->validateCsrfTokens(except: ['/search']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
