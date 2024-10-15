<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, ProfileController,
    AdminController, ServiceController, MasterController};
use App\Http\Middleware\IsAdmin;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(AdminController::class)->group(function () {
    Route::middleware('auth')->group(function () {
    Route::get('/admin', 'index')->name('admin');
    });
});

Route::controller(ServiceController::class)->group(function () {
    Route::get('/services', 'index')->name('service.index');
    Route::middleware(IsAdmin::class)->group(function () {
        Route::post('/admin/service/new', 'upload')->name('service.upload');
        Route::delete('/admin/service/destroy', 'destroy')->name('service.destroy');
        Route::patch('/admin/service/update', 'update')->name('service.update');
    });
});

Route::controller(MasterController::class)->group(function () {
    Route::middleware(IsAdmin::class)->group(function () {
        Route::post('/admin/master/new', 'upload')->name('master.upload');
        Route::delete('/admin/master/destroy', 'destroy')->name('master.destroy');
        Route::patch('/admin/master/update', 'update')->name('master.update');
    });
});

Route::controller(ProfileController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/settings', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
    });
});

require __DIR__.'/auth.php';
