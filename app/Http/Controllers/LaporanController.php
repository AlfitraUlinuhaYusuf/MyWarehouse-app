<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil transaksi 1 bulan terakhir
        $sebulanLalu = Carbon::now()->subMonth();
        $laporan = Transaksi::with('produk')
                    ->where('created_at', '>=', $sebulanLalu)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('laporan.index', compact('laporan'));
    }

    public function cetakPdf()
    {
        $sebulanLalu = Carbon::now()->subMonth();
        $laporan = Transaksi::with('produk')
                    ->where('created_at', '>=', $sebulanLalu)
                    ->orderBy('created_at', 'asc')
                    ->get();

        if ($laporan->isEmpty()) {
            return redirect()
                ->route('laporan.index')
                ->with('error', 'Cetak PDF tidak tersedia karena data laporan masih kosong.');
        }

        $pdf = Pdf::loadView('laporan.pdf', compact('laporan'));
        return $pdf->download('laporan-bulanan-mywarehouse.pdf');
    }
}