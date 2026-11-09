<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::post('/login', 'authenticate')->middleware('throttle:10,1')->name('login.submit');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/pengelolaan', 'pengelolaan')->name('pengelolaan');
    Route::get('/profile', 'profile')->name('profile');
});
