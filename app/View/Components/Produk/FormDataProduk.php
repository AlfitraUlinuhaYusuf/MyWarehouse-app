<?php

namespace App\View\Components\Produk;

use Illuminate\View\Component;
use App\Models\KategoriProduk;
use App\Models\Produk;

class FormDataProduk extends Component
{
    public $id;
    public $kategoris;
    public $produk;
    public $action;

    public function __construct($id = null)
    {
        $this->id = $id;
        // Mengambil semua kategori untuk pilihan dropdown
        $this->kategoris = KategoriProduk::all();

        if ($id) {
            // Mode Edit: Ambil data produk berdasarkan ID
            $this->produk = Produk::find($id);
            $this->action = route('master-data.produk.update', $id);
        } else {
            // Mode Tambah: Produk kosong
            $this->produk = null;
            $this->action = route('master-data.produk.store');
        }
    }

    public function render()
    {
        return view('components.produk.form-data-produk');
    }
}