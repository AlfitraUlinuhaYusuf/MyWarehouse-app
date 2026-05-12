<!DOCTYPE html>
<html lang="en">
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

    <!-- Bootstrap 4: agar modal/component Laravel kamu tetap jalan -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
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
            background: #ffffff;
            color: #000000;
            font-family: "Poppins", sans-serif;
        }

        :root {
            --green-main: #8fb36b;
            --dropdown-hover: #eef5e8;
        }

        .admin-navbar {
            width: 100%;
            height: 72px;
            background: var(--green-main);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 66px;
            position: relative;
            z-index: 999;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 13px;
            text-decoration: none;
            color: #000000;
        }

        .admin-brand:hover {
            color: #000000;
            text-decoration: none;
        }

        .admin-brand img {
            width: 52px;
            height: 52px;
            object-fit: contain;
        }

        .admin-brand span {
            font-family: "Playwrite US Modern", cursive;
            font-size: 27px;
            font-weight: 400;
            color: #000000;
            letter-spacing: -1px;
            line-height: 1;
        }

        .admin-nav-right {
            display: flex;
            align-items: center;
            gap: 34px;
        }

        .admin-nav-link,
        .admin-dropdown summary {
            color: #000000;
            text-decoration: none;
            font-family: "Poppins", sans-serif;
            font-size: 16px;
            font-weight: 500;
            line-height: 1;
            cursor: pointer;
            list-style: none;
        }

        .admin-nav-link:hover,
        .admin-dropdown summary:hover,
        .admin-user-info:hover {
            color: #000000;
            text-decoration: none;
            opacity: 0.85;
        }

        .admin-dropdown {
            position: relative;
        }

        .admin-dropdown summary::-webkit-details-marker,
        .admin-user-dropdown summary::-webkit-details-marker {
            display: none;
        }

        .admin-dropdown summary::after {
            content: "";
            display: inline-block;
            margin-left: 6px;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #000000;
            vertical-align: middle;
            transition: transform 0.2s ease;
        }

        .admin-dropdown[open] summary::after {
            transform: rotate(180deg);
        }

        .admin-dropdown-menu {
            position: absolute;
            top: 28px;
            right: 0;
            min-width: 178px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.16);
            padding: 8px 0;
            z-index: 1000;
        }

        .admin-dropdown-menu a,
        .admin-dropdown-menu button {
            display: block;
            width: 100%;
            padding: 10px 16px;
            border: none;
            background: transparent;
            color: #000000;
            text-decoration: none;
            font-family: "Poppins", sans-serif;
            font-size: 14px;
            font-weight: 400;
            text-align: left;
            white-space: nowrap;
            cursor: pointer;
        }

        .admin-dropdown-menu a:hover,
        .admin-dropdown-menu button:hover {
            background: var(--dropdown-hover);
            color: #000000;
            text-decoration: none;
        }

        .admin-user-dropdown {
            position: relative;
        }

        .admin-user-dropdown summary {
            list-style: none;
        }

        .admin-user-info {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #000000;
            font-family: "Poppins", sans-serif;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            line-height: 1;
        }

        .admin-user-info::after {
            content: "";
            display: inline-block;
            margin-left: 6px;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #000000;
            transition: transform 0.2s ease;
        }

        .admin-user-dropdown[open] .admin-user-info::after {
            transform: rotate(180deg);
        }

        .admin-user-icon {
            width: 27px;
            height: 27px;
            border: 2px solid #000000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-user-icon svg {
            width: 18px;
            height: 18px;
        }

        .admin-user-dropdown-menu {
            top: 34px;
            right: 0;
            min-width: 178px;
        }

        .admin-user-dropdown-menu form {
            margin: 0;
            padding: 0;
        }

        .admin-main-content {
            width: 100%;
            min-height: calc(100vh - 72px);
            background: #ffffff;
        }

        @media (max-width: 1000px) {
            .admin-navbar {
                height: auto;
                flex-direction: column;
                gap: 18px;
                padding: 18px 24px;
            }

            .admin-nav-right {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }

            .admin-dropdown-menu,
            .admin-user-dropdown-menu {
                top: 30px;
                right: 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <nav class="admin-navbar">
        <a href="{{ route('dashboard') }}" class="admin-brand">
            <img src="{{ asset('images/logo-warehouse.png') }}" alt="MyWarehouse Logo">
            <span>MyWarehouse</span>
        </a>

        <div class="admin-nav-right">
            <a href="{{ route('dashboard') }}" class="admin-nav-link">Dashboard</a>

            <details class="admin-dropdown">
                <summary>Data</summary>
                <div class="admin-dropdown-menu">
                    <a href="{{ route('master-data.produk.index') }}">Data Barang</a>
                    <a href="{{ route('master-data.kategori-produk.index') }}">Kategori Barang</a>
                </div>
            </details>

            <details class="admin-dropdown">
                <summary>Transaksi</summary>
                <div class="admin-dropdown-menu">
                    <a href="{{ route('master-data.transaksi.masuk') }}">Barang Masuk</a>
                    <a href="{{ route('master-data.transaksi.keluar') }}">Barang Keluar</a>
                </div>
            </details>

            <details class="admin-dropdown">
                <summary>Laporan</summary>
                <div class="admin-dropdown-menu">
                    <a href="{{ route('laporan.index') }}">Laporan</a>
                    <a href="{{ route('laporan.pdf') }}">Cetak PDF</a>
                </div>
            </details>

            <details class="admin-user-dropdown">
                <summary class="admin-user-info">
                    <div class="admin-user-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="4"></circle>
                            <path d="M4 21c1.5-5 14.5-5 16 0"></path>
                        </svg>
                    </div>
                    <span>Hi, {{ auth()->user()->name ?? 'Nama' }}</span>
                </summary>

                <div class="admin-dropdown-menu admin-user-dropdown-menu">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </details>
        </div>
    </nav>

    <main class="admin-main-content">
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const allDropdowns = document.querySelectorAll('.admin-dropdown, .admin-user-dropdown');

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
                const clickedInsideDropdown = event.target.closest('.admin-dropdown, .admin-user-dropdown');

                if (!clickedInsideDropdown) {
                    allDropdowns.forEach(function (dropdown) {
                        dropdown.removeAttribute('open');
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>