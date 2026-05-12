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
            --icon-color: #2f2f2f;
            --danger: #d93025;
            --warning: #f4c430;
            --safe: #3f611b;
            --danger-soft: #ffe6e6;
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
            min-height: 132px;
            background: var(--green-main);
            border-radius: 18px;
            padding: 16px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .stat-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
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

        .stat-icon {
            width: 96px;
            height: 96px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--icon-color);
        }

        .stat-icon svg {
            width: 90px;
            height: 90px;
        }

        .stat-icon .arrow-line {
            fill: none;
            stroke: currentColor;
            stroke-width: 10;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .stat-icon .stairs-shape {
            fill: currentColor;
        }

        .stat-icon .menu-shape {
            fill: currentColor;
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

        /* =========================
           STOCK MINIMUM TABLE
        ========================= */
        .stock-card {
            background: var(--green-main);
            border-radius: 16px;
            padding: 24px 22px;
        }

        .stock-inner {
            background: #ffffff;
            border-radius: 15px;
            padding: 16px 18px 30px;
        }

        .stock-title-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .stock-title {
            font-size: 20px;
            font-weight: 400;
            margin: 0;
        }

        .stock-warning-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 30px;
            padding: 5px 12px;
            border-radius: 999px;
            background: var(--danger-soft);
            border: 1px solid rgba(217, 48, 37, 0.25);
            color: var(--danger);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.2px;
            animation: warningFloat 2.4s ease-in-out infinite;
        }

        .warning-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--danger);
            position: relative;
            flex-shrink: 0;
        }

        .warning-dot::after {
            content: "";
            position: absolute;
            inset: -5px;
            border-radius: 50%;
            background: rgba(217, 48, 37, 0.22);
            animation: warningPulse 1.8s ease-in-out infinite;
        }

        .warning-icon {
            width: 16px;
            height: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .warning-icon svg {
            width: 16px;
            height: 16px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.4;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        @keyframes warningFloat {
            0% {
                transform: translateY(0);
                box-shadow: 0 0 0 rgba(217, 48, 37, 0);
            }

            50% {
                transform: translateY(-2px);
                box-shadow: 0 7px 15px rgba(217, 48, 37, 0.16);
            }

            100% {
                transform: translateY(0);
                box-shadow: 0 0 0 rgba(217, 48, 37, 0);
            }
        }

        @keyframes warningPulse {
            0% {
                opacity: 0.7;
                transform: scale(0.75);
            }

            70% {
                opacity: 0;
                transform: scale(1.45);
            }

            100% {
                opacity: 0;
                transform: scale(1.45);
            }
        }

        .stock-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .stock-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 15px;
            font-weight: 400;
        }

        .stock-table th,
        .stock-table td {
            border: 1px solid var(--table-border);
            text-align: center;
            padding: 10px 12px;
            min-height: 42px;
            vertical-align: middle;
        }

        .stock-table th {
            background: var(--table-head);
            font-weight: 500;
        }

        .col-no {
            width: 60px;
        }

        .col-kategori,
        .col-nama {
            width: 30%;
        }

        .col-stok {
            width: 30%;
        }

        .text-left {
            text-align: left;
        }

        .stock-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
        }

        .stock-value {
            min-width: 28px;
            height: 28px;
            border-radius: 8px;
            background: #f3f3f3;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 600;
            color: #000000;
        }

        .stock-bar-track {
            flex: 1;
            height: 13px;
            background: #eeeeee;
            border-radius: 999px;
            overflow: hidden;
        }

        .stock-bar-fill {
            height: 100%;
            border-radius: 999px;
            transition: width 0.3s ease;
        }

        .stock-low {
            background: var(--danger);
        }

        .stock-warning {
            background: var(--warning);
        }

        .stock-safe {
            background: var(--safe);
        }

        .empty-text {
            color: #777777;
            font-size: 15px;
            padding: 18px 12px;
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

            .stat-icon {
                width: 82px;
                height: 82px;
            }

            .stat-icon svg {
                width: 76px;
                height: 76px;
            }

            .chart-box {
                height: 240px;
            }

            .stock-table {
                min-width: 760px;
                font-size: 14px;
            }

            .stock-warning-badge {
                font-size: 12px;
                padding: 5px 10px;
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
            Jika barang masuk dan barang keluar masih kosong,
            maka menu Cetak PDF di dropdown Laporan dibuat nonaktif.
        */
        $laporanKosong = $totalBarangMasuk <= 0 && $totalBarangKeluar <= 0;
        $adaStokMinimum = $stokMinimum->count() > 0;

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
                <div class="stat-content">
                    <div class="stat-label">Kategori Barang</div>
                    <div class="stat-number">{{ $totalKategoriBarang }}</div>
                </div>

                <div class="stat-icon" aria-hidden="true">
                    <!-- Ikon menu kategori -->
                    <svg viewBox="0 0 120 120">
                        <rect class="menu-shape" x="24" y="28" width="72" height="14" rx="7"></rect>
                        <rect class="menu-shape" x="24" y="53" width="72" height="14" rx="7"></rect>
                        <rect class="menu-shape" x="24" y="78" width="72" height="14" rx="7"></rect>
                    </svg>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-label">Barang Masuk</div>
                    <div class="stat-number">{{ $totalBarangMasuk }}</div>
                </div>

                <div class="stat-icon" aria-hidden="true">
                    <!-- Ikon panah turun untuk Barang Masuk -->
                    <svg viewBox="0 0 120 120">
                        <path class="arrow-line" d="M72 14 L34 52"></path>
                        <path class="arrow-line" d="M34 28 V52 H58"></path>

                        <path
                            class="stairs-shape"
                            d="M28 92
                               H48
                               V74
                               H66
                               V56
                               H84
                               V38
                               H104
                               V52
                               H96
                               V70
                               H78
                               V88
                               H60
                               V106
                               H28
                               Z"
                        ></path>
                    </svg>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-label">Barang Keluar</div>
                    <div class="stat-number">{{ $totalBarangKeluar }}</div>
                </div>

                <div class="stat-icon" aria-hidden="true">
                    <!-- Ikon panah naik untuk Barang Keluar -->
                    <svg viewBox="0 0 120 120">
                        <path class="arrow-line" d="M34 52 L72 14"></path>
                        <path class="arrow-line" d="M48 14 H72 V38"></path>

                        <path
                            class="stairs-shape"
                            d="M28 92
                               H48
                               V74
                               H66
                               V56
                               H84
                               V38
                               H104
                               V52
                               H96
                               V70
                               H78
                               V88
                               H60
                               V106
                               H28
                               Z"
                        ></path>
                    </svg>
                </div>
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
                <div class="stock-title-row">
                    <h2 class="stock-title">Stock mencapai batas minimum :</h2>

                    @if ($adaStokMinimum)
                        <div class="stock-warning-badge" title="Ada barang yang stoknya mencapai batas minimum">
                            <span class="warning-dot"></span>

                            <span class="warning-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 9V13"></path>
                                    <path d="M12 17H12.01"></path>
                                    <path d="M10.3 4.2L2.6 18.1C2.1 19 2.7 20 3.8 20H20.2C21.3 20 21.9 19 21.4 18.1L13.7 4.2C13.2 3.3 10.8 3.3 10.3 4.2Z"></path>
                                </svg>
                            </span>

                            <span>Stok perlu diperhatikan</span>
                        </div>
                    @endif
                </div>

                <div class="stock-table-wrap">
                    <table class="stock-table">
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th class="col-kategori">Kategori Barang</th>
                                <th class="col-nama">Nama Barang</th>
                                <th class="col-stok">Stok</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($stokMinimum as $index => $item)
                                @php
                                    $stokValue = (int) ($item->stok ?? 0);
                                    $stokPercent = $stokValue <= 0 ? 4 : min(100, $stokValue * 20);

                                    if ($stokValue <= 2) {
                                        $stockLevelClass = 'stock-low';
                                    } elseif ($stokValue <= 5) {
                                        $stockLevelClass = 'stock-warning';
                                    } else {
                                        $stockLevelClass = 'stock-safe';
                                    }
                                @endphp

                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td class="text-left">
                                        {{ $item->kategori->nama_kategori
                                            ?? $item->kategoriProduk->nama_kategori
                                            ?? $item->kategori_produk->nama_kategori
                                            ?? $item->kategori_barang
                                            ?? $item->nama_kategori
                                            ?? '-' }}
                                    </td>

                                    <td class="text-left">
                                        {{ $item->nama_barang
                                            ?? $item->nama_produk
                                            ?? $item->nama
                                            ?? '-' }}
                                    </td>

                                    <td>
                                        <div class="stock-cell">
                                            <span class="stock-value">{{ $stokValue }}</span>

                                            <div class="stock-bar-track">
                                                <div
                                                    class="stock-bar-fill {{ $stockLevelClass }}"
                                                    style="width: {{ $stokPercent }}%;"
                                                ></div>
                                            </div>
                                        </div>
                                    </td>
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