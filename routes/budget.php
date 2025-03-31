<?php

use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:Staff'])->group(function () {

    Route::get('/staff/submit/{id}', [BudgetController::class, 'submit'])->name('budget.submit');

    Route::get('/staff/pending-documents', [BudgetController::class, 'pending'])->name('budget.pending');

    Route::get('/staff/pending-documents/view/{id}', [BudgetController::class, 'view'])->name('budget.view');

    Route::get('/staff/budget/reload/{id}', [BudgetController::class,'reload_table'])->name('budget.reload');

});
