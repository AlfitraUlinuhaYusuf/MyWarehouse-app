<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - MyWarehouse</title>

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
            background: #000000;
        }

        body {
            overflow-x: hidden;
        }

        .page-wrapper {
            position: relative;
            width: 100%;
            min-height: 100vh;
            overflow: hidden;
            background-color: #000000;
        }

        .page-wrapper::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("{{ asset('images/login-bg.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 0;
        }

        .page-wrapper::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.12);
            z-index: 0;
            pointer-events: none;
        }

        .navbar,
        .hero-section {
            position: relative;
            z-index: 2;
        }

        /* Navbar */
        .navbar {
            width: 100%;
            height: 102px;
            background: #8fb36b;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.16);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: #000000;
        }

        .brand img {
            width: 68px;
            height: 68px;
            object-fit: contain;
        }

        .brand span {
            font-family: "Playwrite US Modern", cursive;
            font-size: 34px;
            font-weight: 400;
            color: #000000;
            line-height: 1;
            letter-spacing: -1px;
        }

        /* Hero */
        .hero-section {
            min-height: calc(100vh - 102px);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 12px 20px 80px;
        }

        .hero-card {
            width: 748px;
            min-height: 493px;
            margin: 0 auto;
            background: rgba(102, 123, 43, 0.76);
            border-radius: 36px;
            padding: 78px 54px 54px;
            color: #ffffff;
            box-shadow: 0 26px 60px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(2px);
            animation: fadeUp 0.8s ease forwards;
        }

        .hero-card h1 {
            max-width: 600px;
            font-size: 34px;
            font-weight: 700;
            line-height: 1.28;
            color: #ffffff;
            margin-bottom: 31px;
        }

        .hero-card p {
            max-width: 620px;
            font-size: 26px;
            font-weight: 400;
            line-height: 1.55;
            color: #ffffff;
            margin-bottom: 27px;
        }

        .start-button {
            width: 252px;
            height: 44px;
            background: #8ab13c;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 21px;
            font-weight: 400;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: 0.25s ease;
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.16);
        }

        .start-button:hover {
            background: #345118;
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.22);
        }

        .start-button:active {
            transform: translateY(0);
        }

        /* Decoration Bars */
        .bar {
            position: absolute;
            left: 0;
            height: 37px;
            border-radius: 0 20px 20px 0;
            z-index: 1;
            pointer-events: none;
        }

        .bar-one {
            top: 510px;
            width: 950px;
            background: rgba(232, 198, 150, 0.77);
        }

        .bar-two {
            top: 607px;
            width: 1150px;
            background: rgba(63, 97, 27, 0.78);
        }

        .bar-three {
            top: 705px;
            width: 1400px;
            background: rgba(174, 196, 82, 0.72);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 900px) {
            .navbar {
                height: 92px;
            }

            .brand img {
                width: 58px;
                height: 58px;
            }

            .brand span {
                font-size: 28px;
            }

            .hero-section {
                min-height: calc(100vh - 92px);
                padding: 50px 20px;
                align-items: center;
            }

            .hero-card {
                width: 100%;
                max-width: 680px;
                min-height: 460px;
                padding: 50px 32px;
            }

            .hero-card h1 {
                max-width: 100%;
                font-size: 28px;
            }

            .hero-card p {
                max-width: 100%;
                font-size: 20px;
            }

            .bar {
                display: none;
            }
        }

        @media (max-width: 520px) {
            .navbar {
                height: 82px;
            }

            .brand {
                gap: 10px;
            }

            .brand img {
                width: 48px;
                height: 48px;
            }

            .brand span {
                font-size: 22px;
            }

            .hero-section {
                padding: 34px 16px;
            }

            .hero-card {
                border-radius: 26px;
                padding: 38px 24px;
                min-height: auto;
            }

            .hero-card h1 {
                font-size: 25px;
                margin-bottom: 22px;
            }

            .hero-card p {
                font-size: 17px;
                line-height: 1.7;
                margin-bottom: 26px;
            }

            .start-button {
                width: 100%;
                height: 46px;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <nav class="navbar">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/logo-warehouse.png') }}" alt="MyWarehouse Logo">
                <span>MyWarehouse</span>
            </a>
        </nav>

        <main class="hero-section">
            <div class="hero-card">
                <h1>Solusi untuk kebutuhan manajemen gudang anda</h1>

                <p>
                    MyWarehouse merupakan sistem berbasis web yang membantu admin gudang
                    dalam mengelola data inventaris secara lebih efisien dan terstruktur.
                </p>

                @auth
                    <a href="{{ route('dashboard') }}" class="start-button">
                        Masuk Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="start-button">
                        Mulai Sekarang
                    </a>
                @endauth
            </div>

            <div class="bar bar-one"></div>
            <div class="bar bar-two"></div>
            <div class="bar bar-three"></div>
        </main>
    </div>
</body>
</html>