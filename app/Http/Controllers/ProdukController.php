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
        $pageTitle = 'Daftar Barang';

        $search = $request->input('search');
        $stockFilter = $request->input('stock_filter', 'semua');
        $perPage = (int) $request->input('per_page', 5);

        if (!in_array($perPage, [5, 10, 25, 50])) {
            $perPage = 5;
        }

        $query = Produk::with('kategori');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', '%' . $search . '%')
                    ->orWhere('harga', 'like', '%' . $search . '%')
                    ->orWhere('stok', 'like', '%' . $search . '%')
                    ->orWhereHas('kategori', function ($kategoriQuery) use ($search) {
                        $kategoriQuery->where('nama_kategori', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($stockFilter === 'habis') {
            $query->where('stok', 0);
        } elseif ($stockFilter === 'rendah') {
            $query->whereBetween('stok', [1, 5]);
        } elseif ($stockFilter === 'tersedia') {
            $query->where('stok', '>', 5);
        }

        $produk = $query
            ->latest()
            ->paginate($perPage)
            ->appends($request->query());

        $kategoris = KategoriProduk::orderBy('nama_kategori', 'asc')->get();

        return view('produk.index', compact('pageTitle', 'produk', 'kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_produk_id' => 'required|exists:kategori_produks,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk-images', 'public');
        }

        Produk::create($data);

        return redirect()
            ->route('master-data.produk.index')
            ->with('success', 'Produk berhasil ditambah.');
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $data = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_produk_id' => 'required|exists:kategori_produks,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('produk-images', 'public');
        }

        $produk->update($data);

        return redirect()
            ->route('master-data.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()
            ->route('master-data.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}