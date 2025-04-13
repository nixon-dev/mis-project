<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Document\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

Route::middleware(['auth', 'role:Staff'])->prefix('staff')->group(function () {

    Route::get('/dashboard', [StaffController::class, 'index'])->name('staff.index');

    Route::get('/settings', [StaffController::class, 'settings'])->name('staff.settings');

    Route::post('/user/update', [StaffController::class, 'user_update'])->name('staff.user-update');

    Route::post('/user/update-password', [ChangePasswordController::class, 'user_update_password'])->name('staff.user-update-password');

    Route::get('/notifications', [StaffController::class, 'notifications'])->name('staff.notifiations');

    Route::post('/user/update-password', [ChangePasswordController::class, 'user_update_password'])->name('staff.user-update-password');
});