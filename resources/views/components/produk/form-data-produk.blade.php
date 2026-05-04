<div>
    <!-- Tombol Pemicu Modal -->
    <button type="button" class="btn btn-sm {{ $id ? 'btn-warning' : 'btn-primary' }}" data-toggle="modal" data-target="#formProduk{{ $id ?? 'baru' }}">
        @if ($id)
            <i class="fas fa-edit"></i>
        @else
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Produk
        @endif
    </button>

    <!-- Modal -->
    <div class="modal fade" id="formProduk{{ $id ?? 'baru' }}" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $id ? 'Edit Produk' : 'Tambah Produk Baru' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if($id)
                        @method('PUT')
                    @endif

                    <div class="modal-body text-left">
                        <div class="row">
                            <!-- Kategori Produk ID -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Kategori Produk</label>
                                    <select name="kategori_produk_id" class="form-control" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategoris as $kat)
                                            <option value="{{ $kat->id }}" {{ (isset($produk) && $produk->kategori_produk_id == $kat->id) ? 'selected' : '' }}>
                                                {{ $kat->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Nama Produk -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nama Produk</label>
                                    <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk ?? '' }}" placeholder="Masukkan nama barang" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Harga -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Harga (Rp)</label>
                                    <input type="number" name="harga" class="form-control" value="{{ $produk->harga ?? '' }}" placeholder="Contoh: 50000" required>
                                </div>
                            </div>
                            <!-- Stok -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Stok Barang</label>
                                    <input type="number" name="stok" class="form-control" value="{{ $produk->stok ?? '0' }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group">
                            <label class="font-weight-bold">Deskripsi Produk</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Tambahkan keterangan produk...">{{ $produk->deskripsi ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>