<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'Daftar Produk';
        $query = Produk::with('kategori'); // Mengambil data produk beserta kategorinya

        if ($request->has('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        $produk = $query->latest()->paginate(10)->withQueryString();
        
        // Ambil semua kategori untuk dropdown di modal tambah/edit
        $kategoris = \App\Models\KategoriProduk::all();

        return view('produk.index', compact('pageTitle', 'produk', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_produk_id' => 'required|exists:kategori_produks,id',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        Produk::create($request->all());

        return redirect()->route('master-data.produk.index')->with('success', 'Produk berhasil ditambah!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_produk_id' => 'required|exists:kategori_produks,id',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('master-data.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();
        return redirect()->route('master-data.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
