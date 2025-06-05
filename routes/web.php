<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ProfileController,
    AdminController,
    ServiceController,
    MasterController,
    RecordController,
    FeedbackController,
    NotificationController
};
use App\Http\Middleware\{IsAdmin, IsMaster};


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
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
        Route::post('/record/cancel-by-master', 'cancelByMaster')->name('record.cancel-by-master');
        Route::post('/get-available-time-slots', 'getAvailableTimeSlots')->name('records.getAvailableTimeSlots');
    });
});

Route::controller(AdminController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/admin', 'index')->name('admin');
        Route::get('/admin/excel', 'excel')->name('admin.excel');
        Route::get('/admin/pdf', 'pdf')->name('admin.pdf');
    });
});

Route::controller(ServiceController::class)->group(function () {
    Route::get('/services', 'index')->name('service.index');
    Route::middleware(IsAdmin::class)->group(function () {
        Route::post('/admin/service/new', 'upload')->name('service.upload');
        Route::delete('/admin/service/{service}/delete', 'delete')->name('service.delete');
        Route::patch('/admin/service/{service}/restore', 'restore')->withTrashed()->name('service.restore');
        Route::patch('/admin/service/update', 'update')->name('service.update');
    });
});

Route::controller(MasterController::class)->group(function () {
    Route::middleware(IsMaster::class)->group(function () {
        Route::get('/master/records', 'index')->name('master.list');
    });

    Route::middleware(IsAdmin::class)->group(function () {
        Route::post('/admin/master/new', 'upload')->name('master.upload');
        Route::delete('/admin/master/{master}/delete', 'delete')->name('master.delete');
        Route::patch('/admin/master/{master}/restore', 'restore')->withTrashed()->name('master.restore');
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

Route::middleware('auth')->group(function () {
    // Маршруты для уведомлений
    Route::get('/notifications/get', [NotificationController::class, 'getNotifications'])->name('notifications.get');
    Route::post('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
});

require __DIR__ . '/auth.php';
