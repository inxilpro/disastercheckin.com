<?php

use App\Http\Controllers\Webhooks\TwilioWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/webhooks/twilio', TwilioWebhookController::class);
