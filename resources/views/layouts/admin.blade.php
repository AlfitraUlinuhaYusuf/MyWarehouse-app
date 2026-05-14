<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyWarehouse</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playwrite+US+Modern:wght@100..400&family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- Bootstrap 4: agar modal/component Laravel tetap berjalan -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    >

    <style>
        :root {
            --green-main: #8fb36b;
            --green-dark: #6f9651;
            --green-soft: #edf5e8;
            --green-pale: #f7fbf4;
            --black: #050704;
            --white: #ffffff;
            --ring: rgba(143, 179, 107, 0.32);
            --dropdown-shadow: 0 22px 52px rgba(47, 68, 35, 0.20);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100vh;
            background: #ffffff;
            color: #000000;
            font-family: "Poppins", sans-serif;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        a:hover {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        ::selection {
            background: rgba(143, 179, 107, 0.28);
        }

        :focus-visible {
            outline: 4px solid var(--ring);
            outline-offset: 3px;
            border-radius: 12px;
        }

        @keyframes adminNavbarDown {
            from {
                opacity: 0;
                transform: translateY(-14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes adminDropdownIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================
           NAVBAR DASHBOARD STYLE
        ========================= */
        .top-navbar {
            width: 100%;
            height: 78px;
            padding: 0 72px;
            background: linear-gradient(135deg, #95ba72 0%, var(--green-main) 46%, #82a864 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 12px 32px rgba(70, 96, 48, 0.18);
            animation: adminNavbarDown 0.55s ease both;
            isolation: isolate;
        }

        .top-navbar::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            pointer-events: none;
            background:
                linear-gradient(90deg, rgba(255, 255, 255, 0.20), transparent 28%, transparent 68%, rgba(255, 255, 255, 0.12)),
                radial-gradient(circle at 12% 20%, rgba(255, 255, 255, 0.20), transparent 22%);
            opacity: 0.78;
        }

        .top-navbar::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 1px;
            background: rgba(255, 255, 255, 0.35);
        }

        .brand {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: max-content;
            color: #000000;
        }

        .brand:hover {
            color: #000000;
        }

        .brand img {
            width: 55px;
            height: 55px;
            object-fit: contain;
            filter: drop-shadow(0 8px 10px rgba(0, 0, 0, 0.12));
            transition: transform 0.28s ease;
        }

        .brand:hover img {
            transform: translateY(-2px) rotate(-4deg) scale(1.04);
        }

        .brand span {
            font-family: "Playwrite US Modern", cursive;
            font-size: 27px;
            font-weight: 400;
            letter-spacing: -1.3px;
            color: #000000;
            line-height: 1;
        }

        .nav-menu {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 32px;
            font-size: 16px;
            font-weight: 500;
        }

        .nav-link,
        .nav-dropdown summary,
        .user-dropdown summary {
            height: 40px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #000000;
            cursor: pointer;
            list-style: none;
            border-radius: 999px;
            position: relative;
            line-height: 1;
            padding: 0 4px;
            transition: transform 0.22s ease, background 0.22s ease, opacity 0.22s ease, box-shadow 0.22s ease;
        }

        .nav-link:hover,
        .nav-dropdown summary:hover,
        .user-dropdown summary:hover {
            color: #000000;
            transform: translateY(-2px);
            opacity: 0.88;
        }

        .nav-link.active,
        .nav-dropdown summary.active {
            font-weight: 700;
            background: rgba(255, 255, 255, 0.18);
            padding: 0 14px;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.16);
        }

        .nav-link.active::after,
        .nav-dropdown summary.active::before {
            content: "";
            position: absolute;
            left: 14px;
            right: 14px;
            bottom: 4px;
            height: 2px;
            border-radius: 999px;
            background: rgba(0, 0, 0, 0.56);
        }

        .nav-dropdown[open] summary,
        .user-dropdown[open] summary {
            background: rgba(255, 255, 255, 0.18);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.16);
        }

        .nav-dropdown,
        .user-dropdown {
            position: relative;
        }

        .nav-dropdown summary::-webkit-details-marker,
        .user-dropdown summary::-webkit-details-marker {
            display: none;
        }

        .nav-dropdown summary::after {
            content: "";
            width: 0;
            height: 0;
            margin-top: 3px;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #000000;
            transition: transform 0.22s ease;
        }

        .nav-dropdown[open] summary::after {
            transform: rotate(180deg);
        }

        .dropdown-box {
            position: absolute;
            top: 43px;
            right: 0;
            min-width: 180px;
            padding: 8px;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(111, 150, 81, 0.16);
            border-radius: 16px;
            box-shadow: var(--dropdown-shadow);
            backdrop-filter: blur(12px);
            animation: adminDropdownIn 0.22s ease both;
            overflow: hidden;
        }

        .dropdown-box a,
        .dropdown-box button,
        .dropdown-disabled {
            width: 100%;
            min-height: 39px;
            padding: 9px 12px;
            display: flex;
            align-items: center;
            border: 0;
            border-radius: 10px;
            background: transparent;
            color: #000000;
            font-size: 14px;
            font-weight: 500;
            line-height: 1.25;
            text-align: left;
            white-space: nowrap;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .dropdown-box a:hover,
        .dropdown-box button:hover {
            background: var(--green-soft);
            color: #000000;
            transform: translateX(3px);
        }

        .dropdown-disabled {
            color: rgba(0, 0, 0, 0.4);
            cursor: not-allowed;
            user-select: none;
            background: rgba(0, 0, 0, 0.025);
        }

        .user-info {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .user-icon {
            width: 28px;
            height: 28px;
            border: 2px solid #000000;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.25s ease;
        }

        .user-info:hover .user-icon {
            transform: rotate(8deg) scale(1.05);
        }

        .user-icon svg {
            width: 18px;
            height: 18px;
        }

        .logout-button {
            cursor: pointer;
        }

        .user-menu-only-logout {
            min-width: 132px;
        }

        .mobile-toggle {
            position: relative;
            z-index: 2;
            display: none;
            width: 42px;
            height: 42px;
            border: 0;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.25);
            cursor: pointer;
        }

        .mobile-toggle span {
            width: 22px;
            height: 2px;
            margin: 4px auto;
            display: block;
            background: #000000;
            border-radius: 999px;
        }

        .admin-main-content {
            width: 100%;
            min-height: calc(100vh - 78px);
            background: #ffffff;
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
            }
        }

        @media (max-width: 1050px) {
            .top-navbar {
                padding: 0 32px;
            }

            .nav-menu {
                gap: 22px;
            }
        }

        @media (max-width: 860px) {
            .top-navbar {
                height: auto;
                min-height: 78px;
                padding: 12px 22px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .mobile-toggle {
                display: block;
            }

            .nav-menu {
                width: 100%;
                display: none;
                flex-direction: column;
                align-items: stretch;
                gap: 7px;
                padding: 8px 0 2px;
            }

            .top-navbar.open .nav-menu {
                display: flex;
            }

            .nav-link,
            .nav-dropdown summary,
            .user-dropdown summary {
                width: 100%;
                justify-content: flex-start;
                padding: 0 12px;
                background: rgba(255, 255, 255, 0.18);
            }

            .nav-link.active,
            .nav-dropdown summary.active {
                padding: 0 12px;
            }

            .nav-link.active::after,
            .nav-dropdown summary.active::before {
                left: 12px;
                right: 12px;
            }

            .dropdown-box {
                position: static;
                margin-top: 6px;
                box-shadow: none;
            }
        }

        @media (max-width: 620px) {
            .brand span {
                font-size: 21px;
            }

            .brand img {
                width: 48px;
                height: 48px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    @php
        $laporanPdfTersedia = \App\Models\Transaksi::where('created_at', '>=', now()->subMonth())->exists();
        $isDashboard = request()->routeIs('dashboard');
        $isData = request()->routeIs('master-data.produk.*') || request()->routeIs('master-data.kategori-produk.*');
        $isTransaksi = request()->routeIs('master-data.transaksi.*');
        $isLaporan = request()->routeIs('laporan.*');
    @endphp

    <nav class="top-navbar" id="topNavbar">
        <a href="{{ route('dashboard') }}" class="brand" aria-label="MyWarehouse">
            <img src="{{ asset('images/logo-warehouse.png') }}" alt="MyWarehouse Logo">
            <span>MyWarehouse</span>
        </a>

        <button type="button" class="mobile-toggle" id="mobileToggle" aria-label="Buka menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="nav-menu">
            <a href="{{ route('dashboard') }}" class="nav-link {{ $isDashboard ? 'active' : '' }}">Dashboard</a>

            <details class="nav-dropdown">
                <summary class="{{ $isData ? 'active' : '' }}">Data</summary>
                <div class="dropdown-box">
                    <a href="{{ route('master-data.produk.index') }}">Data Barang</a>
                    <a href="{{ route('master-data.kategori-produk.index') }}">Kategori Barang</a>
                </div>
            </details>

            <details class="nav-dropdown">
                <summary class="{{ $isTransaksi ? 'active' : '' }}">Transaksi</summary>
                <div class="dropdown-box">
                    <a href="{{ route('master-data.transaksi.masuk') }}">Barang Masuk</a>
                    <a href="{{ route('master-data.transaksi.keluar') }}">Barang Keluar</a>
                </div>
            </details>

            <details class="nav-dropdown">
                <summary class="{{ $isLaporan ? 'active' : '' }}">Laporan</summary>
                <div class="dropdown-box">
                    <a href="{{ route('laporan.index') }}">Laporan</a>

                    @if ($laporanPdfTersedia)
                        <a href="{{ route('laporan.pdf') }}">Cetak PDF</a>
                    @else
                        <span
                            class="dropdown-disabled"
                            aria-disabled="true"
                            title="Tidak ada data laporan untuk dicetak"
                        >Cetak PDF</span>
                    @endif
                </div>
            </details>

            <details class="user-dropdown">
                <summary>
                    <span class="user-info">
                        <span class="user-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21c1.6-5.3 14.4-5.3 16 0"></path>
                            </svg>
                        </span>
                        <span>Hi, {{ auth()->user()->name ?? 'Nama' }}</span>
                    </span>
                </summary>

                <div class="dropdown-box user-menu-only-logout">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </div>
            </details>
        </div>
    </nav>

    <main class="admin-main-content">
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbar = document.getElementById('topNavbar');
            const toggle = document.getElementById('mobileToggle');
            const allDropdowns = document.querySelectorAll('.nav-dropdown, .user-dropdown');

            if (toggle && navbar) {
                toggle.addEventListener('click', function () {
                    navbar.classList.toggle('open');
                });
            }

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
                const clickedMobileToggle = event.target.closest('#mobileToggle');

                if (!clickedInsideDropdown) {
                    allDropdowns.forEach(function (dropdown) {
                        dropdown.removeAttribute('open');
                    });
                }

                if (
                    navbar &&
                    navbar.classList.contains('open') &&
                    !event.target.closest('#topNavbar') &&
                    !clickedMobileToggle
                ) {
                    navbar.classList.remove('open');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
