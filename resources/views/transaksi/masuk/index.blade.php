@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Barang Masuk</h1>
        <button class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#modalMasuk">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Barang Masuk</span>
        </button>
    </div>

    <!-- Filter Tanggal -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <label for="start_date" class="mr-2">Dari:</label>
                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="form-control form-control-sm">
                </div>
                <div class="form-group mr-2">
                    <label for="end_date" class="mr-2">Sampai:</label>
                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="form-control form-control-sm">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-filter fa-sm"></i> Filter
                </button>
                <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm ml-2">Reset</a>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                       <tr>
                            <th>No</th>
                            <th class="text-center">ID</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $r->id }}</td>
                            <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $r->produk->nama_produk }}</td>
                            <td><span class="badge badge-success">+{{ $r->jumlah }}</span></td>
                            <td>{{ $r->keterangan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Masuk -->
<div class="modal fade" id="modalMasuk" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Barang Masuk</h5>
                <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{ route('master-data.transaksi.masuk.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Produk</label>
                        <select name="produk_id" class="form-control" required>
                            @foreach($produks as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_produk }} (Stok: {{ $p->stok }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [[ 0, "desc" ]], // Urutkan kolom pertama (tanggal) secara descending
            "language": {
                "search": "Cari Transaksi:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Lanjut",
                    "previous": "Kembali"
                }
            }
        });
    });
</script>
@endsection