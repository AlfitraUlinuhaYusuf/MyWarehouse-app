@extends('layouts.admin')

@section('content')

<div class="card shadow mb-4">
    <!-- Header: Judul, Form Cari, dan Tombol Tambah -->
    <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
        
        <div class="d-flex align-items-center mt-2 mt-md-0">
            <!-- Form Cari -->
            <form action="{{ route('master-data.kategori-produk.index') }}" method="GET" class="mr-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small" 
                           placeholder="Cari kategori..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Tombol Tambah (Kategori Baru) -->
            <x-kategori-produk.form-kategori-produk />
        </div>
    </div>

    <div class="card-body">
        <!-- Notifikasi Pencarian -->
        @if(request('search'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Hasil pencarian untuk: <strong>{{ request('search') }}</strong>
                <a href="{{ route('master-data.kategori-produk.index') }}" class="ml-2 text-decoration-none text-info font-weight-bold">
                    <i class="fas fa-times-circle"></i> Reset
                </a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Pesan Error Validasi -->
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

        <!-- Pesan Sukses -->
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
                                <th style="width: 150px">No</th>
                                <th>Nama Kategori</th>
                                <th style="width: 150px" class="text-center">Aksi</th>
                    </tr>
                </thead>
            <tbody>
                @forelse($kategori as $index => $item)
                <tr>
                    <td class="text-center" style="width: 1%">{{ $kategori->firstItem() + $index }}</td>
                    
                    <td>{{ $item->nama_kategori }}</td>
                    
                    <td style="width: 1%; white-space: nowrap;">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="mr-1">
                                <x-kategori-produk.form-kategori-produk :id="$item->id" />
                            </div>

                            <form action="{{ route('master-data.kategori-produk.destroy', $item->id) }}" 
                                method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">
                        Data kategori tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-end">
                {{ $kategori->links() }}
            </div>
        </div>
    </div>
</div>

@endsection