<?php

use App\Http\Controllers\api\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/mark-read/{id}', [ApiController::class, 'mark_read'])->name('mark.read');

Route::get('/view-notif/{id}/{number}', [ApiController::class, 'view_notif'])->name('viewnotif');


Route::get('/file/pdf/download/{filename}', [ApiController::class, 'download_pdf'])->name('download_pdf');

Route::get('file/view/pdf/{filename}', [ApiController::class, 'view_pdf'])->name('view_pdf');