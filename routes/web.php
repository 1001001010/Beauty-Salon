<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, ProfileController};

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(ProfileController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/settings', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
    });
});

require __DIR__.'/auth.php';
