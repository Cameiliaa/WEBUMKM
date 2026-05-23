<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\PesananUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingPageController::class, 'index'])->name('welcome');

// Authentication Routes
Auth::routes();

// Route untuk role-based dashboard
Route::middleware(['auth'])->group(function () {
    // Dashboard untuk Admin
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

         // Kelola Admin
         Route::get('/kelola-admin', [AdminController::class, 'index'])->name('admin.kelola-admin.index');
         Route::get('/kelola-admin/create', [AdminController::class, 'create'])->name('admin.kelola-admin.create');
         Route::post('/kelola-admin', [AdminController::class, 'store'])->name('admin.kelola-admin.store');
         Route::put('/kelola-admin/{id}', [AdminController::class, 'update'])->name('admin.kelola-admin.update');
         Route::delete('/kelola-admin/{id}', [AdminController::class, 'destroy'])->name('admin.kelola-admin.destroy');

         // Kelola Pelanggan
         Route::get('/admin/pelanggan', [AdminController::class, 'kelolaPelanggan'])->name('admin.kelola-pelanggan.index');
         Route::delete('/admin/pelanggan/{id}', [AdminController::class, 'destroyPelanggan'])->name('admin.kelola-pelanggan.destroy');

         // Produk
         Route::get('/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
         Route::post('/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
         Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('admin.produk.update');
         Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');

         // pesanan
         Route::get('/pesanan', [PesananController::class, 'index'])->name('admin.pesanan.index');
         Route::post('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('admin.pesanan.updateStatus');
    });

    // Dashboard untuk Tamu
    Route::middleware(['tamu'])->group(function () {
        Route::get('/tamu', [TamuController::class, 'index'])->name('tamu.dashboard');

        Route::get('/pesanan/create', [PesananUserController::class, 'create'])->name('tamu.pesanan.create');
        Route::post('/pesanan', [PesananUserController::class, 'store'])->name('tamu.pesanan.store');
        Route::get('/pesanan/riwayat', [PesananUserController::class, 'history'])->name('tamu.pesanan.history');
        Route::get('/pesanan/{id}/nota', [PesananUserController::class, 'downloadNota'])->name('pesanan.downloadNota');


    });
});
