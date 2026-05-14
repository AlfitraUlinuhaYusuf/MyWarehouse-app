@extends('layouts.admin')

@section('content')
@php
    $jumlahTampil = $kategori->count();
    $sedangCari = request('search');

    $dataMulai = method_exists($kategori, 'firstItem') ? ($kategori->firstItem() ?? 0) : ($jumlahTampil > 0 ? 1 : 0);
    $dataAkhir = method_exists($kategori, 'lastItem') ? ($kategori->lastItem() ?? 0) : $jumlahTampil;

    $halamanSekarang = method_exists($kategori, 'currentPage') ? $kategori->currentPage() : 1;
    $totalHalaman = method_exists($kategori, 'lastPage') ? $kategori->lastPage() : 1;

    $totalData = method_exists($kategori, 'total') ? $kategori->total() : $jumlahTampil;
@endphp

<div class="kategori-page">
    <div class="kategori-shell">
        <div class="kategori-header">
            <div class="kategori-title-wrap">
                <span class="kategori-eyebrow">Master Data</span>
                <h1 class="kategori-title">Kategori Barang</h1>
                <p class="kategori-subtitle">
                    Kelola kategori barang agar data persediaan lebih terstruktur, mudah dicari, dan konsisten dengan kebutuhan operasional gudang.
                </p>
            </div>

            <div class="kategori-action-row">
                <div class="kategori-action-label-group">
                    <span class="kategori-action-label">Kategori Baru</span>
                    <span class="kategori-action-helper">Tambah data kategori</span>
                </div>

                <button
                    type="button"
                    class="kategori-add-button"
                    data-toggle="modal"
                    data-target="#formKategoribaru"
                    title="Tambah kategori baru"
                >
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 5V19"></path>
                        <path d="M5 12H19"></path>
                    </svg>
                </button>
            </div>
        </div>

        @if(request('search'))
            <div class="kategori-alert kategori-alert-info">
                <span>
                    Menampilkan hasil pencarian untuk <strong>{{ request('search') }}</strong>.
                </span>
                <a href="{{ route('master-data.kategori-produk.index') }}">Reset pencarian</a>
            </div>
        @endif

        @if ($errors->any())
            <div class="kategori-alert kategori-alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="kategori-alert kategori-alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="kategori-summary">
            <div class="kategori-summary-card kategori-summary-total">
                <div>
                    <div class="kategori-summary-label">Total Kategori</div>
                    <div class="kategori-summary-number">{{ $totalData }}</div>
                    <div class="kategori-summary-caption">Kategori tercatat</div>
                </div>
                <div class="kategori-summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 3L20 7.5L12 12L4 7.5L12 3Z"></path>
                        <path d="M4 12L12 16.5L20 12"></path>
                        <path d="M4 16.5L12 21L20 16.5"></path>
                    </svg>
                </div>
            </div>

            <div class="kategori-summary-card kategori-summary-shown">
                <div>
                    <div class="kategori-summary-label">Data Ditampilkan</div>
                    <div class="kategori-summary-number">{{ $jumlahTampil }}</div>
                    <div class="kategori-summary-caption">Rentang {{ $dataMulai }} - {{ $dataAkhir }}</div>
                </div>
                <div class="kategori-summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M8 6H21"></path>
                        <path d="M8 12H21"></path>
                        <path d="M8 18H21"></path>
                        <path d="M3 6H3.01"></path>
                        <path d="M3 12H3.01"></path>
                        <path d="M3 18H3.01"></path>
                    </svg>
                </div>
            </div>

            <div class="kategori-summary-card kategori-summary-page">
                <div>
                    <div class="kategori-summary-label">Halaman</div>
                    <div class="kategori-summary-number">{{ $halamanSekarang }}/{{ $totalHalaman }}</div>
                    <div class="kategori-summary-caption">Navigasi data kategori</div>
                </div>
                <div class="kategori-summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 5H20"></path>
                        <path d="M4 12H20"></path>
                        <path d="M4 19H14"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="kategori-card">
            <div class="kategori-card-head">
                <div>
                    <h2 class="kategori-section-title">Daftar Kategori Barang</h2>
                    <p class="kategori-section-text">
                        Gunakan pencarian untuk menemukan kategori tertentu, lalu kelola data melalui tombol aksi pada tabel.
                    </p>
                </div>
            </div>

            <div class="kategori-control-row">
                <div class="kategori-entries-control">
                    <span>Status</span>
                    <strong>{{ $sedangCari ? 'Pencarian Aktif' : 'Semua Data' }}</strong>
                </div>

                <form action="{{ route('master-data.kategori-produk.index') }}" method="GET" class="kategori-search">
                    <button type="submit" aria-label="Cari kategori">
                        <svg viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="M16.5 16.5L21 21"></path>
                        </svg>
                    </button>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari kategori..."
                        autocomplete="off"
                    >
                </form>
            </div>

            <div class="kategori-table-wrap">
                <table class="kategori-table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-kategori">NAMA KATEGORI</th>
                            <th class="col-aksi">AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($kategori as $index => $item)
                            <tr class="kategori-row" style="--row-delay: {{ min($index * 45, 360) }}ms;">
                                <td>
                                    <span class="kategori-number-pill">{{ $dataMulai + $index }}</span>
                                </td>

                                <td>
                                    <span class="kategori-name-pill" title="{{ $item->nama_kategori }}">
                                        {{ $item->nama_kategori }}
                                    </span>
                                </td>

                                <td>
                                    <div class="kategori-action-group">
                                        <form
                                            action="{{ route('master-data.kategori-produk.destroy', $item->id) }}"
                                            method="POST"
                                            class="kategori-delete-form"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                class="btn-delete-custom open-delete-modal"
                                                title="Hapus data"
                                                data-category-name="{{ $item->nama_kategori ?? 'kategori ini' }}"
                                            >
                                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                                    <path d="M3 6H21"></path>
                                                    <path d="M8 6V4H16V6"></path>
                                                    <path d="M6 6L7 21H17L18 6"></path>
                                                    <path d="M10 10V17"></path>
                                                    <path d="M14 10V17"></path>
                                                </svg>
                                            </button>
                                        </form>

                                        <button
                                            type="button"
                                            class="kategori-table-button kategori-edit-button"
                                            data-toggle="modal"
                                            data-target="#formKategori{{ $item->id }}"
                                            title="Edit data"
                                        >
                                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M12 20H21"></path>
                                                <path d="M16.5 3.5A2.12 2.12 0 0 1 19.5 6.5L7 19L3 20L4 16Z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="kategori-empty">
                                    <div class="kategori-empty-box">
                                        <div class="kategori-empty-icon" aria-hidden="true">
                                            <svg viewBox="0 0 24 24">
                                                <circle cx="11" cy="11" r="7"></circle>
                                                <path d="M16.5 16.5L21 21"></path>
                                            </svg>
                                        </div>
                                        <strong>Data kategori tidak ditemukan</strong>
                                        <span>Coba gunakan kata kunci lain atau tambah kategori baru.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="kategori-footer">
                <div class="kategori-info-text">
                    Showing {{ $dataMulai }} to {{ $dataAkhir }} out of {{ $totalData }} entries
                </div>

                @if(method_exists($kategori, 'onEachSide'))
                    <div class="kategori-pagination">
                        {{ $kategori->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="kategori-modal-bank">
    <x-kategori-produk.form-kategori-produk />

    @foreach($kategori as $item)
        <x-kategori-produk.form-kategori-produk :id="$item->id" />
    @endforeach
</div>

<div class="delete-modal-overlay" id="deleteModal" aria-hidden="true">
    <div class="delete-modal-box">
        <div class="delete-modal-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24">
                <path d="M3 6H21"></path>
                <path d="M8 6V4H16V6"></path>
                <path d="M6 6L7 21H17L18 6"></path>
                <path d="M10 10V17"></path>
                <path d="M14 10V17"></path>
            </svg>
        </div>

        <h2 class="delete-modal-title">Hapus Kategori?</h2>

        <p class="delete-modal-text">
            Data <strong id="deleteCategoryName">kategori ini</strong> akan dihapus secara permanen.
            Tindakan ini tidak dapat dibatalkan.
        </p>

        <div class="delete-modal-actions">
            <button type="button" class="delete-cancel-btn" id="cancelDeleteBtn">
                Batal
            </button>

            <button type="button" class="delete-confirm-btn" id="confirmDeleteBtn">
                Hapus
            </button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    :root {
        --mw-green: #8fb36b;
        --mw-green-dark: #6f9651;
        --mw-green-deep: #4f7438;
        --mw-green-soft: #eef7e8;
        --mw-green-pale: #f8fcf5;
        --mw-black: #050704;
        --mw-white: #ffffff;
        --mw-muted: #6d7567;
        --mw-border: rgba(79, 116, 56, 0.16);
        --mw-shadow: 0 18px 42px rgba(90, 123, 64, 0.14);
        --mw-shadow-soft: 0 12px 28px rgba(90, 123, 64, 0.10);
        --mw-danger: #d9342b;
        --mw-danger-soft: #fff0ee;
        --mw-blue: #4c94ff;
        --mw-blue-dark: #397feb;
        --mw-warning: #f4b23e;
        --mw-warning-soft: #fff8e8;
    }

    .kategori-page {
        width: 100%;
        min-height: calc(100vh - 72px);
        padding: 42px 46px 82px;
        font-family: "Poppins", sans-serif;
        color: var(--mw-black);
        background:
            radial-gradient(circle at 8% 14%, rgba(143, 179, 107, 0.15), transparent 28%),
            radial-gradient(circle at 92% 72%, rgba(143, 179, 107, 0.12), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #fbfdf9 100%);
        overflow: hidden;
        position: relative;
        animation: kategoriFadeIn 0.52s ease both;
    }

    .kategori-page::before,
    .kategori-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        background: rgba(143, 179, 107, 0.10);
        filter: blur(1px);
        pointer-events: none;
        animation: kategoriFloat 6s ease-in-out infinite;
    }

    .kategori-page::before {
        width: 145px;
        height: 145px;
        right: 52px;
        top: 108px;
    }

    .kategori-page::after {
        width: 92px;
        height: 92px;
        left: 38px;
        bottom: 74px;
        animation-delay: 1.2s;
    }

    .kategori-shell {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
    }

    .kategori-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 28px;
        margin-bottom: 24px;
        animation: kategoriSlideUp 0.58s ease both;
    }

    .kategori-title-wrap {
        max-width: 660px;
    }

    .kategori-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(143, 179, 107, 0.14);
        color: var(--mw-green-deep);
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.2px;
    }

    .kategori-eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--mw-green);
        box-shadow: 0 0 0 5px rgba(143, 179, 107, 0.16);
        animation: kategoriDotPulse 2s ease-in-out infinite;
    }

    .kategori-title {
        margin: 0;
        color: var(--mw-black);
        font-size: clamp(26px, 3vw, 38px);
        font-weight: 800;
        line-height: 1.14;
        letter-spacing: -0.8px;
    }

    .kategori-subtitle {
        max-width: 610px;
        margin: 12px 0 0;
        color: var(--mw-muted);
        font-size: 15px;
        font-weight: 500;
        line-height: 1.72;
    }

    .kategori-action-row {
        min-width: 250px;
        padding: 14px;
        border: 1px solid var(--mw-border);
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.82);
        box-shadow: var(--mw-shadow-soft);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .kategori-action-label-group {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .kategori-action-label {
        font-size: 14px;
        font-weight: 800;
        color: var(--mw-black);
        line-height: 1.1;
    }

    .kategori-action-helper {
        font-size: 12px;
        font-weight: 600;
        color: var(--mw-muted);
        line-height: 1.25;
    }

    .kategori-add-button {
        width: 48px;
        height: 48px;
        border: none;
        border-radius: 17px;
        background: linear-gradient(135deg, var(--mw-green), var(--mw-green-dark));
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.24s ease, box-shadow 0.24s ease, filter 0.24s ease;
        position: relative;
        isolation: isolate;
        flex-shrink: 0;
        box-shadow: 0 13px 24px rgba(143, 179, 107, 0.30);
    }

    .kategori-add-button::after {
        content: "";
        position: absolute;
        inset: -6px;
        border-radius: 22px;
        border: 2px solid rgba(143, 179, 107, 0.24);
        animation: kategoriPulse 2.4s ease-in-out infinite;
        z-index: -1;
    }

    .kategori-add-button:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 18px 34px rgba(143, 179, 107, 0.36);
        filter: saturate(1.06);
    }

    .kategori-add-button svg,
    .kategori-table-button svg,
    .kategori-confirm-icon svg,
    .kategori-summary-icon svg,
    .kategori-search svg,
    .kategori-empty-icon svg {
        fill: none;
        stroke: currentColor;
        stroke-width: 2.25;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .kategori-add-button svg {
        width: 26px;
        height: 26px;
    }

    .kategori-alert {
        margin: 0 0 22px;
        padding: 14px 16px;
        border-radius: 18px;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 10px 24px rgba(93, 66, 10, 0.08);
        animation: kategoriSlideUp 0.5s ease both;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .kategori-alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .kategori-alert a {
        color: inherit;
        text-decoration: none;
        font-weight: 900;
        white-space: nowrap;
    }

    .kategori-alert-info {
        background: #eef7ff;
        border: 1px solid #b9daf8;
        color: #1c5c87;
    }

    .kategori-alert-danger {
        background: var(--mw-danger-soft);
        border: 1px solid rgba(217, 52, 43, 0.22);
        color: #a52620;
    }

    .kategori-alert-success {
        background: #e7f7df;
        border: 1px solid rgba(47, 125, 50, 0.22);
        color: #2f7d32;
    }

    .kategori-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
        animation: kategoriSlideUp 0.58s ease both;
        animation-delay: 0.08s;
    }

    .kategori-summary-card {
        min-height: 116px;
        border-radius: 24px;
        border: 1px solid var(--mw-border);
        background: rgba(255, 255, 255, 0.90);
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        box-shadow: var(--mw-shadow-soft);
        transition: transform 0.24s ease, box-shadow 0.24s ease, border-color 0.24s ease;
        overflow: hidden;
        position: relative;
    }

    .kategori-summary-card::before {
        content: "";
        position: absolute;
        top: -48%;
        left: -45%;
        width: 52%;
        height: 190%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.58), transparent);
        animation: kategoriShine 5s ease-in-out infinite;
        pointer-events: none;
    }

    .kategori-summary-card::after {
        content: "";
        position: absolute;
        width: 112px;
        height: 112px;
        right: -36px;
        bottom: -42px;
        border-radius: 50%;
        background: rgba(143, 179, 107, 0.10);
    }

    .kategori-summary-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--mw-shadow);
        border-color: rgba(143, 179, 107, 0.34);
    }

    .kategori-summary-label,
    .kategori-summary-number,
    .kategori-summary-caption,
    .kategori-summary-icon {
        position: relative;
        z-index: 1;
    }

    .kategori-summary-label {
        margin-bottom: 7px;
        font-size: 14px;
        font-weight: 700;
        color: var(--mw-muted);
    }

    .kategori-summary-number {
        color: var(--mw-black);
        font-size: 34px;
        font-weight: 800;
        line-height: 1;
        letter-spacing: -0.6px;
    }

    .kategori-summary-caption {
        margin-top: 8px;
        color: #839077;
        font-size: 12px;
        font-weight: 600;
    }

    .kategori-summary-icon {
        width: 56px;
        height: 56px;
        border-radius: 19px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: transform 0.24s ease;
        background: var(--mw-green-soft);
        color: var(--mw-green-deep);
    }

    .kategori-summary-card:hover .kategori-summary-icon {
        transform: translateY(-2px) rotate(-4deg) scale(1.04);
    }

    .kategori-summary-icon svg {
        width: 28px;
        height: 28px;
    }

    .kategori-summary-shown .kategori-summary-icon {
        background: #e7f7df;
        color: #2f7d32;
    }

    .kategori-summary-page .kategori-summary-icon {
        background: #f6faf2;
        color: var(--mw-green-dark);
    }

    .kategori-card {
        width: 100%;
        border: 1px solid var(--mw-border);
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.92);
        padding: 22px;
        box-shadow: var(--mw-shadow);
        backdrop-filter: blur(10px);
        animation: kategoriSlideUp 0.6s ease both;
        animation-delay: 0.15s;
        position: relative;
        overflow: hidden;
    }

    .kategori-card::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 5px;
        background: linear-gradient(90deg, var(--mw-green), rgba(143, 179, 107, 0.25), var(--mw-green-dark));
    }

    .kategori-card-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
        padding-top: 6px;
    }

    .kategori-section-title {
        margin: 0;
        font-size: 20px;
        font-weight: 800;
        color: var(--mw-black);
        letter-spacing: -0.2px;
    }

    .kategori-section-text {
        margin: 7px 0 0;
        color: var(--mw-muted);
        font-size: 13px;
        font-weight: 600;
        line-height: 1.55;
    }

    .kategori-control-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 18px;
    }

    .kategori-entries-control {
        min-height: 48px;
        padding: 7px 12px;
        border: 1px solid rgba(79, 116, 56, 0.18);
        border-radius: 18px;
        background: var(--mw-green-pale);
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 13px;
        font-weight: 700;
        color: var(--mw-muted);
        white-space: nowrap;
    }

    .kategori-entries-control strong {
        min-height: 34px;
        padding: 0 12px;
        border: 1px solid rgba(79, 116, 56, 0.20);
        border-radius: 12px;
        background: #ffffff;
        color: var(--mw-black);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 800;
    }

    .kategori-search {
        width: min(100%, 340px);
        height: 50px;
        border: 1px solid rgba(79, 116, 56, 0.18);
        border-radius: 999px;
        display: flex;
        align-items: center;
        padding: 0 18px;
        background: #ffffff;
        box-shadow: 0 10px 20px rgba(90, 123, 64, 0.06);
        transition: border-color 0.22s ease, box-shadow 0.22s ease, transform 0.22s ease;
        margin: 0;
    }

    .kategori-search:focus-within {
        border-color: var(--mw-green);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.15), 0 14px 28px rgba(90, 123, 64, 0.11);
        transform: translateY(-2px);
    }

    .kategori-search button {
        width: 24px;
        height: 24px;
        border: none;
        padding: 0;
        margin: 0 10px 0 0;
        background: transparent;
        color: var(--mw-green-dark);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
    }

    .kategori-search svg {
        width: 20px;
        height: 20px;
        stroke-width: 2.6;
    }

    .kategori-search input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: var(--mw-black);
    }

    .kategori-search input::placeholder {
        color: #92a187;
    }

    .kategori-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid rgba(79, 116, 56, 0.14);
        border-radius: 22px;
        background: #ffffff;
        box-shadow: 0 12px 28px rgba(90, 123, 64, 0.08);
    }

    .kategori-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: fixed;
        font-family: "Poppins", sans-serif;
        color: var(--mw-black);
        overflow: hidden;
    }

    .kategori-table th {
        height: 58px;
        background: linear-gradient(180deg, #f1f6ed, #e9f2e4);
        border-bottom: 1px solid rgba(79, 116, 56, 0.15);
        text-align: center;
        vertical-align: middle;
        color: #385a25;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.45px;
        white-space: nowrap;
    }

    .kategori-table th:not(:last-child),
    .kategori-table td:not(:last-child) {
        border-right: 1px solid rgba(79, 116, 56, 0.10);
    }

    .kategori-table td {
        height: 64px;
        border-bottom: 1px solid rgba(79, 116, 56, 0.10);
        text-align: center;
        vertical-align: middle;
        font-size: 14px;
        font-weight: 600;
        color: var(--mw-black);
        background: rgba(255, 255, 255, 0.94);
        transition: background 0.22s ease;
        padding: 0 16px;
    }

    .kategori-table tbody tr:last-child td {
        border-bottom: none;
    }

    .kategori-row {
        animation: kategoriRowIn 0.38s ease both;
        animation-delay: var(--row-delay);
    }

    .kategori-table tbody .kategori-row:hover td {
        background: #fbfef8;
    }

    .col-no {
        width: 10%;
    }

    .col-kategori {
        width: 66%;
    }

    .col-aksi {
        width: 24%;
    }

    .kategori-number-pill {
        min-width: 38px;
        height: 34px;
        padding: 0 12px;
        border-radius: 999px;
        background: #f6faf2;
        border: 1px solid rgba(79, 116, 56, 0.14);
        color: #53634a;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 800;
    }

    .kategori-name-pill {
        max-width: 100%;
        min-height: 34px;
        padding: 7px 14px;
        border-radius: 999px;
        background: #f6faf2;
        border: 1px solid rgba(79, 116, 56, 0.14);
        color: #2d421f;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 800;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
        box-shadow: 0 8px 18px rgba(47, 125, 50, 0.06);
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .kategori-name-pill::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--mw-green);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.12);
        animation: kategoriDotPulse 1.8s ease-in-out infinite;
        flex-shrink: 0;
    }

    .kategori-row:hover .kategori-name-pill {
        transform: translateY(-2px);
        box-shadow: 0 10px 18px rgba(47, 125, 50, 0.12);
    }

    .kategori-action-group {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
    }

    .kategori-delete-form {
        margin: 0;
        padding: 0;
        display: inline-flex;
    }

    .btn-delete-custom,
    .kategori-table-button,
    .kategori-edit-button {
        width: 40px !important;
        height: 40px !important;
        min-width: 40px !important;
        border: none !important;
        border-radius: 14px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        padding: 0 !important;
        margin: 0 !important;
        box-shadow: none !important;
        outline: none !important;
        font-size: 0 !important;
        line-height: 1 !important;
        transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease !important;
    }

    .btn-delete-custom {
        background: var(--mw-danger-soft) !important;
        color: var(--mw-danger) !important;
        border: 1px solid rgba(217, 52, 43, 0.20) !important;
    }

    .kategori-edit-button {
        background: #e8f0ff !important;
        color: var(--mw-blue-dark) !important;
        border: 1px solid rgba(76, 148, 255, 0.22) !important;
    }

    .btn-delete-custom:hover,
    .kategori-edit-button:hover {
        transform: translateY(-2px) !important;
        filter: saturate(1.05) !important;
    }

    .btn-delete-custom:hover {
        box-shadow: 0 10px 18px rgba(217, 52, 43, 0.13) !important;
    }

    .kategori-edit-button:hover {
        box-shadow: 0 10px 18px rgba(76, 148, 255, 0.14) !important;
    }

    .btn-delete-custom svg,
    .kategori-edit-button svg {
        width: 20px !important;
        height: 20px !important;
        stroke: currentColor !important;
        stroke-width: 2.35 !important;
        fill: none !important;
        stroke-linecap: round !important;
        stroke-linejoin: round !important;
        transition: transform 0.22s ease !important;
    }

    .kategori-edit-button:hover svg {
        transform: rotate(-6deg) scale(1.04);
    }

    .btn-delete-custom:hover svg {
        animation: kategoriShake 0.42s ease;
    }

    .kategori-empty {
        height: 136px !important;
        padding: 28px !important;
        color: var(--mw-muted) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        line-height: 1.7;
        background: #fbfef8 !important;
    }

    .kategori-empty-box {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 7px;
    }

    .kategori-empty-icon {
        width: 58px;
        height: 58px;
        border-radius: 999px;
        background: var(--mw-green-soft);
        color: var(--mw-green-deep);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .kategori-empty-icon svg {
        width: 30px;
        height: 30px;
    }

    .kategori-empty-box strong {
        color: var(--mw-black);
        font-size: 16px;
        font-weight: 800;
    }

    .kategori-empty-box span {
        color: var(--mw-muted);
        font-size: 13px;
        font-weight: 600;
    }

    .kategori-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-top: 18px;
        font-size: 13px;
        font-weight: 700;
        color: var(--mw-muted);
    }

    .kategori-info-text {
        font-size: 13px;
        font-weight: 700;
        color: var(--mw-muted);
    }

    .kategori-pagination {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .kategori-pagination nav,
    .kategori-pagination .pagination {
        margin: 0;
    }

    .kategori-pagination .pagination {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .kategori-pagination .page-item {
        margin: 0;
    }

    .kategori-pagination .page-link {
        min-width: 38px;
        min-height: 38px;
        border: 1px solid rgba(79, 116, 56, 0.16);
        border-radius: 999px !important;
        background: #ffffff;
        color: var(--mw-green-deep);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 13px;
        font-family: "Poppins", sans-serif;
        font-size: 13px;
        font-weight: 800;
        line-height: 1;
        box-shadow: none;
        transition: transform 0.22s ease, box-shadow 0.22s ease, background 0.22s ease, opacity 0.22s ease;
    }

    .kategori-pagination .page-link:hover {
        background: var(--mw-green-soft);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(90, 123, 64, 0.12);
    }

    .kategori-pagination .page-item.active .page-link {
        border-color: rgba(143, 179, 107, 0.52);
        background: var(--mw-green);
        color: #ffffff;
        box-shadow: 0 10px 18px rgba(143, 179, 107, 0.24);
    }

    .kategori-pagination .page-item.disabled .page-link {
        opacity: 0.46;
        cursor: not-allowed;
    }

    .kategori-modal-bank > div > button {
        display: none !important;
    }

    /* Modal tambah/edit kategori dibuat serasi dengan halaman daftar barang */
    body.modal-open .kategori-page {
        overflow: visible !important;
    }

    .modal-backdrop.show {
        opacity: 0.38 !important;
    }

    .modal {
        z-index: 5050 !important;
        overflow-x: hidden !important;
        overflow-y: auto !important;
        padding-right: 0 !important;
    }

    .modal-backdrop {
        z-index: 5040 !important;
    }

    .modal.show .modal-dialog {
        transform: none !important;
    }

    .modal-dialog.modal-lg,
    .modal-dialog {
        width: min(860px, calc(100vw - 36px)) !important;
        max-width: min(860px, calc(100vw - 36px)) !important;
        margin: 54px auto !important;
        pointer-events: auto !important;
    }

    .modal-content {
        border: none !important;
        border-radius: 22px !important;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.22) !important;
        overflow: hidden !important;
        font-family: "Poppins", system-ui, sans-serif !important;
        animation: modalPop 0.25s ease both !important;
    }

    .modal-header {
        min-height: 74px;
        background: linear-gradient(135deg, var(--mw-green) 0%, #9bc67a 100%) !important;
        border-bottom: none !important;
        padding: 22px 26px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }

    .modal-title {
        color: var(--mw-black) !important;
        font-family: inherit !important;
        font-size: 24px !important;
        font-weight: 800 !important;
        margin: 0 !important;
    }

    .modal-header .close,
    .modal-header .btn-close {
        width: 38px !important;
        height: 38px !important;
        min-width: 38px !important;
        border: none !important;
        border-radius: 50% !important;
        background: #ffe4e4 !important;
        color: var(--mw-danger) !important;
        opacity: 1 !important;
        padding: 0 !important;
        margin: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: none !important;
        text-shadow: none !important;
        font-size: 0 !important;
        line-height: 1 !important;
        transition: transform 0.22s ease, background 0.22s ease !important;
    }

    .modal-header .close::before,
    .modal-header .btn-close::before {
        content: "×";
        font-family: inherit;
        font-size: 30px;
        font-weight: 800;
        color: var(--mw-danger);
        line-height: 1;
        margin-top: -3px;
    }

    .modal-header .close span,
    .modal-header .close i,
    .modal-header .close::after,
    .modal-header .btn-close::after {
        display: none !important;
    }

    .modal-header .close:hover,
    .modal-header .btn-close:hover {
        background: #ffd2d2 !important;
        transform: rotate(90deg) !important;
    }

    .modal form {
        display: block !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #ffffff !important;
    }

    .modal-body {
        background: #ffffff !important;
        width: 100% !important;
        max-height: calc(100vh - 220px) !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        padding: 26px 28px 14px !important;
    }

    .modal-body::-webkit-scrollbar {
        width: 9px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #f1f5ed;
        border-radius: 999px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: #b9cfa8;
        border-radius: 999px;
        border: 2px solid #f1f5ed;
    }

    .modal-body .row {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        gap: 18px !important;
        margin: 0 0 18px 0 !important;
        width: 100% !important;
    }

    .modal-body .row:last-child {
        margin-bottom: 0 !important;
    }

    .modal-body .col-md-6,
    .modal-body .col-md-12,
    .modal-body [class*="col-"] {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        flex: none !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .modal .form-group {
        width: 100% !important;
        margin: 0 0 18px 0 !important;
    }

    .modal-body .row .form-group {
        margin-bottom: 0 !important;
    }

    .modal-body label,
    .modal .form-group label {
        font-family: inherit !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        color: var(--mw-black) !important;
        margin-bottom: 8px !important;
    }

    .modal .form-control,
    .modal .form-control-file,
    .modal select,
    .modal input[type="text"],
    .modal input[type="number"],
    .modal input[type="file"],
    .modal textarea {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        min-height: 44px !important;
        border: 1px solid rgba(79, 116, 56, 0.20) !important;
        border-radius: 12px !important;
        box-shadow: none !important;
        font-family: inherit !important;
        font-size: 15px !important;
        font-weight: 600 !important;
        color: var(--mw-black) !important;
        padding: 9px 12px !important;
        background: #ffffff !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .modal select.form-control {
        appearance: auto !important;
    }

    .modal .form-control:focus,
    .modal select:focus,
    .modal input:focus,
    .modal textarea:focus {
        border-color: var(--mw-green) !important;
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.15) !important;
        outline: none !important;
    }

    .modal .text-muted,
    .modal small {
        font-family: inherit !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: var(--mw-muted) !important;
    }

    .modal-footer {
        position: relative !important;
        z-index: 2 !important;
        border-top: none !important;
        background: #ffffff !important;
        padding: 16px 28px 28px !important;
        display: flex !important;
        justify-content: flex-end !important;
        align-items: center !important;
        gap: 12px !important;
    }

    .modal-footer .btn::before,
    .modal-footer .btn::after,
    .modal-footer button::before,
    .modal-footer button::after {
        display: none !important;
        content: none !important;
    }

    .modal-footer .btn,
    .modal-footer button {
        min-width: 118px !important;
        height: 43px !important;
        border: none !important;
        border-radius: 14px !important;
        font-family: inherit !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        box-shadow: none !important;
        padding: 0 18px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        line-height: 1 !important;
        transition: transform 0.22s ease, filter 0.22s ease !important;
    }

    .modal-footer .btn:hover,
    .modal-footer button:hover {
        transform: translateY(-1px) !important;
        filter: brightness(0.98) !important;
    }

    .modal-footer .btn-secondary,
    .modal-footer .btn-light,
    .modal-footer button[data-dismiss="modal"],
    .modal-footer button[data-bs-dismiss="modal"] {
        background: #eeeeee !important;
        color: var(--mw-black) !important;
    }

    .modal-footer .btn-primary,
    .modal-footer .btn-success,
    .modal-footer button[type="submit"] {
        background: var(--mw-green) !important;
        color: #ffffff !important;
    }

    .modal .invalid-feedback,
    .modal .text-danger {
        font-family: inherit !important;
        font-size: 13px !important;
        font-weight: 700 !important;
    }

    /* Delete popup */
    .delete-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.38);
        backdrop-filter: blur(5px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 5000;
        padding: 20px;
    }

    .delete-modal-overlay.show {
        display: flex;
        animation: fadeIn 0.2s ease both;
    }

    .delete-modal-box {
        width: 100%;
        max-width: 430px;
        background: #ffffff;
        border-radius: 22px;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.22);
        padding: 30px 30px 25px;
        font-family: "Poppins", sans-serif;
        text-align: center;
        animation: modalPop 0.25s ease both;
    }

    .delete-modal-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 17px;
        border-radius: 50%;
        background: var(--mw-danger-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulseDanger 1.65s ease-in-out infinite;
    }

    .delete-modal-icon svg {
        width: 39px;
        height: 39px;
        stroke: var(--mw-danger);
        stroke-width: 2.4;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .delete-modal-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--mw-black);
        margin-bottom: 8px;
    }

    .delete-modal-text {
        font-size: 15px;
        font-weight: 500;
        color: var(--mw-muted);
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .delete-modal-text strong {
        color: var(--mw-black);
        font-weight: 800;
    }

    .delete-modal-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .delete-cancel-btn,
    .delete-confirm-btn {
        min-width: 122px;
        height: 42px;
        border: none;
        border-radius: 12px;
        font-family: inherit;
        font-size: 15px;
        font-weight: 800;
        cursor: pointer;
        transition: transform 0.22s ease, filter 0.22s ease;
    }

    .delete-cancel-btn:hover,
    .delete-confirm-btn:hover {
        transform: translateY(-1px);
        filter: brightness(0.98);
    }

    .delete-cancel-btn {
        background: #eeeeee;
        color: var(--mw-black);
    }

    .delete-confirm-btn {
        background: var(--mw-danger);
        color: #ffffff;
    }

    @keyframes modalPop {
        from { opacity: 0; transform: scale(0.96) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes pulseDanger {
        0%, 100% { box-shadow: 0 0 0 0 rgba(217, 52, 43, 0.22); }
        50% { box-shadow: 0 0 0 12px rgba(217, 52, 43, 0); }
    }

    @keyframes kategoriFadeIn {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes kategoriFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-12px); }
    }

    @keyframes kategoriSlideUp {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes kategoriShine {
        0%, 58% { transform: translateX(-120%) rotate(14deg); }
        100% { transform: translateX(120%) rotate(14deg); }
    }

    @keyframes kategoriPulse {
        0% { opacity: 0.55; transform: scale(0.94); }
        70%, 100% { opacity: 0; transform: scale(1.18); }
    }

    @keyframes kategoriDotPulse {
        0%, 100% { opacity: 0.72; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.25); }
    }

    @keyframes kategoriRowIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes kategoriShake {
        0%, 100% { transform: rotate(0); }
        25% { transform: rotate(-8deg); }
        50% { transform: rotate(8deg); }
        75% { transform: rotate(-5deg); }
    }

    @keyframes kategoriBackdropIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes kategoriConfirmIn {
        from { opacity: 0; transform: translateY(18px) scale(0.96); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation: none !important;
            transition: none !important;
        }
    }

    @media (max-width: 1050px) {
        .kategori-page {
            padding: 34px 24px 68px;
        }

        .kategori-header {
            flex-direction: column;
        }

        .kategori-action-row {
            width: 100%;
            max-width: 420px;
        }

        .kategori-summary {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 760px) {
        .kategori-page {
            padding: 28px 16px 56px;
        }

        .kategori-card {
            padding: 18px 14px;
            border-radius: 22px;
        }

        .kategori-card-head,
        .kategori-control-row,
        .kategori-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .kategori-search,
        .kategori-entries-control {
            width: 100%;
        }

        .kategori-table {
            min-width: 760px;
        }

        .kategori-pagination {
            justify-content: flex-start;
            overflow-x: auto;
            padding-bottom: 4px;
        }

        .kategori-alert {
            flex-direction: column;
            align-items: flex-start;
        }

        .modal-dialog.modal-lg,
        .modal-dialog {
            width: calc(100vw - 24px) !important;
            max-width: calc(100vw - 24px) !important;
            margin: 28px auto !important;
        }

        .modal-body {
            max-height: calc(100vh - 185px) !important;
            padding: 20px 18px 10px !important;
        }

        .modal-body .row {
            grid-template-columns: 1fr !important;
            gap: 14px !important;
        }

        .modal-header {
            min-height: 66px !important;
            padding: 18px 20px !important;
        }

        .modal-title {
            font-size: 20px !important;
        }

        .modal-footer {
            padding: 14px 18px 22px !important;
            flex-direction: column-reverse !important;
        }

        .modal-footer .btn,
        .modal-footer button,
        .delete-cancel-btn,
        .delete-confirm-btn {
            width: 100% !important;
        }

        .delete-modal-actions {
            flex-direction: column;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.kategori-modal-bank .modal').forEach(function (modal) {
            if (modal.parentElement !== document.body) {
                document.body.appendChild(modal);
            }
        });

        const deleteModal = document.getElementById('deleteModal');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const deleteCategoryName = document.getElementById('deleteCategoryName');
        let selectedDeleteForm = null;

        document.querySelectorAll('.open-delete-modal').forEach(function (button) {
            button.addEventListener('click', function () {
                selectedDeleteForm = button.closest('form');
                const categoryName = button.getAttribute('data-category-name') || 'kategori ini';

                if (deleteCategoryName) {
                    deleteCategoryName.textContent = categoryName;
                }

                if (deleteModal) {
                    deleteModal.classList.add('show');
                    deleteModal.setAttribute('aria-hidden', 'false');
                }
            });
        });

        function closeDeleteModal() {
            selectedDeleteForm = null;

            if (deleteModal) {
                deleteModal.classList.remove('show');
                deleteModal.setAttribute('aria-hidden', 'true');
            }
        }

        if (cancelDeleteBtn) {
            cancelDeleteBtn.addEventListener('click', closeDeleteModal);
        }

        if (deleteModal) {
            deleteModal.addEventListener('click', function (event) {
                if (event.target === deleteModal) {
                    closeDeleteModal();
                }
            });
        }

        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', function () {
                if (selectedDeleteForm) {
                    selectedDeleteForm.submit();
                }
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && deleteModal && deleteModal.classList.contains('show')) {
                closeDeleteModal();
            }
        });

        function cleanCategoryModalButtons() {
            document.querySelectorAll('.modal-footer button, .modal-footer .btn').forEach(function (button) {
                const text = button.textContent.trim().toLowerCase();

                if (text.includes('simpan')) {
                    button.textContent = 'Simpan';
                }

                if (text.includes('batal')) {
                    button.textContent = 'Batal';
                }
            });

            document.querySelectorAll('.modal-header .close, .modal-header .btn-close').forEach(function (button) {
                button.setAttribute('aria-label', 'Tutup popup');
            });
        }

        cleanCategoryModalButtons();

        document.addEventListener('click', function () {
            setTimeout(cleanCategoryModalButtons, 120);
        });

        if (window.jQuery) {
            window.jQuery('.modal').on('shown.bs.modal', function () {
                cleanCategoryModalButtons();
            });
        }

        document.addEventListener('shown.bs.modal', function () {
            cleanCategoryModalButtons();
        });
    });
</script>
@endpush
