<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    $user = Auth::user();

    if ($user == null) {
        return redirect('/login');
    }

    if ($user->role === 'Administrator') {
        return redirect('/admin/dashboard');
    } elseif ($user->role === 'Staff') {
        return redirect('/staff/dashboard');
    } else {
        return redirect('/login');
    }
})->name('index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

require __DIR__ . '/admin.php';
require __DIR__ . '/staff.php';
require __DIR__ . '/api.php';
require __DIR__ . '/file.php';
require __DIR__ . '/budget.php';