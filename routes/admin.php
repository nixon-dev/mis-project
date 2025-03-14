<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/add-document', [AdminController::class, 'add_document']);

    Route::get('/admin/view-document/{id}', [AdminController::class, 'view_document']);

    Route::get('/admin/document-tracking', [AdminController::class, 'document_tracking']);

    Route::post('/admin/insert-document', [AdminController::class, 'insert_document']);

});