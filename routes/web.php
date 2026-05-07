<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

// landing page
Route::get('/', function () {
    return view('home');
});

// hanya bisa diakses kalau belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// hanya bisa diakses kalau sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');

    // CRUD tugas
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::patch('/tasks/{task}/done', [TaskController::class, 'markAsDone']);
    Route::delete('/tasks/clear-history', [TaskController::class, 'clearHistory']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
});
