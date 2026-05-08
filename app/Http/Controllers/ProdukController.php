<?php

namespace App\Http\Controllers;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
        $data = $request->validate([
            'nama_produk' => 'required',
            'kategori_produk_id' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
        ]);

        // LOGIKA SIMPAN GAMBAR
        if ($request->hasFile('gambar')) {
            // Ini yang akan otomatis membuat folder 'produk-images'
            $data['gambar'] = $request->file('gambar')->store('produk-images', 'public');
        }

        Produk::create($data);

        return redirect()->route('master-data.produk.index')->with('success', 'Produk berhasil ditambah');
    }
   public function update(Request $request, $id)
{
    $request->validate([
        'nama_produk' => 'required',
        'kategori_produk_id' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $produk = Produk::findOrFail($id);
    $data = $request->all();

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada untuk menghemat storage
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }
        
        // Simpan gambar baru dan ambil path-nya
        $data['gambar'] = $request->file('gambar')->store('produk-images', 'public');
    }

    $produk->update($data);

    return redirect()->route('master-data.produk.index')->with('success', 'Produk berhasil diperbarui!');
}

    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();
        return redirect()->route('master-data.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
