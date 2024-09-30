<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubscribeController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::post('/search', SearchController::class)->name('search');

// Route::post('/subscribe', SubscribeController::class)->name('subscribe');
