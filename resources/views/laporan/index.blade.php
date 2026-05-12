@extends('layouts.admin')

@section('content')
<style>
    .laporan-page {
        width: 100%;
        min-height: calc(100vh - 72px);
        background: #ffffff;
        padding: 46px 42px 80px;
        font-family: "Poppins", sans-serif;
        color: #000000;
    }

    .laporan-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 58px;
    }

    .laporan-title-wrap {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .laporan-title {
        margin: 0;
        font-size: 30px;
        font-weight: 500;
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
        margin-top: 52px;
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
        transition: 0.2s ease;
    }

    .print-button:hover {
        background: #3d84ed;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .print-button svg {
        width: 27px;
        height: 27px;
        stroke: #000000;
        stroke-width: 2.2;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .laporan-card {
        width: 100%;
        background: #ffffff;
        border-radius: 16px;
        padding: 24px 0 10px;
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
        border-radius: 10px;
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
        font-weight: 500;
        text-transform: uppercase;
    }

    .laporan-table td {
        height: 56px;
        border: 1px solid #dcdcdc;
        text-align: center;
        vertical-align: middle;
        font-size: 17px;
        font-weight: 400;
        color: #000000;
        background: #ffffff;
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
        min-width: 92px;
        height: 32px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.2px;
    }

    .transaction-in {
        background: #e6f5df;
        color: #2f7d32;
        border: 1px solid rgba(47, 125, 50, 0.25);
    }

    .transaction-out {
        background: #ffe4e4;
        color: #c62828;
        border: 1px solid rgba(198, 40, 40, 0.25);
    }

    .transaction-neutral {
        background: #eeeeee;
        color: #555555;
        border: 1px solid #d0d0d0;
    }

    .jumlah-badge {
        min-width: 54px;
        height: 32px;
        border-radius: 9px;
        background: #f1f1f1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
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

    @media (max-width: 900px) {
        .laporan-page {
            padding: 32px 20px 60px;
        }

        .laporan-header {
            flex-direction: column;
            margin-bottom: 36px;
        }

        .laporan-title {
            font-size: 24px;
        }

        .print-row {
            margin-top: 0;
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

                            if ($jenis === 'masuk') {
                                $jenisLabel = 'Barang Masuk';
                                $jenisClass = 'transaction-in';
                            } elseif ($jenis === 'keluar') {
                                $jenisLabel = 'Barang Keluar';
                                $jenisClass = 'transaction-out';
                            } else {
                                $jenisLabel = ucfirst($row->jenis ?? '-');
                                $jenisClass = 'transaction-neutral';
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
                                <span class="jumlah-badge">
                                    {{ $row->jumlah ?? 0 }}
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