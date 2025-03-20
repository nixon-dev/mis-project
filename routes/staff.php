<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

Route::middleware(['auth', 'role:Staff'])->group(function () {

    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.index');

    Route::get('/staff/add-document', [StaffController::class, 'add_document'])->name('staff.add-document');

    Route::get('/staff/document-tracking', [StaffController::class, 'document_tracking'])->name('staff.document');

    Route::get('/staff/document-tracking/{id}', [StaffController::class, 'view_document'])->name('staff.view-document');

    Route::post('/staff/insert-document', [StaffController::class, 'insert_document']);

    Route::post('/staff/insert-document-action', [StaffController::class, 'insert_document_action']);

    Route::get('/staff/delete-document/{id}', [StaffController::class, 'delete_document']);

    Route::get('/staff/settings', [StaffController::class, 'settings'])->name('staff.settings');

    Route::post('/staff/user/update', [StaffController::class, 'user_update']);

    Route::post('/staff/user/update-password', [ChangePasswordController::class, 'user_update_password']);

    Route::post('/staff/document/update-status', [StaffController::class, 'document_update_status']);

    Route::post('/staff/update-document-amount', [StaffController::class, 'document_update']);
});