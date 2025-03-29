<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Document\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/add-document', [AdminController::class, 'add_document'])->name('admin.document-add');

    Route::get('/admin/document-tracking/{id}', [AdminController::class, 'view_document'])->name('admin.document-view');

    Route::get('/admin/document-tracking', [AdminController::class, 'document_tracking'])->name('admin.document');

    Route::post('/admin/insert-document', [DocumentController::class, 'insert_document'])->name('admin.document-insert');

    Route::post('/admin/insert-document-action', [DocumentController::class, 'insert_document_action'])->name('admin.document-insert-action');

    Route::get('/admin/delete-document/{id}', [DocumentController::class, 'delete_document'])->name('admin.document-delete');

    Route::get('/admin/user-settings', [AdminController::class, 'user_settings'])->name('admin.user-settings');

    Route::get('/admin/users', [AdminController::class, 'users_list'])->name('admin.users-list');

    Route::get('/admin/users-pending', [AdminController::class, 'pending_users_list'])->name('admin.users-list-pending');

    Route::get('/admin/users/{id}', [AdminController::class, 'view_users'])->name('admin.users');

    Route::post('/admin/users/update', [AdminController::class, 'users_update'])->name('admin.users-update');

    Route::post('/admin/user/update', [AdminController::class, 'user_update'])->name('admin.user-update');

    Route::get('/admin/users/delete/{id}', [AdminController::class, 'users_delete'])->name('admin.users-delete');

    Route::post('/admin/user/update-password', [ChangePasswordController::class, 'user_update_password'])->name('admin.user-update-password');

    Route::get('/admin/office', [AdminController::class, 'office'])->name('admin.office');

    Route::post('/admin/office/add', [AdminController::class, 'office_add'])->name('admin.office-add');

    Route::get('/admin/office/{id}', [AdminController::class, 'office_delete'])->name('admin.office-delete');

    Route::post('/admin/document/update-status', [DocumentController::class, 'document_update_status'])->name('admin.document-update-status');

    Route::post('/admin/update-document-amount', [DocumentController::class, 'document_update'])->name('admin.document-update-amount');

    Route::get('/admin/history', [AdminController::class, 'history'])->name('admin.history');

    Route::get('/admin/active-users', [AdminController::class, 'active_users'])->name('admin.active-users');

    Route::post('/admin/document/add-item', [DocumentController::class, 'document_insert_item'])->name('admin.document-insert-item');

});