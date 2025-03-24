<?php

use App\Http\Controllers\api\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/api/history', [ApiController::class, 'get_history']);