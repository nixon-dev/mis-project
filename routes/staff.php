<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Document\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

Route::middleware(['auth', 'role:Staff'])->group(function () {

    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.index');

    Route::get('/staff/add-document', [StaffController::class, 'add_document'])->name('staff.add-document');

    Route::get('/staff/document-tracking', [StaffController::class, 'document_tracking'])->name('staff.document');

    Route::get('/staff/document-tracking/{id}', [StaffController::class, 'view_document'])->name('staff.view-document');

    Route::post('/staff/insert-document', [DocumentController::class, 'insert_document'])->name('staff.document-insert');

    Route::post('/staff/insert-document-action', [DocumentController::class, 'insert_document_action'])->name('staff.document-insert-action');

    Route::get('/staff/delete-document/{id}', [DocumentController::class, 'delete_document'])->name('staff.document-delete');

    Route::get('/staff/settings', [StaffController::class, 'settings'])->name('staff.settings');

    Route::post('/staff/user/update', [StaffController::class, 'user_update'])->name('staff.user-update');

    Route::post('/staff/user/update-password', [ChangePasswordController::class, 'user_update_password'])->name('staff.user-update-password');

    Route::post('/staff/document/update-status', [DocumentController::class, 'document_update_status'])->name('staff.document-update-status');

    Route::post('/staff/update-document-amount', [DocumentController::class, 'document_update'])->name('staff.document-update-amount');

    Route::post('/staff/document/add-item', [DocumentController::class, 'document_insert_item'])->name('staff.document-insert-item');

});