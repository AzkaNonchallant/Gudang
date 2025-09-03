<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\UserController;

// ======================
// AUTH ROUTES
// ======================
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// ======================
// PROTECTED ROUTES
// ======================
Route::middleware('auth')->group(function () {

    // Barang CRUD (staff/admin)
    Route::resource('barangs', BarangController::class);

    // Dashboard chart
    Route::get('/dashboard', [ChartController::class, 'index'])->name('dashboard');

    // Root redirect ke dashboard
    Route::get('/', fn() => redirect()->route('dashboard'));

    // ======================
    // ADMIN ONLY
    // ======================
    Route::middleware('admin')->prefix('admin')->as('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });
});
