@extends('layouts.admin')

@section('content')
<style>
    .masuk-page {
        width: 100%;
        min-height: calc(100vh - 72px);
        background: #ffffff;
        padding: 42px 40px 70px;
        font-family: "Poppins", sans-serif;
        color: #000000;
        animation: pageFadeIn 0.45s ease;
    }

    @keyframes pageFadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .masuk-title {
        margin: 0 0 30px;
        font-size: 30px;
        font-weight: 600;
        letter-spacing: 0.2px;
        text-transform: uppercase;
        color: #000000;
    }

    .masuk-panel {
        width: 100%;
        background: #ffffff;
        border-radius: 18px;
        padding: 22px 0 18px;
        animation: panelSlideUp 0.5s ease;
    }

    @keyframes panelSlideUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .top-action-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 28px;
        margin-bottom: 28px;
    }

    .filter-block {
        flex: 1;
        min-width: 0;
    }

    .date-label {
        display: block;
        margin: 0 0 14px 12px;
        font-size: 18px;
        font-weight: 400;
        color: #000000;
    }

    .filter-form {
        display: grid;
        grid-template-columns: minmax(260px, 1fr) minmax(260px, 1fr) 118px 118px;
        align-items: center;
        gap: 18px;
        width: 100%;
    }

    .date-input-wrap {
        position: relative;
        width: 100%;
    }

    .date-input {
        width: 100%;
        height: 50px;
        border: none;
        border-radius: 11px;
        background: #eeeeee;
        color: #6f6f6f;
        font-family: "Poppins", sans-serif;
        font-size: 24px;
        font-weight: 400;
        padding: 0 54px 0 18px;
        outline: none;
        transition: 0.22s ease;
    }

    .date-input:focus {
        background: #f5f5f5;
        box-shadow: 0 0 0 3px rgba(143, 179, 107, 0.23);
    }

    .date-input::-webkit-calendar-picker-indicator {
        opacity: 0;
        cursor: pointer;
    }

    .calendar-icon {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        width: 25px;
        height: 25px;
        pointer-events: none;
    }

    .calendar-icon svg {
        width: 25px;
        height: 25px;
        stroke: #1f1f1f;
        stroke-width: 2;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .filter-btn,
    .refresh-btn {
        width: 118px;
        height: 50px;
        border: none;
        border-radius: 11px;
        font-family: "Poppins", sans-serif;
        font-size: 20px;
        font-weight: 500;
        color: #ffffff;
        cursor: pointer;
        transition: 0.22s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .filter-btn {
        background: #405565;
    }

    .filter-btn:hover {
        background: #344755;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(64, 85, 101, 0.18);
    }

    .refresh-btn {
        background: #5a9829;
    }

    .refresh-btn:hover {
        background: #4d8522;
        color: #ffffff;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(90, 152, 41, 0.18);
    }

    .add-area {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 34px;
        white-space: nowrap;
        min-width: 360px;
    }

    .add-label {
        font-size: 23px;
        font-weight: 400;
        color: #000000;
    }

    .add-btn {
        width: 88px;
        height: 35px;
        border: none;
        border-radius: 8px;
        background: #9dff8f;
        color: #000000;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        transition: 0.22s ease;
        overflow: visible;
    }

    .add-btn::after {
        content: "";
        position: absolute;
        inset: -5px;
        border-radius: 11px;
        border: 2px solid rgba(157, 255, 143, 0.55);
        animation: addPulse 2.2s ease-in-out infinite;
    }

    @keyframes addPulse {
        0% {
            opacity: 0.55;
            transform: scale(0.96);
        }

        60% {
            opacity: 0;
            transform: scale(1.12);
        }

        100% {
            opacity: 0;
            transform: scale(1.12);
        }
    }

    .add-btn:hover {
        background: #8cf27e;
        transform: translateY(-2px);
        box-shadow: 0 8px 14px rgba(157, 255, 143, 0.35);
    }

    .add-btn span {
        font-size: 40px;
        font-weight: 600;
        line-height: 1;
        margin-top: -5px;
        position: relative;
        z-index: 1;
    }

    .table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 10px;
    }

    .entries-control {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 20px;
        font-weight: 400;
        color: #000000;
    }

    .entries-control select {
        width: 72px;
        height: 38px;
        border: 1px solid #c4c4c4;
        background: #eeeeee;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        color: #000000;
        padding: 0 8px;
        outline: none;
    }

    .search-box {
        width: 300px;
        height: 48px;
        border: 1px solid #9f9f9f;
        border-radius: 999px;
        display: flex;
        align-items: center;
        padding: 0 18px;
        background: #ffffff;
        transition: 0.22s ease;
    }

    .search-box:focus-within {
        border-color: #8fb36b;
        box-shadow: 0 0 0 3px rgba(143, 179, 107, 0.2);
    }

    .search-box svg {
        width: 27px;
        height: 27px;
        margin-right: 14px;
        stroke: #000000;
        stroke-width: 2.7;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
    }

    .search-box input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        font-family: "Poppins", sans-serif;
        font-size: 28px;
        font-weight: 400;
        color: #000000;
        line-height: 1;
    }

    .search-box input::placeholder {
        color: #5f5f5f;
    }

    .masuk-table-wrap {
        width: 100%;
        overflow-x: auto;
        border-radius: 10px;
    }

    .masuk-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        font-family: "Poppins", sans-serif;
        color: #000000;
    }

    .masuk-table th {
        height: 50px;
        background: #eeeeee;
        border: 1px solid #d4d4d4;
        text-align: center;
        vertical-align: middle;
        font-size: 19px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .masuk-table td {
        height: 52px;
        border: 1px solid #dcdcdc;
        text-align: center;
        vertical-align: middle;
        font-size: 17px;
        font-weight: 400;
        color: #000000;
        background: #ffffff;
    }

    .masuk-row {
        animation: rowFade 0.35s ease both;
        transition: 0.2s ease;
    }

    .masuk-row:nth-child(1) { animation-delay: 0.03s; }
    .masuk-row:nth-child(2) { animation-delay: 0.06s; }
    .masuk-row:nth-child(3) { animation-delay: 0.09s; }
    .masuk-row:nth-child(4) { animation-delay: 0.12s; }
    .masuk-row:nth-child(5) { animation-delay: 0.15s; }

    @keyframes rowFade {
        from {
            opacity: 0;
            transform: translateY(5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .masuk-table tbody tr:hover td {
        background: #f8fbf5;
    }

    .col-no {
        width: 8%;
    }

    .col-kategori {
        width: 17%;
    }

    .col-tanggal {
        width: 17%;
    }

    .col-barang {
        width: 22%;
    }

    .col-jumlah {
        width: 15%;
    }

    .col-keterangan {
        width: 21%;
    }

    .category-badge {
        min-width: 98px;
        min-height: 30px;
        border-radius: 999px;
        padding: 5px 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eef5e8;
        border: 1px solid rgba(143, 179, 107, 0.45);
        color: #31521a;
        font-size: 14px;
        font-weight: 600;
    }

    .jumlah-badge {
        min-width: 58px;
        height: 32px;
        border-radius: 9px;
        background: #e6f5df;
        color: #2f7d32;
        border: 1px solid rgba(47, 125, 50, 0.25);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 700;
    }

    .keterangan-text {
        color: #333333;
        font-size: 16px;
    }

    .empty-row {
        height: 78px !important;
        color: #777777 !important;
        font-size: 16px !important;
    }

    .table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-top: 10px;
        font-family: "Poppins", sans-serif;
        font-size: 18px;
        font-weight: 400;
        color: #000000;
    }

    .pagination-custom {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .pagination-custom button,
    .pagination-custom span {
        border: none;
        background: transparent;
        font-family: "Poppins", sans-serif;
        font-size: 18px;
        font-weight: 400;
        color: #000000;
        cursor: pointer;
        padding: 0;
    }

    .pagination-custom button:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    .pagination-custom .page-number {
        min-width: 50px;
        height: 36px;
        border: 1px solid #bcbcbc;
        background: #eeeeee;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .alert-custom {
        margin-bottom: 18px;
        border-radius: 12px;
        font-family: "Poppins", sans-serif;
    }

    /* =========================
       MODAL TAMBAH BARANG MASUK
    ========================= */
    .modal-backdrop.show {
        opacity: 0.38 !important;
    }

    .modal-dialog {
        max-width: 720px;
    }

    .modal-content {
        border: none;
        border-radius: 22px;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.22);
        overflow: hidden;
        font-family: "Poppins", sans-serif;
    }

    .modal-header {
        min-height: 74px;
        background: #8fb36b;
        border-bottom: none;
        padding: 22px 26px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-title {
        color: #000000;
        font-size: 24px;
        font-weight: 700;
        margin: 0;
    }

    .modal-header .close {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border: none;
        border-radius: 50%;
        background: #ffe4e4;
        color: #e53935;
        opacity: 1;
        padding: 0;
        margin: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: none;
        text-shadow: none;
        font-size: 0;
        line-height: 1;
    }

    .modal-header .close::before {
        content: "×";
        font-family: "Poppins", sans-serif;
        font-size: 30px;
        font-weight: 700;
        color: #e53935;
        line-height: 1;
        margin-top: -3px;
    }

    .modal-header .close span {
        display: none;
    }

    .modal-body {
        padding: 26px 28px 12px;
        background: #ffffff;
    }

    .modal-body label {
        font-size: 15px;
        font-weight: 600;
        color: #000000;
        margin-bottom: 8px;
    }

    .modal .form-control {
        min-height: 44px;
        border: 1px solid #c9c9c9;
        border-radius: 10px;
        box-shadow: none;
        font-family: "Poppins", sans-serif;
        font-size: 15px;
        color: #000000;
        padding: 9px 12px;
        background: #ffffff;
    }

    .modal textarea.form-control {
        min-height: 90px;
        resize: vertical;
    }

    .modal .form-control:focus {
        border-color: #8fb36b;
        box-shadow: 0 0 0 3px rgba(143, 179, 107, 0.22);
    }

    .modal-footer {
        border-top: none;
        background: #ffffff;
        padding: 16px 28px 28px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .modal-footer .btn {
        min-width: 118px;
        height: 43px;
        border: none;
        border-radius: 14px;
        font-family: "Poppins", sans-serif;
        font-size: 15px;
        font-weight: 600;
        box-shadow: none;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-modal-cancel {
        background: #eeeeee;
        color: #000000;
    }

    .btn-modal-cancel:hover {
        background: #dddddd;
        color: #000000;
    }

    .btn-modal-save {
        background: #8fb36b;
        color: #000000;
    }

    .btn-modal-save:hover {
        background: #7da45a;
        color: #000000;
    }

    @media (max-width: 1150px) {
        .top-action-row {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .add-area {
            padding-top: 0;
            min-width: 0;
            justify-content: flex-end;
        }

        .filter-form {
            grid-template-columns: 1fr 1fr;
        }

        .filter-btn,
        .refresh-btn {
            width: 100%;
        }
    }

    @media (max-width: 800px) {
        .masuk-page {
            padding: 32px 20px 60px;
        }

        .masuk-title {
            font-size: 24px;
        }

        .filter-form {
            grid-template-columns: 1fr;
        }

        .table-toolbar {
            flex-direction: column-reverse;
            align-items: flex-start;
        }

        .search-box {
            width: 100%;
            max-width: 360px;
        }

        .masuk-table {
            min-width: 1080px;
        }

        .table-footer {
            flex-direction: column;
            align-items: flex-start;
        }

        .add-label {
            font-size: 20px;
        }
    }
</style>

<div class="masuk-page">
    <h1 class="masuk-title">Laporan Barang Masuk</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
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

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="masuk-panel">
        <div class="top-action-row">
            <div class="filter-block">
                <label class="date-label">Pilih tanggal masuk</label>

                <form action="{{ url()->current() }}" method="GET" class="filter-form">
                    <div class="date-input-wrap">
                        <input
                            type="date"
                            name="start_date"
                            class="date-input"
                            value="{{ request('start_date') }}"
                        >

                        <span class="calendar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M7 3V6"></path>
                                <path d="M17 3V6"></path>
                                <path d="M4 9H20"></path>
                                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                            </svg>
                        </span>
                    </div>

                    <div class="date-input-wrap">
                        <input
                            type="date"
                            name="end_date"
                            class="date-input"
                            value="{{ request('end_date') }}"
                        >

                        <span class="calendar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M7 3V6"></path>
                                <path d="M17 3V6"></path>
                                <path d="M4 9H20"></path>
                                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                            </svg>
                        </span>
                    </div>

                    <button type="submit" class="filter-btn">Filter</button>
                    <a href="{{ url()->current() }}" class="refresh-btn">Refresh</a>
                </form>
            </div>

            <div class="add-area">
                <span class="add-label">Tambah barang masuk :</span>

                <button class="add-btn" type="button" data-toggle="modal" data-target="#modalMasuk">
                    <span>+</span>
                </button>
            </div>
        </div>

        <div class="table-toolbar">
            <div class="entries-control">
                <span>Show</span>

                <select id="masukEntries">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>

                <span>Entries</span>
            </div>

            <div class="search-box">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="M16.5 16.5L21 21"></path>
                </svg>

                <input type="text" id="masukSearch" placeholder="Search">
            </div>
        </div>

        <div class="masuk-table-wrap">
            <table class="masuk-table">
                <thead>
                    <tr>
                        <th class="col-no">NO</th>
                        <th class="col-kategori">KATEGORI</th>
                        <th class="col-tanggal">TANGGAL MASUK</th>
                        <th class="col-barang">NAMA BARANG</th>
                        <th class="col-jumlah">JUMLAH MASUK</th>
                        <th class="col-keterangan">KETERANGAN</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($riwayat as $r)
                        <tr class="masuk-row">
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="category-badge">
                                    {{ $r->produk?->kategori?->nama_kategori
                                        ?? $r->produk?->kategoriProduk?->nama_kategori
                                        ?? '-' }}
                                </span>
                            </td>

                            <td>{{ optional($r->created_at)->format('d/m/Y') ?? '-' }}</td>

                            <td>{{ $r->produk?->nama_produk ?? '-' }}</td>

                            <td>
                                <span class="jumlah-badge">+{{ $r->jumlah ?? 0 }}</span>
                            </td>

                            <td>
                                <span class="keterangan-text">{{ $r->keterangan ?? '-' }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-row">
                                Data barang masuk belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <div id="masukInfo">
                Showing 0 out of 0 entries
            </div>

            <div class="pagination-custom">
                <button type="button" id="prevPage">‹ Prev</button>
                <span class="page-number" id="currentPageText">1</span>
                <button type="button" id="nextPage">Next ›</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMasuk" tabindex="-1" role="dialog" aria-labelledby="modalMasukLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('master-data.transaksi.masuk.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="modalMasukLabel">Tambah Barang Masuk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Tutup">
                    <span>×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Produk</label>
                    <select name="produk_id" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($produks as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nama_produk }} — Stok: {{ $p->stok }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah Masuk</label>
                    <input type="number" name="jumlah" class="form-control" min="1" placeholder="Masukkan jumlah barang" required>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan transaksi..."></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-modal-cancel" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-modal-save" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('masukSearch');
        const entriesSelect = document.getElementById('masukEntries');
        const rows = Array.from(document.querySelectorAll('.masuk-row'));
        const info = document.getElementById('masukInfo');
        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');
        const currentPageText = document.getElementById('currentPageText');

        let currentPage = 1;

        function getFilteredRows() {
            const keyword = searchInput.value.toLowerCase().trim();

            return rows.filter(function (row) {
                return row.textContent.toLowerCase().includes(keyword);
            });
        }

        function renderTable() {
            const perPage = parseInt(entriesSelect.value, 10);
            const filteredRows = getFilteredRows();
            const totalRows = filteredRows.length;
            const totalPages = Math.max(Math.ceil(totalRows / perPage), 1);

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const startIndex = (currentPage - 1) * perPage;
            const endIndex = startIndex + perPage;

            rows.forEach(function (row) {
                row.style.display = 'none';
            });

            filteredRows.slice(startIndex, endIndex).forEach(function (row) {
                row.style.display = '';
            });

            const showingStart = totalRows === 0 ? 0 : startIndex + 1;
            const showingEnd = Math.min(endIndex, totalRows);

            info.textContent = `Showing ${showingStart} to ${showingEnd} out of ${totalRows} entries`;
            currentPageText.textContent = currentPage;

            prevButton.disabled = currentPage <= 1;
            nextButton.disabled = currentPage >= totalPages;
        }

        searchInput.addEventListener('input', function () {
            currentPage = 1;
            renderTable();
        });

        entriesSelect.addEventListener('change', function () {
            currentPage = 1;
            renderTable();
        });

        prevButton.addEventListener('click', function () {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });

        nextButton.addEventListener('click', function () {
            const perPage = parseInt(entriesSelect.value, 10);
            const totalPages = Math.max(Math.ceil(getFilteredRows().length / perPage), 1);

            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        });

        renderTable();
    });
</script>
@endsection