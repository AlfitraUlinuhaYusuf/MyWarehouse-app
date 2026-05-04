<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    public $pageTitle = 'Kategori Produk';

    /**
     * Menampilkan daftar kategori dengan fitur pencarian dan pagination.
     */
    public function index(Request $request)
    {
        $pageTitle = $this->pageTitle;
        $query = KategoriProduk::query();

        // Fitur Cari
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        // Pagination dengan mempertahankan query string (untuk search)
        $kategori = $query->latest()->paginate(10)->withQueryString();

        return view('kategori-produk.index', compact('pageTitle', 'kategori'));
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_produks,nama_kategori',
        ], [
            'nama_kategori.unique' => 'Nama kategori ini sudah ada, gunakan nama lain!'
        ]);

        KategoriProduk::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('master-data.kategori-produk.index')
            ->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Memperbarui data kategori yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_produks,nama_kategori,' . $id,
        ], [
            'nama_kategori.unique' => 'Nama kategori ini sudah digunakan oleh data lain!'
        ]);

        $kategori = KategoriProduk::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('master-data.kategori-produk.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Menghapus data kategori.
     */
    public function destroy($id)
    {
        $kategori = KategoriProduk::findOrFail($id);
        $kategori->delete();

        return redirect()->route('master-data.kategori-produk.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}