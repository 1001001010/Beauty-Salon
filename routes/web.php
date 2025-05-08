<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, ProfileController,
    AdminController, ServiceController, MasterController,
    RecordController, FeedbackController};
use App\Http\Middleware\{IsAdmin, IsMaster};


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/search', 'search')->name('search');
});

Route::controller(FeedbackController::class)->group(function () {
    Route::get('/feedback/{sort?}', 'index')->name('feedback.index');
    Route::post('/feedback/new', 'upload')->name('feedback.upload')->middleware('auth');
    Route::delete('/feedback/destroy', 'destroy')->name('feedback.destroy')->middleware('auth');
});

Route::controller(RecordController::class)->group(function () {
    Route::middleware('auth')->group(callback: function () {
    Route::post('/records/new', 'upload')->name('records.upload');
    Route::delete('/records/delete', 'delete')->name('records.delete');
    });
});

Route::controller(AdminController::class)->group(function () {
    Route::middleware('auth')->group(function () {
    Route::get('/admin', 'index')->name('admin');
    Route::get('/admin/exel', 'exel')->name('admin.exel');
    });
});

Route::controller(ServiceController::class)->group(function () {
    Route::get('/services', 'index')->name('service.index');
    Route::middleware(IsAdmin::class)->group(function () {
        Route::post('/admin/service/new', 'upload')->name('service.upload');
        Route::delete('/admin/service/delete', 'delete')->name('service.delete');
        Route::patch('/admin/service/update', 'update')->name('service.update');
    });
});

Route::controller(MasterController::class)->group(function () {
    Route::middleware(IsMaster::class)->group(function () {
        Route::get('/master/records', 'index')->name('master.list');
    });

    Route::middleware(IsAdmin::class)->group(function () {
        Route::post('/admin/master/new', 'upload')->name('master.upload');
        Route::delete('/admin/master/delete', 'delete')->name('master.delete');
        Route::patch('/admin/master/update', 'update')->name('master.update');
        Route::get('/api/users/search', 'search')->name('api.users.search');
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
