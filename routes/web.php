<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ChartController;

// Auth
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// Register (opsional)
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Semua route ini butuh login
Route::middleware('auth')->group(function () {
    Route::resource('barangs', BarangController::class);

    // Dashboard (pakai ChartController)
    Route::get('/dashboard', [ChartController::class, 'index'])->name('dashboard');

    // Root → redirect ke dashboard
    Route::get('/', fn() => redirect()->route('dashboard'));
});
