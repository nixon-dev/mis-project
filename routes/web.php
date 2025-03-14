<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StaffController;


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/logout', [LogoutController::class, 'logout']);

Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.index');
});

Route::get('/page1', [StudentController::class, 'index']);

Route::get('/edit-student/{id}', [StudentController::class, 'edit_student_form']);

Route::get('/add-student-form', [StudentController::class, 'add_student_form']);

Route::post('/insert-student-data', [StudentController::class, 'do_insert']);

Route::post('/update-student-data', [StudentController::class, 'do_update']);

Route::get('/delete-student/{id}', [StudentController::class, 'do_delete']);

Route::get('/page2', [EmployeeController::class, 'index']);

require __DIR__.'/admin.php';