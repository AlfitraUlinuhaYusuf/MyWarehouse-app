<?php

use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 



// 1. Ubah rute utama agar otomatis ke login jika belum login, 
// atau ke dashboard jika sudah login

// Halaman ini bisa dibuka siapa saja tanpa login
Route::get('/', function () {
    return view('welcome'); // Atau ganti 'welcome' dengan nama file landing page-mu
});

// Halaman dashboard tetap dikunci
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// 2. Bungkus semua rute aplikasi di dalam middleware AUTH
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data Group
    Route::prefix('master-data')->name('master-data.')->group(function () {
        Route::resource('produk', ProdukController::class);
        Route::resource('kategori-produk', KategoriProdukController::class);
        
        // Transaksi
        Route::get('/transaksi/masuk', [TransaksiController::class, 'masuk'])->name('transaksi.masuk');
        Route::post('/transaksi/masuk', [TransaksiController::class, 'storeMasuk'])->name('transaksi.masuk.store');
        Route::get('/transaksi/keluar', [TransaksiController::class, 'keluar'])->name('transaksi.keluar');
        Route::post('/transaksi/keluar', [TransaksiController::class, 'storeKeluar'])->name('transaksi.keluar.store');
    });

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [LaporanController::class, 'cetakPdf'])->name('laporan.pdf');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute ini di luar auth jika memang untuk landing page publik
Route::get('/main', function () {
    return view('main');
});

require __DIR__.'/auth.php';