<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;


// Pastikan baris ini ada agar Auth bisa dideteksi
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        $totalJenisBarang = Produk::count();
        $totalBarangMasuk = Transaksi::where('jenis', 'masuk')->sum('jumlah');
        $totalBarangKeluar = Transaksi::where('jenis', 'keluar')->sum('jumlah');
        
        // Ambil produk yang stoknya di bawah 10
        $stokMinimum = Produk::where('stok', '<', 10)->get();

        // Data untuk Chart (Nama Produk & Stok)
        $produkChart = Produk::select('nama_produk', 'stok')->get();

        $produkData = Produk::select('nama_produk', 'stok')->get();
        $labels = $produkData->pluck('nama_produk'); // Variabel ini yang dicari View
        $values = $produkData->pluck('stok');        // Variabel ini juga

        return view('dashboard', compact(
            'totalJenisBarang', 
            'totalBarangMasuk', 
            'totalBarangKeluar', 
            'stokMinimum',
            'labels',  // Pastikan ini ADA
            'values'   // Dan ini juga ADA
        ));
    }
    }


