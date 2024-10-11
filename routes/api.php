<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwilioProxyController;
use App\Http\Controllers\Webhooks\TwilioWebhookController;

Route::post('/proxy/twilio', TwilioProxyController::class);

Route::post('/webhooks/twilio', TwilioWebhookController::class)
    // ->middleware(TwilioSignatureMiddleware::class)
    ->name('webhooks.twilio');

