<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - MyWarehouse</title>

    <!-- Font: Playwrite US Modern + Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+US+Modern:wght@100..400&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
            background: #000;
        }

        .page-wrapper {
            position: relative;
            width: 100%;
            min-height: 100vh;
            overflow: hidden;
            background-color: #000;
        }

        .page-wrapper::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("{{ asset('images/login-bg.jpg') }}");
            background-size: 100% 100%;
            background-position: center center;
            background-repeat: no-repeat;
            z-index: 0;
        }

        .navbar,
        .hero-section {
            position: relative;
            z-index: 1;
        }

        /* NAVBAR */
        .navbar {
            width: 100%;
            height: 102px;
            background: #8fb36b;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: #000;
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

        /* HERO */
        .hero-section {
            min-height: calc(100vh - 102px);
            position: relative;
            padding-top: 12px;
        }

        .hero-card {
            width: 748px;
            height: 493px;
            margin: 0 auto;
            background: rgba(102, 123, 43, 0.76);
            border-radius: 36px;
            padding: 78px 54px 0 54px;
            color: #ffffff;
        }

        .hero-card h1 {
            width: 600px;
            font-family: "Poppins", sans-serif;
            font-size: 34px;
            font-weight: 700;
            line-height: 1.28;
            color: #ffffff;
            margin-bottom: 31px;
        }

        .hero-card p {
            width: 620px;
            font-family: "Poppins", sans-serif;
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
    font-family: "Poppins", sans-serif;
    font-size: 21px;
    font-weight: 400;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

        .start-button:hover {
            background: #345118;
        }

        /* DECORATION BARS */
        .bar {
            position: absolute;
            left: 0;
            height: 37px;
            border-radius: 0 20px 20px 0;
            z-index: 2;
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
                padding: 50px 20px;
            }

            .hero-card {
                width: 100%;
                height: auto;
                min-height: 460px;
                padding: 50px 32px;
            }

            .hero-card h1,
            .hero-card p {
                width: 100%;
            }

            .hero-card h1 {
                font-size: 28px;
            }

            .hero-card p {
                font-size: 20px;
            }

            .bar {
                display: none;
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
                    MyWarehouse merupakan sistem berbasis web
                    yang membantu admin gudang dalam mengelola
                    data inventaris secara lebih efisien dan terstruktur
                </p>

                <a href="{{ route('dashboard') }}" class="start-button">
                    Mulai Sekarang
                </a>
            </div>

            <div class="bar bar-one"></div>
            <div class="bar bar-two"></div>
            <div class="bar bar-three"></div>
        </main>
    </div>
</body>
</html>