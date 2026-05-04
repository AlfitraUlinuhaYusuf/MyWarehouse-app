<?php

namespace App\View\Components\kategoriProduk;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormKategoriProduk extends Component
{
    /**
     * Create a new component instance.
     */

    public $id, $nama_kategori, $action;
    public function __construct($id = null)
    {
        if ($id) {
            $kategori = \App\Models\kategoriProduk::findOrFail($id);        
            $this->id = $kategori->id;
            $this->nama_kategori = $kategori->nama_kategori;
            $this->action = route('master-data.kategori-produk.update', $id);
        } else {
            $this->id = null;
            $this->nama_kategori = null;
            $this->action = route('master-data.kategori-produk.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.kategori-produk.form-kategori-produk');
    }
}
