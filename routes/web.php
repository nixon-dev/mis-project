<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return view('admin.index');
});

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'auth_login']);

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/page1', [StudentController::class, 'index']);

Route::get('/edit-student/{id}', [StudentController::class, 'edit_student_form']);

Route::get('/add-student-form', [StudentController::class, 'add_student_form']);

Route::post('/insert-student-data', [StudentController::class, 'do_insert']);

Route::post('/update-student-data', [StudentController::class, 'do_update']);

Route::get('/delete-student/{id}', [StudentController::class, 'do_delete']);

Route::get('/page2', [EmployeeController::class, 'index']);

Route::get('/add-document', [DocumentController::class, 'add_document_form']);