<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Document\DocumentController;
use App\Http\Controllers\Document\ExternalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

Route::middleware(['auth', 'role:Staff'])->prefix('staff/external')->group(function () {

    Route::get('/pending', [ExternalController::class, 'pending'])->name('external.pending');

    Route::get('/approved', [ExternalController::class, 'approved'])->name('external.approved');

    Route::get('/denied', [ExternalController::class, 'denied'])->name('external.denied');

    Route::get('/view/{id}', [ExternalController::class, 'view'])->name('external.view');

    Route::post('/add-action', [ExternalController::class, 'add_action'])->name('external.add-action');

});