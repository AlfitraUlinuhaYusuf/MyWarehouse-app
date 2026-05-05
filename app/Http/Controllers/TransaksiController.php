<?php

namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Halaman Transaksi Masuk
    public function masuk(Request $request) {
    $produks = Produk::all();
    $query = Transaksi::with('produk')->where('jenis', 'masuk');

    // Logika Filter Tanggal
    if ($request->start_date && $request->end_date) {
        $query->whereBetween('created_at', [$request->start_date . " 00:00:00", $request->end_date . " 23:59:59"]);
    }

    $riwayat = $query->latest()->get();
    return view('transaksi.masuk.index', compact('produks', 'riwayat'));
}

    // Simpan Transaksi Masuk
    public function storeMasuk(Request $request) {
        $produk = Produk::find($request->produk_id);
        
        Transaksi::create([
            'produk_id' => $request->produk_id,
            'jenis' => 'masuk',
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        // LOGIKA: Tambah Stok
        $produk->increment('stok', $request->jumlah);

        return back()->with('success', 'Stok berhasil ditambah!');
    }

    // Halaman Transaksi Keluar
    public function keluar() {
        $produks = Produk::all();
        $riwayat = Transaksi::where('jenis', 'keluar')->latest()->get();
        return view('transaksi.keluar.index', compact('produks', 'riwayat'));
    }

    // Simpan Transaksi Keluar
    public function storeKeluar(Request $request) {
        $produk = Produk::find($request->produk_id);

        // VALIDASI: Cek stok cukup atau nggak
        if ($produk->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak cukup! Sisa stok: ' . $produk->stok);
        }

        Transaksi::create([
            'produk_id' => $request->produk_id,
            'jenis' => 'keluar',
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        // LOGIKA: Kurangi Stok
        $produk->decrement('stok', $request->jumlah);

        return back()->with('success', 'Stok berhasil dikurangi!');
    }
}

