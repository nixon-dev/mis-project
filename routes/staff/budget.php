<?php

use App\Http\Controllers\Document\BudgetController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:Staff'])->prefix('staff/budget/')->group(function () {

    Route::get('/submit/{id}', [BudgetController::class, 'submit'])->name('budget.submit');
    Route::get('/pending', [BudgetController::class, 'pending'])->name('budget.pending');
    Route::get('/approved', [BudgetController::class, 'approved'])->name('budget.approved');
    Route::get('/denied', [BudgetController::class, 'denied'])->name('budget.denied');
    Route::get('/view/{id}', [BudgetController::class, 'view'])->name('budget.view');
    Route::get('/reload/{id}', [BudgetController::class, 'reload_table'])->name('budget.reload');
    Route::post('/action', [BudgetController::class, 'action'])->name('budget.action');
    Route::post('/add-action', [BudgetController::class, 'add_action'])->name('budget.add-action');
    Route::post('/forward', [BudgetController::class, 'forward'])->name('budget.forward');

});