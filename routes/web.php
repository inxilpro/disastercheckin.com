<?php

use App\Http\Controllers\SearchForPhoneNumber;
use App\Http\Controllers\SubscribeToPhoneNumber;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/search', SearchForPhoneNumber::class)->name('search');
Route::post('/subscribe', SubscribeToPhoneNumber::class)->name('subscribe');
