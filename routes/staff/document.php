<?php

use App\Http\Controllers\Document\DocumentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:Staff'])->prefix('staff/document/')->group(function () {

    Route::post('/add', [DocumentController::class, 'add'])->name('document.add');

    Route::get('/draft', [DocumentController::class, 'draft'])->name('document.draft');

    Route::get('/pending', [DocumentController::class, 'pending'])->name('document.pending');

    Route::get('/approved', [DocumentController::class, 'approved'])->name('document.approved');

    Route::get('/denied', [DocumentController::class, 'denied'])->name('document.denied');

    Route::get('/view/{id}', [DocumentController::class, 'view'])->name('document.view');

    Route::post('/update', [DocumentController::class, 'update'])->name('document.update');

    Route::post('/submit', [DocumentController::class, 'submit'])->name('document.submit');

    Route::post('/add-item', [DocumentController::class, 'add_item'])->name('document.add-item');

    Route::post('/add-action', [DocumentController::class, 'add_action'])->name('document.add-action');

    Route::get('/delete-document/{id}', [DocumentController::class, 'delete_document'])->name('staff.document-delete');

    Route::post('/document/update-status', [DocumentController::class, 'document_update_status'])->name('staff.document-update-status');

});