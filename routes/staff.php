<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Document\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

Route::middleware(['auth', 'role:Staff'])->prefix('staff')->group(function () {

    Route::get('/dashboard', [StaffController::class, 'index'])->name('staff.index');

    Route::get('/add-document', [StaffController::class, 'add_document'])->name('staff.add-document');

    Route::get('/document-tracking', [StaffController::class, 'document_tracking'])->name('staff.document');

    Route::get('/document/draft', [StaffController::class, 'document_draft'])->name('staff.document-draft');

    Route::get('/document/pending', [StaffController::class, 'document_pending'])->name('staff.document-pending');

    Route::get('/document/approved', [StaffController::class, 'document_approved'])->name('staff.document-approved');

    Route::get('/document/denied', [StaffController::class, 'document_denied'])->name('staff.document-denied');

    Route::get('/document/view/{id}', [StaffController::class, 'view_document'])->name('staff.view-document');

    Route::post('/insert-document', [DocumentController::class, 'insert_document'])->name('staff.document-insert');

    Route::post('/insert-document-action', [DocumentController::class, 'insert_document_action'])->name('staff.document-insert-action');

    Route::get('/delete-document/{id}', [DocumentController::class, 'delete_document'])->name('staff.document-delete');

    Route::get('/settings', [StaffController::class, 'settings'])->name('staff.settings');

    Route::post('/user/update', [StaffController::class, 'user_update'])->name('staff.user-update');

    Route::post('/user/update-password', [ChangePasswordController::class, 'user_update_password'])->name('staff.user-update-password');

    Route::post('/document/update-status', [DocumentController::class, 'document_update_status'])->name('staff.document-update-status');

    Route::post('/update-document-amount', [DocumentController::class, 'document_update'])->name('staff.document-update-amount');

    Route::post('/document/add-item', [DocumentController::class, 'document_insert_item'])->name('staff.document-insert-item');

    Route::get('/notifications', [StaffController::class, 'notifications'])->name('staff.notifiations');

    Route::post('/user/update-password', [ChangePasswordController::class, 'user_update_password'])->name('staff.user-update-password');

    Route::post('/user/update', [StaffController::class, 'user_update'])->name('staff.user-update');


});