<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/add-document', [AdminController::class, 'add_document'])->name('admin.add-document');

    Route::get('/admin/document-tracking/{id}', [AdminController::class, 'view_document'])->name('admin.view-document');

    Route::get('/admin/document-tracking', [AdminController::class, 'document_tracking'])->name('admin.document');

    Route::post('/admin/insert-document', [AdminController::class, 'insert_document']);

    Route::post('/admin/insert-document-action', [AdminController::class, 'insert_document_action']);

    Route::get('/admin/delete-document/{id}', [AdminController::class, 'delete_document']);

    Route::get('/admin/user-settings', [AdminController::class, 'user_settings'])->name('admin.user-settings');

    Route::get('/admin/users', [AdminController::class, 'users_list'])->name('admin.users-list');

    Route::get('/admin/users-pending', [AdminController::class, 'pending_users_list'])->name('admin.users-list-pending');

    Route::get('/admin/users/{id}', [AdminController::class, 'view_users']);

    Route::post('/admin/users/update', [AdminController::class, 'users_update']);

    Route::post('/admin/user/update', [AdminController::class, 'user_update']);

    Route::get('/admin/users/delete/{id}', [AdminController::class, 'users_delete']);

    Route::post('/admin/user/update-password', [ChangePasswordController::class, 'user_update_password']);

    Route::get('/admin/office', [AdminController::class, 'office'])->name('admin.office');

    Route::post('/admin/office/add', [AdminController::class, 'office_add']);

    Route::get('/admin/office/{id}', [AdminController::class, 'office_delete']);

    Route::post('/admin/document/update-status', [AdminController::class, 'document_update_status']);

    Route::post('/admin/update-document-amount', [AdminController::class, 'document_update']);

    Route::get('/admin/history', [AdminController::class, 'history'])->name('admin.history');

    Route::get('/admin/active-users', [AdminController::class,'active_users'])->name('admin.active-users');

    Route::post('/admin/document/add-item', [ItemController::class,'add_item']);
    
});