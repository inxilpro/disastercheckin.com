<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Routes defined in this file will read an existing session if there
// is one, but won't start a session if there isn't one. All other "web"
// middleware is excludes (route-model binding, etc).

Route::get('/', HomeController::class)->name('home');
