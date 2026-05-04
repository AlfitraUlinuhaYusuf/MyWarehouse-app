@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <!-- Header: Judul, Cari, dan Tambah -->
    <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
        
        <div class="d-flex align-items-center mt-2 mt-md-0">
            <!-- Form Cari Produk -->
            <form action="{{ route('master-data.produk.index') }}" method="GET" class="mr-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small" 
                           placeholder="Cari produk..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Komponen Tambah Produk (Gunakan ini saja, tidak perlu button manual) -->
            <x-produk.form-data-produk />
        </div>
    </div>

    <div class="card-body">
        <!-- Notifikasi Error -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="50px" class="text-center">No</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th class="text-center">Stok</th>
                        <th>Harga</th>
                        <th width="150px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $index => $item)
                    <tr>
                        <td class="text-center">{{ $produk->firstItem() + $index }}</td>
                        <td><span class="badge badge-info">{{ $item->kategori->nama_kategori }}</span></td>
                        <td>{{ $item->nama_produk }}</td>
                        <td class="text-center">{{ $item->stok }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <!-- Komponen Edit Produk (Mempassing ID) -->
                                <x-produk.form-data-produk :id="$item->id" />

                                <!-- Tombol Hapus -->
                                <form action="{{ route('master-data.produk.destroy', $item->id) }}" method="POST" class="ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Data produk tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-end">
                {{ $produk->links() }}
            </div>
        </div>
    </div>
</div>
@endsection