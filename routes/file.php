<?php

use App\Http\Controllers\File\FileController;
use Illuminate\Support\Facades\Route;


Route::post('/file/upload', [FileController::class, 'fileUpload'])->name('upload_file');

Route::get('/file/download/{filename}', [FileController::class, 'fileDownload'])->name('download_file');

Route::get('/file/delete/{filename}', [FileController::class, 'fileDelete'])->name('delete_file');