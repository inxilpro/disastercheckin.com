<?php

use Thunk\Verbs\Models\VerbEvent;
use App\Services\GoogleDocsService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\GoogleDocsController;
use App\Http\Controllers\PhoneNumberController;

Route::post('/search', SearchController::class)->name('search');
Route::get('/stats', AnalyticsController::class);

Route::get('/events', fn () => VerbEvent::query()->count());

Route::get('/docs/{format?}', GoogleDocsController::class);
 


Route::get('/{phone_number}', PhoneNumberController::class)
    ->name('phone-number')
    ->where('phone_number', '[0-9\+]+');

Route::post('/subscribe', SubscribeController::class)->name('subscribe');
