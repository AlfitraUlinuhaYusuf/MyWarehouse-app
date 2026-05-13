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
    $modeTampilan = $sedangCari ? 'Pencarian' : 'Semua Data';
@endphp

<div class="kategori-page">
    <div class="kategori-bg kategori-bg-1"></div>
    <div class="kategori-bg kategori-bg-2"></div>
    <div class="kategori-bg kategori-bg-3"></div>

    <section class="kategori-hero">
        <div class="kategori-hero-left">
            <div class="kategori-badge">
                <span></span>
                Master Data
            </div>

            <h1>{{ strtoupper($pageTitle ?? 'Kategori Produk') }}</h1>

            <p>
                Kelola kategori produk agar data barang lebih rapi, mudah dicari,
                dan siap digunakan untuk transaksi gudang.
            </p>
        </div>

        <div class="kategori-info-grid">
            <div class="kategori-info-card">
                <div class="info-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M4 7H20" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"/>
                        <path d="M4 12H20" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"/>
                        <path d="M4 17H14" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"/>
                    </svg>
                </div>
                <span>Data Ditampilkan</span>
                <strong>{{ $dataMulai }} - {{ $dataAkhir }}</strong>
            </div>

            <div class="kategori-info-card">
                <div class="info-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M8 3H16" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"/>
                        <path d="M7 21H17" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"/>
                        <path d="M12 7V17" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"/>
                        <path d="M8 11L12 7L16 11" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span>Halaman</span>
                <strong>{{ $halamanSekarang }} / {{ $totalHalaman }}</strong>
            </div>

            <div class="kategori-info-card">
                <div class="info-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M5 12L10 17L20 7" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span>Mode Tampilan</span>
                <strong>{{ $modeTampilan }}</strong>
            </div>
        </div>
    </section>

    <section class="kategori-panel">
        <div class="kategori-toolbar">
            <form action="{{ route('master-data.kategori-produk.index') }}" method="GET" class="kategori-search">
                <button type="submit" class="kategori-search-icon" aria-label="Cari kategori">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2.5"></circle>
                        <path d="M16.3 16.3L21 21" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"></path>
                    </svg>
                </button>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search"
                    autocomplete="off"
                >
            </form>

            <div class="kategori-add">
                <span>Kategori Baru :</span>

                <button
                    type="button"
                    class="kategori-add-trigger"
                    data-toggle="modal"
                    data-target="#formKategoribaru"
                    title="Tambah kategori baru"
                >
                    +
                </button>
            </div>
        </div>

        @if(request('search'))
            <div class="kategori-alert kategori-alert-info">
                <div>
                    Menampilkan hasil pencarian untuk:
                    <strong>{{ request('search') }}</strong>
                </div>

                <a href="{{ route('master-data.kategori-produk.index') }}">Reset Pencarian</a>
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

        <div class="kategori-table-card">
            <div class="kategori-table-header">
                <div>
                    <h2>Daftar Kategori</h2>
                    <p>Total data kategori saat ini: {{ $totalData }}</p>
                </div>

                <div class="kategori-status-pill">
                    <span></span>
                    Aktif
                </div>
            </div>

            <div class="kategori-table-wrapper">
                <table class="kategori-table">
                    <thead>
                        <tr>
                            <th class="kategori-no">NO</th>
                            <th>Nama Barang</th>
                            <th class="kategori-action-title">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($kategori as $index => $item)
                            <tr style="--delay: {{ min($index * 65, 520) }}ms;">
                                <td class="kategori-number">
                                    {{ $dataMulai + $index }}
                                </td>

                                <td class="kategori-name">
                                    <span>{{ $item->nama_kategori }}</span>
                                </td>

                                <td class="kategori-action-cell">
                                    <div class="kategori-action-group">
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
                                                class="kategori-btn-delete js-delete-trigger"
                                                data-form-id="deleteKategori{{ $item->id }}"
                                                data-name="{{ $item->nama_kategori }}"
                                                title="Hapus kategori"
                                            >
                                                <svg viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 7H19" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                                                    <path d="M10 11V17" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                                                    <path d="M14 11V17" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                                                    <path d="M8 7L9 4H15L16 7" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M7 7L8 20H16L17 7" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                        </form>

                                        <button
                                            type="button"
                                            class="kategori-btn-edit"
                                            data-toggle="modal"
                                            data-target="#formKategori{{ $item->id }}"
                                            title="Edit kategori"
                                        >
                                            <svg viewBox="0 0 24 24" fill="none">
                                                <path d="M4 20H8.2L18.75 9.45L14.55 5.25L4 15.8V20Z" stroke="currentColor" stroke-width="2.2" stroke-linejoin="round"/>
                                                <path d="M14.55 5.25L16.5 3.3C16.9 2.9 17.55 2.9 17.95 3.3L20.7 6.05C21.1 6.45 21.1 7.1 20.7 7.5L18.75 9.45" stroke="currentColor" stroke-width="2.2" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="kategori-empty">
                                    <div class="kategori-empty-box">
                                        <div class="kategori-empty-icon">
                                            <svg viewBox="0 0 24 24" fill="none">
                                                <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2.2"/>
                                                <path d="M16.3 16.3L21 21" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
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
                <div class="kategori-info">
                    Showing {{ $jumlahTampil }} out of {{ $totalData }} entries
                </div>

                <div class="kategori-pagination">
                    {{ $kategori->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
</div>

<div class="kategori-modal-bank">
    <x-kategori-produk.form-kategori-produk />

    @foreach($kategori as $item)
        <x-kategori-produk.form-kategori-produk :id="$item->id" />
    @endforeach
</div>

<div class="kategori-confirm-backdrop" id="deleteConfirmModal" aria-hidden="true">
    <div class="kategori-confirm-box">
        <div class="kategori-confirm-icon">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M5 7H19" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                <path d="M10 11V17" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                <path d="M14 11V17" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                <path d="M8 7L9 4H15L16 7" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M7 7L8 20H16L17 7" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
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
    .kategori-page {
        position: relative;
        width: 100%;
        min-height: calc(100vh - 72px);
        overflow: hidden;
        padding: 34px 34px 44px;
        background:
            radial-gradient(circle at 93% 12%, rgba(164, 250, 149, 0.28), transparent 28%),
            radial-gradient(circle at 4% 84%, rgba(143, 179, 107, 0.18), transparent 22%),
            linear-gradient(180deg, #ffffff 0%, #fbfdf9 100%);
        font-family: "Poppins", sans-serif;
        color: #111111;
    }

    .kategori-bg {
        position: absolute;
        border-radius: 999px;
        pointer-events: none;
        filter: blur(4px);
        opacity: 0.32;
        z-index: 1;
        animation: kategoriFloat 8s ease-in-out infinite;
    }

    .kategori-bg-1 {
        width: 260px;
        height: 260px;
        top: 100px;
        right: -90px;
        background: #a4fa95;
    }

    .kategori-bg-2 {
        width: 170px;
        height: 170px;
        left: -70px;
        bottom: 80px;
        background: #8fb36b;
        animation-delay: 1.4s;
    }

    .kategori-bg-3 {
        width: 95px;
        height: 95px;
        right: 33%;
        top: 170px;
        background: rgba(143, 179, 107, 0.25);
        animation-delay: 2.2s;
    }

    .kategori-hero,
    .kategori-panel {
        position: relative;
        z-index: 2;
    }

    .kategori-hero {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 28px;
        margin-bottom: 30px;
        animation: kategoriFadeUp 0.55s ease both;
    }

    .kategori-hero-left {
        max-width: 680px;
    }

    .kategori-badge {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 7px;
        color: #4f7236;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    .kategori-badge span {
        width: 34px;
        height: 3px;
        border-radius: 999px;
        background: #6f9652;
        display: inline-block;
    }

    .kategori-hero h1 {
        margin: 0;
        color: #050505;
        font-size: 39px;
        font-weight: 700;
        line-height: 1.15;
        letter-spacing: 0.2px;
    }

    .kategori-hero p {
        max-width: 590px;
        margin: 11px 0 0;
        color: #6a6a6a;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.7;
    }

    .kategori-info-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(128px, 1fr));
        gap: 14px;
    }

    .kategori-info-card {
        position: relative;
        overflow: hidden;
        min-width: 138px;
        padding: 15px 16px 16px;
        border: 1px solid rgba(143, 179, 107, 0.26);
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.72);
        box-shadow: 0 16px 34px rgba(41, 57, 29, 0.08);
        backdrop-filter: blur(12px);
        transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
    }

    .kategori-info-card::after {
        content: "";
        position: absolute;
        inset: auto -20px -45px auto;
        width: 92px;
        height: 92px;
        border-radius: 999px;
        background: rgba(164, 250, 149, 0.24);
        transition: transform 0.28s ease;
    }

    .kategori-info-card:hover {
        transform: translateY(-6px);
        border-color: rgba(143, 179, 107, 0.52);
        box-shadow: 0 22px 50px rgba(41, 57, 29, 0.14);
    }

    .kategori-info-card:hover::after {
        transform: scale(1.18);
    }

    .info-icon {
        width: 36px;
        height: 36px;
        margin-bottom: 10px;
        border-radius: 12px;
        background: #eff7e9;
        color: #5f823f;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .info-icon svg {
        width: 22px;
        height: 22px;
    }

    .kategori-info-card span {
        display: block;
        color: #69775c;
        font-size: 12px;
        font-weight: 600;
        line-height: 1;
        margin-bottom: 8px;
    }

    .kategori-info-card strong {
        position: relative;
        z-index: 2;
        display: block;
        color: #121212;
        font-size: 22px;
        font-weight: 800;
        line-height: 1.1;
        white-space: nowrap;
    }

    .kategori-panel {
        animation: kategoriFadeUp 0.65s ease both;
    }

    .kategori-toolbar {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 30px;
        width: 100%;
        margin-bottom: 26px;
        padding: 17px 22px;
        border: 1px solid rgba(143, 179, 107, 0.2);
        border-radius: 26px;
        background: rgba(255, 255, 255, 0.76);
        box-shadow: 0 18px 45px rgba(24, 45, 18, 0.08);
        backdrop-filter: blur(14px);
    }

    .kategori-search {
        position: relative;
        width: 329px;
        height: 54px;
        margin: 0;
    }

    .kategori-search input {
        width: 100%;
        height: 100%;
        border: 1.5px solid #a6a6a6;
        border-radius: 999px;
        outline: none;
        padding: 0 20px 0 72px;
        background: #ffffff;
        color: #303030;
        font-size: 30px;
        font-weight: 400;
        line-height: 1;
        transition: border-color 0.24s ease, box-shadow 0.24s ease, transform 0.24s ease;
    }

    .kategori-search input::placeholder {
        color: #555555;
        opacity: 0.9;
    }

    .kategori-search input:focus {
        border-color: #7ca65d;
        box-shadow: 0 0 0 5px rgba(143, 179, 107, 0.15);
        transform: translateY(-1px);
    }

    .kategori-search-icon {
        position: absolute;
        left: 23px;
        top: 50%;
        z-index: 2;
        width: 34px;
        height: 34px;
        border: none;
        padding: 0;
        background: transparent;
        color: #222222;
        transform: translateY(-50%);
        cursor: pointer;
        transition: transform 0.25s ease, color 0.25s ease;
    }

    .kategori-search-icon:hover {
        color: #638d43;
        transform: translateY(-50%) scale(1.1) rotate(-5deg);
    }

    .kategori-search-icon svg {
        width: 100%;
        height: 100%;
        display: block;
    }

    .kategori-add {
        display: flex;
        align-items: center;
        gap: 13px;
        color: #000000;
        font-size: 24px;
        font-weight: 600;
        line-height: 1;
        white-space: nowrap;
    }

    .kategori-add-trigger {
        position: relative;
        width: 95px;
        height: 38px;
        overflow: hidden;
        border: none;
        border-radius: 11px;
        padding: 0 0 5px;
        background: linear-gradient(135deg, #a4fa95 0%, #8eef7a 100%);
        color: #111111;
        box-shadow: 0 9px 20px rgba(111, 194, 87, 0.27);
        font-size: 48px;
        font-weight: 400;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.24s ease, box-shadow 0.24s ease, filter 0.24s ease;
    }

    .kategori-add-trigger::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.55), transparent);
        transform: translateX(-130%);
        transition: transform 0.65s ease;
    }

    .kategori-add-trigger:hover {
        transform: translateY(-3px);
        filter: brightness(1.02);
        box-shadow: 0 15px 30px rgba(111, 194, 87, 0.38);
    }

    .kategori-add-trigger:hover::after {
        transform: translateX(130%);
    }

    .kategori-alert {
        width: 100%;
        margin-bottom: 18px;
        padding: 14px 18px;
        border-radius: 16px;
        font-size: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        animation: kategoriAlertIn 0.35s ease both;
    }

    .kategori-alert ul {
        margin: 0;
        padding-left: 18px;
    }

    .kategori-alert a {
        color: inherit;
        font-weight: 700;
        text-decoration: underline;
    }

    .kategori-alert-info {
        background: #eef7ff;
        border: 1px solid #b9daf8;
        color: #1c5c87;
    }

    .kategori-alert-danger {
        background: #fff0f0;
        border: 1px solid #ffb9b9;
        color: #9d1c1c;
    }

    .kategori-alert-success {
        background: #ecfff0;
        border: 1px solid #afe6bb;
        color: #237437;
    }

    .kategori-table-card {
        overflow: hidden;
        border: 1px solid rgba(210, 218, 204, 0.9);
        border-radius: 26px;
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 24px 60px rgba(35, 52, 25, 0.11);
        backdrop-filter: blur(12px);
    }

    .kategori-table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 20px 24px;
        border-bottom: 1px solid rgba(210, 218, 204, 0.78);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(244, 250, 239, 0.82));
    }

    .kategori-table-header h2 {
        margin: 0;
        color: #111111;
        font-size: 20px;
        font-weight: 800;
    }

    .kategori-table-header p {
        margin: 5px 0 0;
        color: #6b6b6b;
        font-size: 14px;
    }

    .kategori-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border-radius: 999px;
        background: #eff8e9;
        border: 1px solid rgba(143, 179, 107, 0.28);
        color: #4f7236;
        font-size: 13px;
        font-weight: 800;
    }

    .kategori-status-pill span {
        position: relative;
        width: 9px;
        height: 9px;
        border-radius: 999px;
        background: #5fa340;
    }

    .kategori-status-pill span::after {
        content: "";
        position: absolute;
        inset: -5px;
        border-radius: 999px;
        background: rgba(95, 163, 64, 0.22);
        animation: kategoriPulse 1.8s ease-in-out infinite;
    }

    .kategori-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .kategori-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        background: #ffffff;
        color: #000000;
    }

    .kategori-table th {
        height: 60px;
        border: 1px solid #dddddd;
        background: linear-gradient(180deg, #f5f5f5 0%, #ececec 100%);
        color: #111111;
        font-size: 23px;
        font-weight: 600;
        line-height: 1;
        vertical-align: middle;
        padding: 0 21px;
    }

    .kategori-table td {
        height: 64px;
        border: 1px solid #e5e5e5;
        background: rgba(255, 255, 255, 0.96);
        color: #111111;
        font-size: 23px;
        font-weight: 400;
        line-height: 1;
        vertical-align: middle;
        padding: 0 21px;
    }

    .kategori-table tbody tr {
        animation: kategoriRowIn 0.46s ease both;
        animation-delay: var(--delay);
        transition: box-shadow 0.22s ease, transform 0.22s ease;
    }

    .kategori-table tbody tr:hover {
        transform: translateY(-1px);
        box-shadow: 0 11px 25px rgba(52, 77, 36, 0.08);
    }

    .kategori-table tbody tr:hover td {
        background: #fbfff8;
    }

    .kategori-no {
        width: 145px;
        text-align: center;
    }

    .kategori-action-title {
        width: 342px;
        text-align: center;
    }

    .kategori-number {
        text-align: center;
        font-weight: 500 !important;
    }

    .kategori-name {
        text-align: left;
    }

    .kategori-name span {
        display: inline-flex;
        align-items: center;
        gap: 11px;
    }

    .kategori-name span::before {
        content: "";
        width: 9px;
        height: 9px;
        border-radius: 999px;
        background: #8fb36b;
        box-shadow: 0 0 0 5px rgba(143, 179, 107, 0.14);
        opacity: 0;
        transform: scale(0.5);
        transition: opacity 0.22s ease, transform 0.22s ease;
    }

    .kategori-table tbody tr:hover .kategori-name span::before {
        opacity: 1;
        transform: scale(1);
    }

    .kategori-action-cell {
        padding: 0 !important;
        text-align: center;
    }

    .kategori-action-group {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 19px;
    }

    .kategori-delete-form {
        margin: 0;
        padding: 0;
        line-height: 0;
    }

    .kategori-btn-delete,
    .kategori-btn-edit {
        width: 95px;
        height: 38px;
        border: none;
        border-radius: 11px;
        padding: 0;
        margin: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease;
    }

    .kategori-btn-delete {
        background: linear-gradient(135deg, #ff5b5e 0%, #ff4649 100%);
        color: #111111;
        box-shadow: 0 8px 18px rgba(255, 79, 82, 0.24);
    }

    .kategori-btn-edit {
        background: linear-gradient(135deg, #6d9bff 0%, #5f8bf0 100%);
        color: #111111;
        box-shadow: 0 8px 18px rgba(102, 147, 248, 0.25);
    }

    .kategori-btn-delete svg,
    .kategori-btn-edit svg {
        width: 29px;
        height: 29px;
        display: block;
        transition: transform 0.24s ease;
    }

    .kategori-btn-delete:hover,
    .kategori-btn-edit:hover {
        transform: translateY(-3px);
        filter: brightness(1.03);
    }

    .kategori-btn-delete:hover {
        box-shadow: 0 14px 25px rgba(255, 79, 82, 0.35);
    }

    .kategori-btn-edit:hover {
        box-shadow: 0 14px 25px rgba(102, 147, 248, 0.36);
    }

    .kategori-btn-delete:hover svg {
        animation: kategoriShake 0.42s ease;
    }

    .kategori-btn-edit:hover svg {
        transform: rotate(-8deg) scale(1.08);
    }

    .kategori-btn-delete:focus,
    .kategori-btn-edit:focus,
    .kategori-add-trigger:focus {
        outline: none;
        box-shadow: 0 0 0 5px rgba(143, 179, 107, 0.18);
    }

    .kategori-empty {
        height: 160px !important;
        text-align: center;
        color: #777777 !important;
    }

    .kategori-empty-box {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 7px;
        padding: 24px;
    }

    .kategori-empty-icon {
        width: 58px;
        height: 58px;
        border-radius: 999px;
        background: #f0f7ea;
        color: #6d8f52;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .kategori-empty-icon svg {
        width: 30px;
        height: 30px;
    }

    .kategori-empty-box strong {
        color: #2d2d2d;
        font-size: 19px;
        font-weight: 800;
    }

    .kategori-empty-box span {
        color: #777777;
        font-size: 14px;
    }

    .kategori-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        padding: 18px 24px;
        background: rgba(255, 255, 255, 0.78);
    }

    .kategori-info {
        color: #000000;
        font-size: 18px;
        font-weight: 500;
        line-height: 1;
    }

    .kategori-pagination {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .kategori-pagination nav {
        margin: 0;
    }

    .kategori-pagination .pagination {
        margin: 0;
        align-items: center;
    }

    .kategori-pagination .page-item {
        margin: 0 2px;
    }

    .kategori-pagination .page-link {
        border: none;
        border-radius: 10px;
        background: transparent;
        color: #000000;
        font-size: 20px;
        font-weight: 500;
        padding: 8px 10px;
        line-height: 1;
        box-shadow: none;
        transition: background 0.22s ease, transform 0.22s ease;
    }

    .kategori-pagination .page-link:hover {
        background: #edf6e7;
        transform: translateY(-2px);
    }

    .kategori-pagination .page-item.active .page-link {
        border: 1px solid #9e9e9e;
        background: #e8e8e8;
        color: #000000;
        padding: 10px 12px;
    }

    .kategori-pagination .page-item.disabled .page-link {
        color: #000000;
        opacity: 0.55;
    }

    .kategori-modal-bank > div > button {
        display: none !important;
    }

    .kategori-modal-bank .modal {
        z-index: 2050 !important;
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
        font-family: "Poppins", sans-serif;
        overflow: hidden;
    }

    .kategori-modal-bank .modal-header {
        border-bottom: 1px solid #eeeeee;
        padding: 20px 24px;
        background: linear-gradient(135deg, #ffffff 0%, #f4faef 100%);
    }

    .kategori-modal-bank .modal-title {
        color: #111111;
        font-size: 22px;
        font-weight: 800;
    }

    .kategori-modal-bank .close {
        width: 36px;
        height: 36px;
        border-radius: 999px;
        background: #eef4e9;
        color: #111111;
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
        color: #111111;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .kategori-modal-bank .modal-body .form-control {
        height: 48px;
        border: 1px solid #d6d6d6;
        border-radius: 12px;
        font-size: 15px;
        box-shadow: none;
        transition: border-color 0.22s ease, box-shadow 0.22s ease;
    }

    .kategori-modal-bank .modal-body .form-control:focus {
        border-color: #8fb36b;
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.14);
    }

    .kategori-modal-bank .modal-footer {
        border-top: none;
        padding-top: 10px;
    }

    .kategori-modal-bank .modal-footer .btn {
        min-width: 96px;
        height: 42px;
        border: none;
        border-radius: 11px;
        font-size: 15px;
        font-weight: 700;
        box-shadow: none;
    }

    .kategori-modal-bank .modal-footer .btn-secondary {
        background: #eeeeee;
        color: #222222;
    }

    .kategori-modal-bank .modal-footer .btn-primary {
        background: #8fb36b;
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
    }

    .kategori-confirm-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 16px;
        border-radius: 999px;
        background: #fff0f0;
        color: #ff4f52;
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
        color: #111111;
        font-size: 24px;
        font-weight: 800;
    }

    .kategori-confirm-box p {
        margin: 0;
        color: #666666;
        font-size: 15px;
        line-height: 1.55;
    }

    .kategori-confirm-box p strong {
        color: #111111;
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
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .kategori-confirm-cancel {
        background: #eeeeee;
        color: #222222;
    }

    .kategori-confirm-delete {
        background: #ff4f52;
        color: #ffffff;
        box-shadow: 0 10px 20px rgba(255, 79, 82, 0.25);
    }

    .kategori-confirm-cancel:hover,
    .kategori-confirm-delete:hover {
        transform: translateY(-2px);
    }

    @keyframes kategoriFadeUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes kategoriAlertIn {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes kategoriRowIn {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes kategoriFloat {
        0%, 100% {
            transform: translate3d(0, 0, 0) scale(1);
        }

        50% {
            transform: translate3d(18px, -14px, 0) scale(1.06);
        }
    }

    @keyframes kategoriPulse {
        0% {
            opacity: 0.65;
            transform: scale(0.75);
        }

        70% {
            opacity: 0;
            transform: scale(1.55);
        }

        100% {
            opacity: 0;
            transform: scale(1.55);
        }
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
        from {
            opacity: 0;
            transform: translateY(18px) scale(0.96);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @media (max-width: 1200px) {
        .kategori-hero {
            flex-direction: column;
        }

        .kategori-info-grid {
            width: 100%;
        }

        .kategori-toolbar {
            justify-content: space-between;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 768px) {
        .kategori-page {
            padding: 28px 18px 36px;
        }

        .kategori-hero h1 {
            font-size: 30px;
        }

        .kategori-info-grid {
            grid-template-columns: 1fr;
        }

        .kategori-toolbar {
            align-items: flex-start;
            gap: 18px;
            padding: 16px;
        }

        .kategori-search {
            width: 100%;
        }

        .kategori-search input {
            font-size: 22px;
        }

        .kategori-add {
            font-size: 18px;
        }

        .kategori-table-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .kategori-table th,
        .kategori-table td {
            font-size: 17px;
        }

        .kategori-no {
            width: 80px;
        }

        .kategori-action-title {
            width: 210px;
        }

        .kategori-btn-delete,
        .kategori-btn-edit {
            width: 72px;
            height: 36px;
        }

        .kategori-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 14px;
        }

        .kategori-info {
            font-size: 16px;
        }

        .kategori-pagination .page-link {
            font-size: 18px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.001ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.001ms !important;
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