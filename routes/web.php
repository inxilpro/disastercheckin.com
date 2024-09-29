<?php

use App\Http\Controllers\Webhooks\TwilioWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('webhooks/twilio', TwilioWebhookController::class);
