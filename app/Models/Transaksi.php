<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'transaksis';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'produk_id',
        'jenis',
        'jumlah',
        'keterangan'
    ];

    /**
     * Relasi ke model Produk
     * Satu transaksi dimiliki oleh satu produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}