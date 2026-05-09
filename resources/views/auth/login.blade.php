<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyWarehouse</title>

    <!-- Google Font: Playwrite US Modern + Poppins -->
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
            filter: blur(2px);
            transform: scale(1.02);
            z-index: 0;
        }

        .navbar,
        .content {
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

        /* CONTENT */
        .content {
            min-height: calc(100vh - 102px);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 154px;
        }

        .login-card {
            width: 790px;
            height: 516px;
            background: linear-gradient(
                to bottom,
                #ffffff 0%,
                #ffffff 67%,
                #d8ffd4 100%
            );
            border-radius: 42px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.22);
        }

        .login-header {
            width: 100%;
            height: 101px;
            background: #3f611b;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-header h1 {
            font-family: "Poppins", sans-serif;
            color: #ffffff;
            font-size: 31px;
            font-weight: 800;
            letter-spacing: 0.5px;
            line-height: 1;
        }

        .login-body {
            padding: 31px 58px 0 58px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-family: "Poppins", sans-serif;
            font-size: 26px;
            font-weight: 400;
            color: #111111;
            margin-bottom: 22px;
            line-height: 1;
        }

        .form-control {
            width: 100%;
            height: 60px;
            border: none;
            outline: none;
            border-radius: 12px;
            background: #d9d9d9;
            padding: 0 18px;
            font-family: "Poppins", sans-serif;
            font-size: 21px;
            font-weight: 400;
            color: #111111;
        }

        .form-control:focus {
            outline: 2px solid #3f611b;
            background: #dedede;
        }

        .error-text {
            font-family: "Poppins", sans-serif;
            color: #b91c1c;
            font-size: 13px;
            margin-top: 8px;
        }

        .login-button-wrap {
            display: flex;
            justify-content: center;
            margin-top: 25px;
        }

        .login-button {
            width: 212px;
            height: 55px;
            border: none;
            border-radius: 11px;
            background: #3f611b;
            color: #ffffff;
            font-family: "Poppins", sans-serif;
            font-size: 20px;
            font-weight: 400;
            cursor: pointer;
            line-height: 1;
        }

        .login-button:hover {
            background: #345118;
        }

        .session-status {
            margin-bottom: 18px;
            padding: 10px 14px;
            background: #dcfce7;
            color: #166534;
            border-radius: 8px;
            font-size: 14px;
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

            .content {
                padding: 70px 20px;
            }

            .login-card {
                width: 100%;
                max-width: 790px;
                height: auto;
                min-height: 500px;
            }

            .login-body {
                padding: 32px 35px;
            }

            .form-group label {
                font-size: 23px;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <nav class="navbar">
            <a href="{{ route('login') }}" class="brand">
                <img src="{{ asset('images/logo-warehouse.png') }}" alt="MyWarehouse Logo">
                <span>MyWarehouse</span>
            </a>
        </nav>

        <main class="content">
            <div class="login-card">
                <div class="login-header">
                    <h1>LOGIN</h1>
                </div>

                <div class="login-body">
                    @if (session('status'))
                        <div class="session-status">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control"
                                required
                                autofocus
                                autocomplete="username"
                            >

                            @error('email')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control"
                                required
                                autocomplete="current-password"
                            >

                            @error('password')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="login-button-wrap">
                            <button type="submit" class="login-button">
                                LOGIN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>