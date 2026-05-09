<?php

use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman awal website
// Jika belum login, user diarahkan ke halaman login
// Jika sudah login, user diarahkan ke homepage
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }

    return redirect()->route('login');
});

// Semua halaman di bawah ini hanya bisa diakses setelah login
Route::middleware(['auth', 'verified'])->group(function () {

    // Homepage setelah login
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::prefix('master-data')->name('master-data.')->group(function () {

        // Produk
        Route::resource('produk', ProdukController::class);

        // Kategori Produk
        Route::resource('kategori-produk', KategoriProdukController::class);

        // Transaksi Barang Masuk
        Route::get('/transaksi/masuk', [TransaksiController::class, 'masuk'])->name('transaksi.masuk');
        Route::post('/transaksi/masuk', [TransaksiController::class, 'storeMasuk'])->name('transaksi.masuk.store');

        // Transaksi Barang Keluar
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

// Halaman main lama, boleh tetap ada jika masih dibutuhkan
Route::get('/main', function () {
    return view('main');
})->name('main');

require __DIR__.'/auth.php';