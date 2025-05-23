<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Document\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'role:Administrator'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/add-document', [AdminController::class, 'add_document'])->name('admin.document-add');

    Route::get('/document-tracking/{id}', [AdminController::class, 'view_document'])->name('admin.document-view');

    Route::get('/document-tracking', [AdminController::class, 'document_tracking'])->name('admin.document');

    Route::post('/insert-document', [DocumentController::class, 'insert_document'])->name('admin.document-insert');

    Route::post('/insert-document-action', [DocumentController::class, 'insert_document_action'])->name('admin.document-insert-action');

    Route::get('/delete-document/{id}', [DocumentController::class, 'delete_document'])->name('admin.document-delete');

    Route::get('/user-settings', [AdminController::class, 'user_settings'])->name('admin.user-settings');

    Route::get('/users', [AdminController::class, 'users_list'])->name('admin.users-list');

    Route::get('/users-pending', [AdminController::class, 'pending_users_list'])->name('admin.users-list-pending');

    Route::get('/users/{id}', [AdminController::class, 'view_users'])->name('admin.users-view');

    Route::post('/users/update', [AdminController::class, 'users_update'])->name('admin.users-update');

    Route::post('/user/update', [AdminController::class, 'user_update'])->name('admin.user-update');

    Route::get('/users/delete/{id}', [AdminController::class, 'users_delete'])->name('admin.users-delete');

    Route::post('/user/update-password', [ChangePasswordController::class, 'user_update_password'])->name('admin.user-update-password');

    Route::post('/document/update-status', [DocumentController::class, 'document_update_status'])->name('admin.document-update-status');

    Route::post('/update-document-amount', [DocumentController::class, 'document_update'])->name('admin.document-update-amount');

    Route::get('/history', [AdminController::class, 'history'])->name('admin.history');

    Route::get('/active-users', [AdminController::class, 'active_users'])->name('admin.active-users');

    Route::post('/document/add-item', [DocumentController::class, 'document_insert_item'])->name('admin.document-insert-item');

    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

    Route::get('/account-settings', [AdminController::class, 'account_settings'])->name('admin.new-settings');

    // Office

    Route::get('/office', [AdminController::class, 'office'])->name('admin.office');
    Route::post('/office/add', [AdminController::class, 'office_add'])->name('admin.office-add');
    Route::post('/office/edit', [AdminController::class, 'office_edit'])->name('admin.office_edit');
    Route::get('/office/{id}', [AdminController::class, 'office_delete'])->name('admin.office-delete');


    // Units

    Route::get('/units', [AdminController::class, 'units'])->name('admin.units');
    Route::post('/units/add', [AdminController::class, 'units_add'])->name('admin.units-add');
    Route::post('/units/edit', [AdminController::class, 'units_edit'])->name('admin.units-edit');
    Route::get('/units/delete/{id}', [AdminController::class, 'units_delete'])->name('admin.units-delete');


    // Responsibility Center
    Route::get('/responsibility-centers', [AdminController::class, 'responsiblity_center_list'])->name('admin.responsibility-center');
    Route::post('/responsibility-center/add', [AdminController::class, 'responsibility_center_add'])->name('admin.rescen-add');
    Route::post('/responsibility-center/edit', [AdminController::class, 'responsibility_center_edit'])->name('admin.rescen-edit');
    Route::get('/responsibility-center/delete/{code}', [AdminController::class, 'responsibility_center_delete'])->name('admin.rescen-delete');

    // MOOE
    Route::get('/mooe', [AdminController::class, 'mooe_list'])->name('admin.mooe');
    Route::post('/mooe/add', [AdminController::class, 'mooe_add'])->name('admin.mooe-add');
    Route::post('/mooe/edit', [AdminController::class, 'mooe_edit'])->name('admin.mooe-edit');
    Route::get('/mooe/delete/{code}', [AdminController::class, 'mooe_delete'])->name('admin.mooe-delete');

    // Capital Outlay
    Route::get('/capital-outlay', [AdminController::class, 'co_list'])->name('admin.co');
    Route::post('/capital-outlay/add', [AdminController::class, 'co_add'])->name('admin.co-add');
    Route::post('/capital-outlay/edit', [AdminController::class, 'co_edit'])->name('admin.co-edit');
    Route::get('/capital-outlay/delete/{code}', [AdminController::class, 'co_delete'])->name('admin.co-delete');


});