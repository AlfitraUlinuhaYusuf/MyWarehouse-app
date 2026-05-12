<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MyWarehouse</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playwrite+US+Modern:wght@100..400&family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100vh;
            font-family: "Poppins", sans-serif;
            background: #ffffff;
            color: #000000;
        }

        :root {
            --green-main: #8fb36b;
            --green-dark: #3f611b;
            --table-border: #b7b7b7;
            --table-head: #d9d9d9;
            --dropdown-hover: #eef5e8;
        }

        /* =========================
           NAVBAR
        ========================= */
        .navbar {
            width: 100%;
            height: 78px;
            background: var(--green-main);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 75px;
            position: relative;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #000000;
        }

        .brand img {
            width: 58px;
            height: 58px;
            object-fit: contain;
        }

        .brand span {
            font-family: "Playwrite US Modern", cursive;
            font-size: 28px;
            font-weight: 400;
            color: #000000;
            line-height: 1;
            letter-spacing: -1px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 34px;
        }

        .nav-link,
        .nav-dropdown summary {
            list-style: none;
            text-decoration: none;
            color: #000000;
            font-family: "Poppins", sans-serif;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            line-height: 1;
        }

        .nav-link:hover,
        .nav-dropdown summary:hover,
        .user-info:hover {
            opacity: 0.85;
        }

        .nav-dropdown {
            position: relative;
        }

        .nav-dropdown summary::-webkit-details-marker,
        .user-dropdown summary::-webkit-details-marker {
            display: none;
        }

        .nav-dropdown summary::after {
            content: "";
            display: inline-block;
            margin-left: 6px;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #000000;
            vertical-align: middle;
            transition: transform 0.2s ease;
        }

        .nav-dropdown[open] summary::after {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: 28px;
            right: 0;
            min-width: 180px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.16);
            padding: 8px 0;
            z-index: 999;
        }

        .dropdown-menu a,
        .dropdown-disabled {
            display: block;
            padding: 10px 16px;
            text-decoration: none;
            font-family: "Poppins", sans-serif;
            font-size: 14px;
            font-weight: 400;
            white-space: nowrap;
        }

        .dropdown-menu a {
            color: #000000;
        }

        .dropdown-menu a:hover {
            background: var(--dropdown-hover);
        }

        .dropdown-disabled {
            color: #9a9a9a;
            cursor: not-allowed;
            user-select: none;
        }

        .dropdown-disabled:hover {
            background: #f5f5f5;
        }

        /* =========================
           USER DROPDOWN
        ========================= */
        .user-dropdown {
            position: relative;
        }

        .user-dropdown summary {
            list-style: none;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 7px;
            font-family: "Poppins", sans-serif;
            font-size: 16px;
            font-weight: 500;
            color: #000000;
            cursor: pointer;
            line-height: 1;
        }

        .user-info::after {
            content: "";
            display: inline-block;
            margin-left: 6px;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #000000;
            transition: transform 0.2s ease;
        }

        .user-dropdown[open] .user-info::after {
            transform: rotate(180deg);
        }

        .user-icon {
            width: 27px;
            height: 27px;
            border: 2px solid #000000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-icon svg {
            width: 18px;
            height: 18px;
        }

        .user-dropdown-menu {
            top: 34px;
            right: 0;
            min-width: 180px;
            padding: 8px 0;
            z-index: 1000;
        }

        .user-dropdown-menu form {
            margin: 0;
            padding: 0;
        }

        .logout-btn {
            display: block;
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            appearance: none;
            -webkit-appearance: none;
            padding: 10px 16px;
            color: #000000;
            font-family: "Poppins", sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.4;
            text-align: left;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: var(--dropdown-hover);
        }

        /* =========================
           DASHBOARD CONTENT
        ========================= */
        .dashboard-wrapper {
            width: 100%;
            padding: 31px 70px 47px;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 500;
            margin-left: 10px;
            margin-bottom: 28px;
            letter-spacing: 0.2px;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 38px;
            margin: 0 8px 45px;
        }

        .stat-card {
            height: 132px;
            background: var(--green-main);
            border-radius: 18px;
            padding: 16px 22px;
        }

        .stat-label {
            font-size: 18px;
            font-weight: 400;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 400;
            letter-spacing: 5px;
        }

        .chart-card {
            margin: 0 0 30px;
            background: var(--green-main);
            border-radius: 20px;
            padding: 20px 12px 20px;
        }

        .chart-title {
            font-size: 25px;
            font-weight: 500;
            letter-spacing: 3px;
            margin-left: 12px;
            margin-bottom: 18px;
        }

        .chart-box {
            width: 100%;
            height: 322px;
            background: #ffffff;
            border-radius: 4px;
            position: relative;
            padding: 20px 25px;
        }

        #stockChart {
            width: 100% !important;
            height: 100% !important;
        }

        .empty-chart-message {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            color: #777777;
            font-size: 20px;
            font-weight: 400;
            z-index: 2;
            border-radius: 4px;
        }

        .stock-card {
            background: var(--green-main);
            border-radius: 16px;
            padding: 24px 22px;
        }

        .stock-inner {
            background: #ffffff;
            border-radius: 15px;
            padding: 13px 17px 29px;
        }

        .stock-title {
            font-size: 20px;
            font-weight: 400;
            margin-bottom: 10px;
        }

        .stock-table-wrap {
            display: flex;
            justify-content: center;
        }

        table {
            width: 86%;
            border-collapse: collapse;
            font-size: 16px;
            font-weight: 400;
        }

        th,
        td {
            border: 1px solid var(--table-border);
            text-align: center;
            padding: 7px 8px;
            height: 37px;
        }

        th {
            background: var(--table-head);
            font-weight: 400;
        }

        .col-no {
            width: 48px;
        }

        .col-kategori {
            width: 230px;
        }

        .col-stok {
            width: 64px;
        }

        .empty-text {
            color: #777777;
            font-size: 15px;
        }

        /* =========================
           RESPONSIVE
        ========================= */
        @media (max-width: 1000px) {
            .navbar {
                height: auto;
                flex-direction: column;
                gap: 18px;
                padding: 18px 24px;
            }

            .nav-right {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }

            .dropdown-menu,
            .user-dropdown-menu {
                top: 30px;
                right: 0;
            }

            .dashboard-wrapper {
                padding: 28px 22px;
            }

            .stats-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .chart-box {
                height: 240px;
            }

            table {
                width: 100%;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    @php
        $totalKategoriBarang = $totalKategoriBarang ?? 0;
        $totalBarangMasuk = $totalBarangMasuk ?? 0;
        $totalBarangKeluar = $totalBarangKeluar ?? 0;
        $stokMinimum = $stokMinimum ?? collect();

        /*
            Jika data barang masuk dan barang keluar masih kosong,
            maka tombol Cetak PDF di dropdown Laporan akan dibuat nonaktif.
        */
        $laporanKosong = $totalBarangMasuk <= 0 && $totalBarangKeluar <= 0;

        $safeChartLabels = $chartLabels ?? [];
        $safeChartStocks = $chartStocks ?? [];

        if ($safeChartLabels instanceof \Illuminate\Support\Collection) {
            $safeChartLabels = $safeChartLabels->values()->toArray();
        }

        if ($safeChartStocks instanceof \Illuminate\Support\Collection) {
            $safeChartStocks = $safeChartStocks->values()->toArray();
        }

        if (!is_array($safeChartLabels)) {
            $safeChartLabels = [];
        }

        if (!is_array($safeChartStocks)) {
            $safeChartStocks = [];
        }

        $hasChartData = count($safeChartLabels) > 0 && count($safeChartStocks) > 0;
    @endphp

    <nav class="navbar">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('images/logo-warehouse.png') }}" alt="MyWarehouse Logo">
            <span>MyWarehouse</span>
        </a>

        <div class="nav-right">
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>

            <details class="nav-dropdown">
                <summary>Data</summary>
                <div class="dropdown-menu">
                    <a href="{{ route('master-data.produk.index') }}">Data Barang</a>
                    <a href="{{ route('master-data.kategori-produk.index') }}">Kategori Barang</a>
                </div>
            </details>

            <details class="nav-dropdown">
                <summary>Transaksi</summary>
                <div class="dropdown-menu">
                    <a href="{{ route('master-data.transaksi.masuk') }}">Barang Masuk</a>
                    <a href="{{ route('master-data.transaksi.keluar') }}">Barang Keluar</a>
                </div>
            </details>

            <details class="nav-dropdown">
                <summary>Laporan</summary>
                <div class="dropdown-menu">
                    <a href="{{ route('laporan.index') }}">Laporan</a>

                    @if ($laporanKosong)
                        <span
                            class="dropdown-disabled"
                            title="Belum ada data laporan untuk dicetak"
                            aria-disabled="true"
                        >
                            Cetak PDF
                        </span>
                    @else
                        <a href="{{ route('laporan.pdf') }}">Cetak PDF</a>
                    @endif
                </div>
            </details>

            <details class="user-dropdown">
                <summary class="user-info">
                    <div class="user-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="4"></circle>
                            <path d="M4 21c1.5-5 14.5-5 16 0"></path>
                        </svg>
                    </div>
                    <span>Hi, {{ auth()->user()->name ?? 'Nama' }}</span>
                </summary>

                <div class="dropdown-menu user-dropdown-menu">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </details>
        </div>
    </nav>

    <main class="dashboard-wrapper">
        <h1 class="dashboard-title">DASHBOARD</h1>

        <section class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Kategori Barang</div>
                <div class="stat-number">{{ $totalKategoriBarang }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Barang Masuk</div>
                <div class="stat-number">{{ $totalBarangMasuk }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Barang Keluar</div>
                <div class="stat-number">{{ $totalBarangKeluar }}</div>
            </div>
        </section>

        <section class="chart-card">
            <h2 class="chart-title">Grafik Stok Barang</h2>

            <div class="chart-box">
                <canvas id="stockChart"></canvas>

                @if (!$hasChartData)
                    <div class="empty-chart-message">
                        Belum ada data stok barang.
                    </div>
                @endif
            </div>
        </section>

        <section class="stock-card">
            <div class="stock-inner">
                <h2 class="stock-title">Stock mencapai batas minimum :</h2>

                <div class="stock-table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th class="col-kategori">Kategori Barang</th>
                                <th>Nama Barang</th>
                                <th class="col-stok">Stok</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($stokMinimum as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        {{ $item->kategori->nama_kategori
                                            ?? $item->kategoriProduk->nama_kategori
                                            ?? $item->kategori_produk->nama_kategori
                                            ?? $item->kategori_barang
                                            ?? $item->nama_kategori
                                            ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $item->nama_barang
                                            ?? $item->nama_produk
                                            ?? $item->nama
                                            ?? '-' }}
                                    </td>
                                    <td>{{ $item->stok ?? 0 }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty-text">
                                        Tidak ada barang yang mencapai batas minimum.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const stockLabels = {!! json_encode($safeChartLabels) !!};
        const stockData = {!! json_encode($safeChartStocks) !!};
        const hasChartData = {!! $hasChartData ? 'true' : 'false' !!};

        const ctx = document.getElementById('stockChart');

        if (ctx && hasChartData) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: stockLabels,
                    datasets: [
                        {
                            label: 'Stok Barang',
                            data: stockData,
                            backgroundColor: stockData.map((_, index) => {
                                const colors = [
                                    '#8FB36B',
                                    '#A8D957',
                                    '#6FA8DC',
                                    '#F6B26B',
                                    '#C27BA0',
                                    '#76A5AF',
                                    '#FFD966',
                                    '#93C47D',
                                    '#E06666',
                                    '#8E7CC3'
                                ];

                                return colors[index % colors.length];
                            }),
                            borderColor: stockData.map((_, index) => {
                                const borderColors = [
                                    '#3F611B',
                                    '#7FA832',
                                    '#3D85C6',
                                    '#E69138',
                                    '#A64D79',
                                    '#45818E',
                                    '#D6A800',
                                    '#6AA84F',
                                    '#CC0000',
                                    '#674EA7'
                                ];

                                return borderColors[index % borderColors.length];
                            }),
                            borderWidth: 1.5,
                            borderRadius: 6,
                            barThickness: 45
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#000000',
                                font: {
                                    family: 'Poppins',
                                    size: 13
                                }
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#000000',
                                font: {
                                    family: 'Poppins',
                                    size: 13
                                }
                            },
                            grid: {
                                color: '#e5e5e5'
                            }
                        }
                    }
                }
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const allDropdowns = document.querySelectorAll('.nav-dropdown, .user-dropdown');

            allDropdowns.forEach(function (dropdown) {
                dropdown.addEventListener('toggle', function () {
                    if (dropdown.open) {
                        allDropdowns.forEach(function (item) {
                            if (item !== dropdown) {
                                item.removeAttribute('open');
                            }
                        });
                    }
                });
            });

            document.addEventListener('click', function (event) {
                const clickedInsideDropdown = event.target.closest('.nav-dropdown, .user-dropdown');

                if (!clickedInsideDropdown) {
                    allDropdowns.forEach(function (dropdown) {
                        dropdown.removeAttribute('open');
                    });
                }
            });
        });
    </script>
</body>
</html>