@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Barang Keluar</h1>
        <button class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#modalKeluar">
            <span class="icon text-white-50">
                <i class="fas fa-minus"></i>
            </span>
            <span class="text">Tambah Barang Keluar</span>
        </button>
    </div>
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

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

    <!-- Tabel Riwayat Transaksi Keluar -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Daftar Transaksi Keluar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat as $r)
                        <tr>
                            <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $r->produk->nama_produk }}</td>
                            <td><span class="badge badge-danger">-{{ $r->jumlah }}</span></td>
                            <td>{{ $r->keterangan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Keluar -->
<div class="modal fade" id="modalKeluar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Form Barang Keluar</h5>
                <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{ route('master-data.transaksi.keluar.store') }}" method="POST">
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
                        <label>Jumlah Keluar</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan / Tujuan</label>
                        <textarea name="keterangan" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Catat Keluar</button>
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
            "order": [[ 0, "desc" ]], 
            "language": {
                "search": "Cari Transaksi:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "paginate": {
                    "next": "Lanjut",
                    "previous": "Kembali"
                }
            }
        });
    });
</script>
@endsection