<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route halaman Landing Page (Home)
Route::get('/', function () {
    return view('home');
});

// Middleware 'guest' -> Hanya bisa diakses oleh orang yang BELUM LOGIN
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

    // Middleware 'auth' -> Hanya bisa diakses oleh orang yang SUDAH LOGIN
    Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    
    // Rute CRUD Tugas
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::patch('/tasks/{task}/done', [TaskController::class, 'markAsDone']);
    Route::delete('/tasks/clear-history', [TaskController::class, 'clearHistory']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
});
