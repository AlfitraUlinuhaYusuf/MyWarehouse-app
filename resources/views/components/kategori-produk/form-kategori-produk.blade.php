<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-round {{ isset($id) && $id ? 'btn-primary btn-icon' : 'btn-dark' }}" data-toggle="modal" data-target="#formKategori{{ $id ?? 'baru' }}">
        @if (isset($id) && $id)
            <i class="fas fa-edit"></i>
        @else
            <span> Kategori Baru </span>
        @endif
    </button>

    <!-- Modal -->
    <div class="modal fade" id="formKategori{{ $id ?? 'baru' }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formKategoriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formKategoriLabel">
                        {{ isset($id) && $id ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tambahkan Form Input di Sini -->
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        @if(isset($id) && $id)
                            @method('PUT')
                        @endif
                        
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $nama_kategori ?? '' }}" required>
                        </div>
                        
                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>