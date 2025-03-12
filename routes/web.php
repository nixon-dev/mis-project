<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return view('main.app');
});

Route::get('/page1', [StudentController::class, 'index']);

Route::get('/edit-student/{id}', [StudentController::class, 'edit_student_form']);

Route::get('/add-student-form', [StudentController::class, 'add_student_form']);

Route::post('/insert-student-data', [StudentController::class, 'do_insert']);

Route::post('/update-student-data', [StudentController::class, 'do_update']);

Route::get('/delete-student/{id}', [StudentController::class, 'do_delete']);

Route::get('/page2', [EmployeeController::class, 'index']);