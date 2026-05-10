<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // Total kategori barang
        $totalKategoriBarang = KategoriProduk::count();

        // Total barang masuk dan keluar
        $totalBarangMasuk = 0;
        $totalBarangKeluar = 0;

        if (Schema::hasTable('transaksis')) {
            $jenisColumn = null;
            $jumlahColumn = null;

            if (Schema::hasColumn('transaksis', 'jenis')) {
                $jenisColumn = 'jenis';
            } elseif (Schema::hasColumn('transaksis', 'tipe')) {
                $jenisColumn = 'tipe';
            } elseif (Schema::hasColumn('transaksis', 'jenis_transaksi')) {
                $jenisColumn = 'jenis_transaksi';
            }

            if (Schema::hasColumn('transaksis', 'jumlah')) {
                $jumlahColumn = 'jumlah';
            } elseif (Schema::hasColumn('transaksis', 'jumlah_barang')) {
                $jumlahColumn = 'jumlah_barang';
            } elseif (Schema::hasColumn('transaksis', 'qty')) {
                $jumlahColumn = 'qty';
            }

            if ($jenisColumn && $jumlahColumn) {
                $totalBarangMasuk = Transaksi::where($jenisColumn, 'masuk')->sum($jumlahColumn);
                $totalBarangKeluar = Transaksi::where($jenisColumn, 'keluar')->sum($jumlahColumn);
            }
        }

        // Produk dengan stok minimum
        $stokMinimum = Produk::where('stok', '<=', 5)->get();

        // Data grafik stok barang
        $produkGrafik = Produk::select('nama_produk', 'stok')->get();

        $chartLabels = $produkGrafik->pluck('nama_produk')->values()->toArray();
        $chartStocks = $produkGrafik->pluck('stok')->values()->toArray();

        return view('dashboard', compact(
            'totalKategoriBarang',
            'totalBarangMasuk',
            'totalBarangKeluar',
            'stokMinimum',
            'chartLabels',
            'chartStocks'
        ));
    }
}