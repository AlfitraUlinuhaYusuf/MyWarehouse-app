@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Transaksi Bulanan</h1>
        <a href="{{ route('laporan.pdf') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Cetak PDF
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->created_at->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge {{ $row->jenis == 'masuk' ? 'badge-success' : 'badge-danger' }}">
                                    {{ ucfirst($row->jenis) }}
                                </span>
                            </td>
                            <td>{{ $row->produk->nama_produk }}</td>
                            <td>{{ $row->jumlah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection