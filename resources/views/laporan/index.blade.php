@extends('layouts.admin')

@section('content')
<style>
    .laporan-page {
        width: 100%;
        min-height: calc(100vh - 72px);
        background: #ffffff;
        padding: 44px 42px 80px;
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

    .laporan-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 34px;
        animation: headerSlide 0.5s ease both;
    }

    @keyframes headerSlide {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .laporan-title-wrap {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .laporan-title {
        margin: 0;
        font-size: 30px;
        font-weight: 600;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        color: #000000;
    }

    .laporan-subtitle {
        margin: 0;
        font-size: 15px;
        font-weight: 400;
        color: #6f6f6f;
    }

    .print-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 48px;
    }

    .print-label {
        font-size: 22px;
        font-weight: 400;
        color: #000000;
    }

    .print-button {
        width: 86px;
        height: 35px;
        border: none;
        border-radius: 8px;
        background: #4c94ff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        cursor: pointer;
        transition: 0.22s ease;
        position: relative;
        overflow: visible;
    }

    .print-button::after {
        content: "";
        position: absolute;
        inset: -5px;
        border-radius: 11px;
        border: 2px solid rgba(76, 148, 255, 0.35);
        animation: printPulse 2.3s ease-in-out infinite;
    }

    @keyframes printPulse {
        0% {
            opacity: 0.55;
            transform: scale(0.96);
        }

        65% {
            opacity: 0;
            transform: scale(1.13);
        }

        100% {
            opacity: 0;
            transform: scale(1.13);
        }
    }

    .print-button:hover {
        background: #3d84ed;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(76, 148, 255, 0.22);
    }

    .print-button svg {
        width: 27px;
        height: 27px;
        stroke: #000000;
        stroke-width: 2.2;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        position: relative;
        z-index: 1;
    }

    .laporan-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 34px;
        animation: panelSlideUp 0.5s ease both;
        animation-delay: 0.08s;
    }

    .summary-card {
        min-height: 82px;
        border-radius: 18px;
        border: 1px solid #e4e4e4;
        background: #ffffff;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.035);
        transition: 0.22s ease;
        overflow: hidden;
        position: relative;
    }

    .summary-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(110deg, transparent 0%, rgba(143, 179, 107, 0.10) 45%, transparent 80%);
        transform: translateX(-100%);
        animation: softShine 4.5s ease-in-out infinite;
    }

    @keyframes softShine {
        0%, 55% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.07);
    }

    .summary-label {
        position: relative;
        z-index: 1;
        font-size: 14px;
        font-weight: 500;
        color: #666666;
        margin-bottom: 4px;
    }

    .summary-number {
        position: relative;
        z-index: 1;
        font-size: 26px;
        font-weight: 700;
        color: #000000;
        line-height: 1;
    }

    .summary-icon {
        position: relative;
        z-index: 1;
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 700;
    }

    .summary-total .summary-icon {
        background: #eef5e8;
        color: #31521a;
    }

    .summary-in .summary-icon {
        background: #e6f5df;
        color: #2f7d32;
    }

    .summary-out .summary-icon {
        background: #ffe4e4;
        color: #c62828;
    }

    .laporan-card {
        width: 100%;
        background: #ffffff;
        border-radius: 18px;
        padding: 24px 0 10px;
        animation: panelSlideUp 0.55s ease both;
        animation-delay: 0.14s;
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

    .laporan-control-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 16px;
    }

    .entries-control {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 18px;
        font-weight: 400;
        color: #000000;
    }

    .entries-control select {
        width: 78px;
        height: 38px;
        border: 1px solid #c4c4c4;
        background: #eeeeee;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        color: #000000;
        padding: 0 8px;
        outline: none;
        transition: 0.2s ease;
    }

    .entries-control select:focus {
        border-color: #8fb36b;
        box-shadow: 0 0 0 3px rgba(143, 179, 107, 0.18);
    }

    .laporan-search {
        width: 296px;
        height: 49px;
        border: 1px solid #9f9f9f;
        border-radius: 999px;
        display: flex;
        align-items: center;
        padding: 0 18px;
        background: #ffffff;
        transition: 0.22s ease;
    }

    .laporan-search:focus-within {
        border-color: #8fb36b;
        box-shadow: 0 0 0 3px rgba(143, 179, 107, 0.20);
        transform: translateY(-1px);
    }

    .laporan-search svg {
        width: 28px;
        height: 28px;
        margin-right: 14px;
        stroke: #000000;
        stroke-width: 2.7;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
    }

    .laporan-search input {
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

    .laporan-search input::placeholder {
        color: #5f5f5f;
    }

    .laporan-table-wrap {
        width: 100%;
        overflow-x: auto;
        border-radius: 12px;
    }

    .laporan-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        font-family: "Poppins", sans-serif;
        color: #000000;
    }

    .laporan-table th {
        height: 52px;
        background: #eeeeee;
        border: 1px solid #d4d4d4;
        text-align: center;
        vertical-align: middle;
        font-size: 18px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .laporan-table td {
        height: 58px;
        border: 1px solid #dcdcdc;
        text-align: center;
        vertical-align: middle;
        font-size: 17px;
        font-weight: 400;
        color: #000000;
        background: #ffffff;
        transition: 0.22s ease;
    }

    .laporan-row {
        animation: rowFade 0.35s ease both;
    }

    .laporan-row:nth-child(1) { animation-delay: 0.03s; }
    .laporan-row:nth-child(2) { animation-delay: 0.06s; }
    .laporan-row:nth-child(3) { animation-delay: 0.09s; }
    .laporan-row:nth-child(4) { animation-delay: 0.12s; }
    .laporan-row:nth-child(5) { animation-delay: 0.15s; }

    @keyframes rowFade {
        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .laporan-table tbody tr:hover td {
        background: #f9fbf7;
    }

    .col-no {
        width: 9%;
    }

    .col-tanggal {
        width: 22%;
    }

    .col-tipe {
        width: 22%;
    }

    .col-barang {
        width: 29%;
    }

    .col-jumlah {
        width: 18%;
    }

    .transaction-badge {
        min-width: 108px;
        height: 32px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.2px;
        position: relative;
        overflow: hidden;
    }

    .transaction-badge::before {
        content: "";
        width: 7px;
        height: 7px;
        border-radius: 50%;
        display: inline-block;
        animation: badgeDot 1.8s ease-in-out infinite;
    }

    @keyframes badgeDot {
        0%, 100% {
            opacity: 0.6;
            transform: scale(1);
        }

        50% {
            opacity: 1;
            transform: scale(1.3);
        }
    }

    .transaction-in {
        background: #e6f5df;
        color: #2f7d32;
        border: 1px solid rgba(47, 125, 50, 0.25);
    }

    .transaction-in::before {
        background: #2f7d32;
    }

    .transaction-out {
        background: #ffe4e4;
        color: #c62828;
        border: 1px solid rgba(198, 40, 40, 0.25);
    }

    .transaction-out::before {
        background: #c62828;
    }

    .transaction-neutral {
        background: #eeeeee;
        color: #555555;
        border: 1px solid #d0d0d0;
    }

    .transaction-neutral::before {
        background: #777777;
    }

    .jumlah-badge {
        min-width: 58px;
        height: 32px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 800;
        transition: 0.22s ease;
    }

    .jumlah-in {
        background: #e6f5df;
        color: #2f7d32;
        border: 1px solid rgba(47, 125, 50, 0.25);
    }

    .jumlah-out {
        background: #ffe4e4;
        color: #c62828;
        border: 1px solid rgba(198, 40, 40, 0.25);
    }

    .jumlah-neutral {
        background: #f1f1f1;
        color: #555555;
        border: 1px solid #d0d0d0;
    }

    .laporan-row:hover .jumlah-in {
        transform: translateY(-1px);
        box-shadow: 0 8px 14px rgba(47, 125, 50, 0.15);
    }

    .laporan-row:hover .jumlah-out {
        transform: translateY(-1px);
        box-shadow: 0 8px 14px rgba(198, 40, 40, 0.14);
    }

    .laporan-empty {
        height: 78px !important;
        color: #777777 !important;
        font-size: 16px !important;
    }

    .laporan-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-top: 10px;
        font-family: "Poppins", sans-serif;
        font-size: 16px;
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
        font-size: 16px;
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
        min-width: 48px;
        height: 34px;
        border: 1px solid #bcbcbc;
        background: #eeeeee;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .no-result-row {
        display: none;
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation: none !important;
            transition: none !important;
        }
    }

    @media (max-width: 900px) {
        .laporan-page {
            padding: 32px 20px 60px;
        }

        .laporan-header {
            flex-direction: column;
            margin-bottom: 32px;
        }

        .laporan-title {
            font-size: 24px;
        }

        .print-row {
            margin-top: 0;
        }

        .laporan-summary {
            grid-template-columns: 1fr;
        }

        .laporan-control-row {
            flex-direction: column-reverse;
            align-items: flex-start;
        }

        .laporan-search {
            width: 100%;
            max-width: 360px;
        }

        .laporan-table {
            min-width: 900px;
        }

        .laporan-footer {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

@php
    $laporanCollection = $laporan instanceof \Illuminate\Pagination\AbstractPaginator
        ? collect($laporan->items())
        : collect($laporan);

    $totalTransaksi = $laporanCollection->count();
    $totalMasuk = $laporanCollection->filter(fn ($row) => strtolower($row->jenis ?? '') === 'masuk')->count();
    $totalKeluar = $laporanCollection->filter(fn ($row) => strtolower($row->jenis ?? '') === 'keluar')->count();
@endphp

<div class="laporan-page">
    <div class="laporan-header">
        <div class="laporan-title-wrap">
            <h1 class="laporan-title">Laporan Transaksi Bulanan</h1>
            <p class="laporan-subtitle">
                Ringkasan data transaksi barang masuk dan barang keluar.
            </p>
        </div>

        <div class="print-row">
            <span class="print-label">Print laporan :</span>

            <a href="{{ route('laporan.pdf') }}" class="print-button" title="Print laporan">
                <svg viewBox="0 0 24 24">
                    <path d="M6 9V3H18V9"></path>
                    <path d="M6 17H4C3.4 17 3 16.6 3 16V11C3 9.9 3.9 9 5 9H19C20.1 9 21 9.9 21 11V16C21 16.6 20.6 17 20 17H18"></path>
                    <path d="M6 14H18V21H6V14Z"></path>
                    <path d="M8 17H16"></path>
                </svg>
            </a>
        </div>
    </div>

    <div class="laporan-summary">
        <div class="summary-card summary-total">
            <div>
                <div class="summary-label">Total Transaksi</div>
                <div class="summary-number">{{ $totalTransaksi }}</div>
            </div>
            <div class="summary-icon">≡</div>
        </div>

        <div class="summary-card summary-in">
            <div>
                <div class="summary-label">Barang Masuk</div>
                <div class="summary-number">{{ $totalMasuk }}</div>
            </div>
            <div class="summary-icon">+</div>
        </div>

        <div class="summary-card summary-out">
            <div>
                <div class="summary-label">Barang Keluar</div>
                <div class="summary-number">{{ $totalKeluar }}</div>
            </div>
            <div class="summary-icon">−</div>
        </div>
    </div>

    <div class="laporan-card">
        <div class="laporan-control-row">
            <div class="entries-control">
                <span>Show</span>

                <select id="laporanEntries">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>

                <span>Entries</span>
            </div>

            <div class="laporan-search">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="M16.5 16.5L21 21"></path>
                </svg>

                <input type="text" id="laporanSearch" placeholder="Search">
            </div>
        </div>

        <div class="laporan-table-wrap">
            <table class="laporan-table">
                <thead>
                    <tr>
                        <th class="col-no">NO</th>
                        <th class="col-tanggal">TANGGAL</th>
                        <th class="col-tipe">TIPE TRANSAKSI</th>
                        <th class="col-barang">NAMA BARANG</th>
                        <th class="col-jumlah">JUMLAH</th>
                    </tr>
                </thead>

                <tbody id="laporanTableBody">
                    @forelse($laporan as $row)
                        @php
                            $jenis = strtolower($row->jenis ?? '-');
                            $jumlah = (int) ($row->jumlah ?? 0);

                            if ($jenis === 'masuk') {
                                $jenisLabel = 'Barang Masuk';
                                $jenisClass = 'transaction-in';
                                $jumlahClass = 'jumlah-in';
                                $jumlahText = '+' . $jumlah;
                            } elseif ($jenis === 'keluar') {
                                $jenisLabel = 'Barang Keluar';
                                $jenisClass = 'transaction-out';
                                $jumlahClass = 'jumlah-out';
                                $jumlahText = '-' . $jumlah;
                            } else {
                                $jenisLabel = ucfirst($row->jenis ?? '-');
                                $jenisClass = 'transaction-neutral';
                                $jumlahClass = 'jumlah-neutral';
                                $jumlahText = (string) $jumlah;
                            }
                        @endphp

                        <tr class="laporan-row">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($row->created_at)->format('d/m/Y') ?? '-' }}</td>
                            <td>
                                <span class="transaction-badge {{ $jenisClass }}">
                                    {{ $jenisLabel }}
                                </span>
                            </td>
                            <td>{{ $row->produk->nama_produk ?? '-' }}</td>
                            <td>
                                <span class="jumlah-badge {{ $jumlahClass }}">
                                    {{ $jumlahText }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="5" class="laporan-empty">
                                Data laporan transaksi belum tersedia.
                            </td>
                        </tr>
                    @endforelse

                    <tr class="no-result-row" id="noResultRow">
                        <td colspan="5" class="laporan-empty">
                            Data yang dicari tidak ditemukan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="laporan-footer">
            <div id="laporanInfo">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('laporanSearch');
        const entriesSelect = document.getElementById('laporanEntries');
        const rows = Array.from(document.querySelectorAll('.laporan-row'));
        const info = document.getElementById('laporanInfo');
        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');
        const currentPageText = document.getElementById('currentPageText');
        const noResultRow = document.getElementById('noResultRow');

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

            if (noResultRow) {
                noResultRow.style.display = totalRows === 0 && rows.length > 0 ? '' : 'none';
            }

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