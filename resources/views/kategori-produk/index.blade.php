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
                                        <button
                                            type="button"
                                            class="kategori-table-button kategori-edit-button"
                                            data-toggle="modal"
                                            data-target="#formKategori{{ $item->id }}"
                                            title="Edit kategori"
                                        >
                                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M4 20H8.2L18.75 9.45L14.55 5.25L4 15.8V20Z"></path>
                                                <path d="M14.55 5.25L16.5 3.3C16.9 2.9 17.55 2.9 17.95 3.3L20.7 6.05C21.1 6.45 21.1 7.1 20.7 7.5L18.75 9.45"></path>
                                            </svg>
                                        </button>

                                        <form
                                            id="deleteKategori{{ $item->id }}"
                                            action="{{ route('master-data.kategori-produk.destroy', $item->id) }}"
                                            method="POST"
                                            class="kategori-delete-form"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                class="kategori-table-button kategori-delete-button js-delete-trigger"
                                                data-form-id="deleteKategori{{ $item->id }}"
                                                data-name="{{ $item->nama_kategori }}"
                                                title="Hapus kategori"
                                            >
                                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                                    <path d="M5 7H19"></path>
                                                    <path d="M10 11V17"></path>
                                                    <path d="M14 11V17"></path>
                                                    <path d="M8 7L9 4H15L16 7"></path>
                                                    <path d="M7 7L8 20H16L17 7"></path>
                                                </svg>
                                            </button>
                                        </form>
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

                <div class="kategori-pagination">
                    {{ $kategori->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
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

<div class="kategori-confirm-backdrop" id="deleteConfirmModal" aria-hidden="true">
    <div class="kategori-confirm-box">
        <div class="kategori-confirm-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24">
                <path d="M5 7H19"></path>
                <path d="M10 11V17"></path>
                <path d="M14 11V17"></path>
                <path d="M8 7L9 4H15L16 7"></path>
                <path d="M7 7L8 20H16L17 7"></path>
            </svg>
        </div>

        <h3>Hapus Kategori?</h3>
        <p>
            Kategori <strong id="deleteCategoryName">ini</strong> akan dihapus secara permanen.
        </p>

        <div class="kategori-confirm-actions">
            <button type="button" class="kategori-confirm-cancel" id="deleteCancelBtn">
                Batal
            </button>

            <button type="button" class="kategori-confirm-delete" id="deleteConfirmBtn">
                Ya, Hapus
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
        gap: 10px;
    }

    .kategori-delete-form {
        display: inline-flex;
        margin: 0;
        padding: 0;
    }

    .kategori-table-button {
        width: 40px;
        height: 40px;
        border: none;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease;
        color: #ffffff;
    }

    .kategori-table-button svg {
        width: 20px;
        height: 20px;
    }

    .kategori-edit-button {
        background: linear-gradient(135deg, var(--mw-blue), var(--mw-blue-dark));
        box-shadow: 0 10px 18px rgba(76, 148, 255, 0.22);
    }

    .kategori-delete-button {
        background: linear-gradient(135deg, #ef5b54, var(--mw-danger));
        box-shadow: 0 10px 18px rgba(217, 52, 43, 0.20);
    }

    .kategori-table-button:hover {
        transform: translateY(-3px);
        filter: saturate(1.08);
    }

    .kategori-edit-button:hover {
        box-shadow: 0 14px 24px rgba(76, 148, 255, 0.30);
    }

    .kategori-delete-button:hover {
        box-shadow: 0 14px 24px rgba(217, 52, 43, 0.28);
    }

    .kategori-edit-button:hover svg {
        transform: rotate(-8deg) scale(1.04);
    }

    .kategori-delete-button:hover svg {
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

    .kategori-modal-bank .modal {
        z-index: 2050 !important;
        font-family: "Poppins", sans-serif;
    }

    .modal-backdrop {
        z-index: 2040 !important;
        background-color: rgba(17, 24, 13, 0.78) !important;
    }

    .modal-backdrop.show {
        opacity: 0.58 !important;
    }

    .kategori-modal-bank .modal-dialog {
        margin: 6rem auto;
        max-width: 520px;
    }

    .kategori-modal-bank .modal-content {
        border: none;
        border-radius: 22px;
        box-shadow: 0 24px 70px rgba(0, 0, 0, 0.24);
        overflow: hidden;
    }

    .kategori-modal-bank .modal-header {
        border-bottom: 1px solid rgba(79, 116, 56, 0.13);
        padding: 20px 24px;
        background: linear-gradient(135deg, #ffffff 0%, #f4faef 100%);
    }

    .kategori-modal-bank .modal-title {
        color: var(--mw-black);
        font-size: 22px;
        font-weight: 800;
    }

    .kategori-modal-bank .close {
        width: 36px;
        height: 36px;
        border-radius: 999px;
        background: var(--mw-green-soft);
        color: var(--mw-black);
        opacity: 1;
        text-shadow: none;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .kategori-modal-bank .close:hover {
        background: #dfead5;
        transform: rotate(90deg);
    }

    .kategori-modal-bank .modal-body {
        padding: 24px;
        background: #ffffff;
    }

    .kategori-modal-bank .modal-body label {
        color: var(--mw-black);
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .kategori-modal-bank .modal-body .form-control {
        height: 48px;
        border: 1px solid rgba(79, 116, 56, 0.18);
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        box-shadow: none;
        transition: border-color 0.22s ease, box-shadow 0.22s ease;
    }

    .kategori-modal-bank .modal-body .form-control:focus {
        border-color: var(--mw-green);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.14);
    }

    .kategori-modal-bank .modal-footer {
        border-top: none;
        padding: 0 24px 24px;
    }

    .kategori-modal-bank .modal-footer .btn {
        min-width: 96px;
        height: 42px;
        border: none;
        border-radius: 11px;
        font-size: 15px;
        font-weight: 800;
        box-shadow: none;
    }

    .kategori-modal-bank .modal-footer .btn-secondary {
        background: #eeeeee;
        color: #222222;
    }

    .kategori-modal-bank .modal-footer .btn-primary {
        background: var(--mw-green);
        color: #ffffff;
    }

    .kategori-confirm-backdrop {
        position: fixed;
        inset: 0;
        z-index: 3000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 22px;
        background: rgba(17, 24, 13, 0.38);
        backdrop-filter: blur(7px);
    }

    .kategori-confirm-backdrop.show {
        display: flex;
        animation: kategoriBackdropIn 0.24s ease both;
    }

    .kategori-confirm-box {
        width: 100%;
        max-width: 430px;
        border-radius: 24px;
        padding: 30px;
        background: #ffffff;
        box-shadow: 0 24px 70px rgba(0, 0, 0, 0.24);
        text-align: center;
        animation: kategoriConfirmIn 0.28s ease both;
        font-family: "Poppins", sans-serif;
    }

    .kategori-confirm-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 16px;
        border-radius: 999px;
        background: var(--mw-danger-soft);
        color: var(--mw-danger);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .kategori-confirm-icon svg {
        width: 42px;
        height: 42px;
    }

    .kategori-confirm-box h3 {
        margin: 0 0 8px;
        color: var(--mw-black);
        font-size: 24px;
        font-weight: 800;
    }

    .kategori-confirm-box p {
        margin: 0;
        color: var(--mw-muted);
        font-size: 15px;
        font-weight: 600;
        line-height: 1.55;
    }

    .kategori-confirm-box p strong {
        color: var(--mw-black);
    }

    .kategori-confirm-actions {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 24px;
    }

    .kategori-confirm-cancel,
    .kategori-confirm-delete {
        min-width: 120px;
        height: 44px;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 800;
        cursor: pointer;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
        font-family: "Poppins", sans-serif;
    }

    .kategori-confirm-cancel {
        background: #eeeeee;
        color: #222222;
    }

    .kategori-confirm-delete {
        background: var(--mw-danger);
        color: #ffffff;
        box-shadow: 0 10px 20px rgba(217, 52, 43, 0.25);
    }

    .kategori-confirm-cancel:hover,
    .kategori-confirm-delete:hover {
        transform: translateY(-2px);
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
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let selectedDeleteForm = null;

        const modal = document.getElementById('deleteConfirmModal');
        const deleteCategoryName = document.getElementById('deleteCategoryName');
        const cancelBtn = document.getElementById('deleteCancelBtn');
        const confirmBtn = document.getElementById('deleteConfirmBtn');

        document.querySelectorAll('.js-delete-trigger').forEach(function (button) {
            button.addEventListener('click', function () {
                const formId = button.getAttribute('data-form-id');
                const itemName = button.getAttribute('data-name') || 'ini';

                selectedDeleteForm = document.getElementById(formId);

                if (deleteCategoryName) {
                    deleteCategoryName.textContent = itemName;
                }

                if (modal) {
                    modal.classList.add('show');
                    modal.setAttribute('aria-hidden', 'false');
                }
            });
        });

        function closeDeleteModal() {
            if (modal) {
                modal.classList.remove('show');
                modal.setAttribute('aria-hidden', 'true');
            }

            selectedDeleteForm = null;
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', closeDeleteModal);
        }

        if (modal) {
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeDeleteModal();
                }
            });
        }

        if (confirmBtn) {
            confirmBtn.addEventListener('click', function () {
                if (selectedDeleteForm) {
                    selectedDeleteForm.submit();
                }
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal && modal.classList.contains('show')) {
                closeDeleteModal();
            }
        });
    });
</script>
@endpush
