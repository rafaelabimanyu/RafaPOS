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
        
        // Kategori Management (New)
        Route::resource('kategori', \App\Http\Controllers\KategoriController::class);

        // Barang Management (Admin full access)
        Route::resource('barang', BarangController::class);
        
        // Stok History
        Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
        
        // User (Petugas) Management
        Route::resource('user', UserController::class);

        // Laporan (New)
        Route::get('/laporan', [\App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/export', [\App\Http\Controllers\LaporanController::class, 'exportExcel'])->name('laporan.export');
        Route::get('/laporan/print', [\App\Http\Controllers\LaporanController::class, 'printPdf'])->name('laporan.print');

        // Pengaturan Toko (New)
        Route::get('/pengaturan', [\App\Http\Controllers\PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::post('/pengaturan', [\App\Http\Controllers\PengaturanController::class, 'update'])->name('pengaturan.update');
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
