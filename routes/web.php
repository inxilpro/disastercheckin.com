<?php

use App\Http\Controllers\SearchForPhoneNumber;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/search', SearchForPhoneNumber::class);
