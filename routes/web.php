<?php

use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Menghubungkan URL /main ke file main.blade.php
Route::get('/main', function () {
    return view('main');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('master-data')->name('master-data.')->group(function () {
    Route::resource('produk', ProdukController::class);
    Route::resource('kategori-produk', KategoriProdukController::class);
    Route::get('/transaksi/masuk', [TransaksiController::class, 'masuk'])->name('transaksi.masuk');
    Route::post('/transaksi/masuk', [TransaksiController::class, 'storeMasuk'])->name('transaksi.masuk.store');

    Route::get('/transaksi/keluar', [TransaksiController::class, 'keluar'])->name('transaksi.keluar');
    Route::post('/transaksi/keluar', [TransaksiController::class, 'storeKeluar'])->name('transaksi.keluar.store');


});


   
   
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
