<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/add-document', [AdminController::class, 'add_document'])->name('admin.add-document');

    Route::get('/admin/view-document/{id}', [AdminController::class, 'view_document'])->name('admin.view-document');

    Route::get('/admin/document-tracking', [AdminController::class, 'document_tracking'])->name('admin.document');

    Route::post('/admin/insert-document', [AdminController::class, 'insert_document']);

    Route::post('/admin/insert-document-action', [AdminController::class, 'insert_document_action']);

    Route::get('/admin/delete-document/{id}', [AdminController::class, 'delete_document']);

    Route::get('/admin/user-settings', [AdminController::class, 'user_settings'])->name('admin.user-settings');

    Route::get('/admin/users', [AdminController::class, 'users_list'])->name('admin.users-list');

    Route::get('/admin/users/{id}', [AdminController::class, 'view_users']);

    Route::post('/admin/users/update', [AdminController::class, 'users_update']);

    Route::post('/admin/user/update', [AdminController::class, 'user_update']);

});