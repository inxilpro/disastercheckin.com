<?php

use App\Http\Controllers\Webhooks\TwilioWebhookController;
use App\Http\Middleware\TwilioSignatureMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/webhooks/twilio', TwilioWebhookController::class)
    ->middleware(TwilioSignatureMiddleware::class)
    ->name('webhooks.twilio');
