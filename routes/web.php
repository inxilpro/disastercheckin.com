<?php

use App\Services\GoogleDocsService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\GoogleDocsController;
use App\Http\Controllers\PhoneNumberController;
use App\Livewire\Water\BarrelsTable;

Route::post('/search', SearchController::class)->name('search');
Route::get('/stats', AnalyticsController::class);
Route::get('/docs/{format?}', GoogleDocsController::class)->name('docs');

Route::get('water', BarrelsTable::class)->name('water');
 

Route::get('/{phone_number}', PhoneNumberController::class)
    ->name('phone-number')
    ->where('phone_number', '[0-9\+]+');

Route::post('/subscribe', SubscribeController::class)->name('subscribe');

// Route::view('dashboard', 'dashboard')
// ->middleware(['auth', 'verified'])
// ->name('dashboard');

// Route::view('profile', 'profile')
// ->middleware(['auth'])
// ->name('profile');

// require __DIR__.'/auth.php';


