<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KasirController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        
        // Barang Management (Admin full access)
        Route::resource('barang', BarangController::class);
        
        // Stok History (Admin view only, basically)
        Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
        
        // User (Petugas) Management
        Route::resource('user', UserController::class);
    });

    // Petugas Routes
    Route::middleware(['role:petugas'])->prefix('petugas')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'petugas'])->name('petugas.dashboard');
        
        // Barang (Read only for Petugas)
        Route::get('/barang', [BarangController::class, 'index'])->name('petugas.barang.index');
        
        // Stok (View and Add for Petugas)
        Route::get('/stok', [StokController::class, 'index'])->name('petugas.stok.index');
        Route::post('/stok', [StokController::class, 'store'])->name('petugas.stok.store');
        
        // Kasir
        Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
        Route::post('/kasir/process', [KasirController::class, 'process'])->name('kasir.process');
    });
});
