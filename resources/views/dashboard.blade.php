{{-- Dashboard publish-ready: UI diperhalus, tetap mempertahankan format navbar, 3 card, grafik, dan tabel --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - MyWarehouse</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+US+Modern:wght@100..400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --green-main: #8fb36b;
            --green-dark: #6f9651;
            --green-soft: #edf5e8;
            --green-pale: #f7fbf4;
            --black: #050704;
            --white: #ffffff;
            --border: rgba(0, 0, 0, 0.16);
            --shadow: 0 18px 38px rgba(90, 123, 64, 0.18);
            --shadow-hover: 0 24px 52px rgba(90, 123, 64, 0.26);
            --radius-large: 22px;
            --radius-medium: 18px;
            --danger: #d9342b;
            --danger-soft: #fff0ee;
            --warning: #f0a928;
            --warning-soft: #fff7e4;
            --safe: #558b3f;
            --safe-soft: #edf8eb;
            --table-head: #d4d4d4;
            --table-border: rgba(0, 0, 0, 0.20);
            --text-muted: rgba(5, 7, 4, 0.58);
            --text-soft: rgba(5, 7, 4, 0.72);
            --surface: rgba(255, 255, 255, 0.88);
            --surface-solid: #ffffff;
            --glass-border: rgba(255, 255, 255, 0.58);
            --ring: rgba(143, 179, 107, 0.32);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            background:
                linear-gradient(135deg, #ffffff 0%, #fbfdf8 48%, #f4faef 100%);
            color: var(--black);
            font-family: "Poppins", sans-serif;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: -2;
            pointer-events: none;
            background:
                radial-gradient(circle at 10% 14%, rgba(143, 179, 107, 0.18), transparent 24%),
                radial-gradient(circle at 90% 18%, rgba(111, 150, 81, 0.10), transparent 22%),
                radial-gradient(circle at 84% 86%, rgba(143, 179, 107, 0.16), transparent 27%),
                radial-gradient(circle at 18% 88%, rgba(240, 169, 40, 0.08), transparent 24%);
            animation: ambientMove 13s ease-in-out infinite alternate;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;
            opacity: 0.34;
            background-image:
                linear-gradient(rgba(111, 150, 81, 0.055) 1px, transparent 1px),
                linear-gradient(90deg, rgba(111, 150, 81, 0.055) 1px, transparent 1px);
            background-size: 34px 34px;
            mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.72), transparent 82%);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
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

        @keyframes ambientMove {
            from {
                transform: translate3d(0, 0, 0) scale(1);
                filter: saturate(1);
            }
            to {
                transform: translate3d(0, -14px, 0) scale(1.025);
                filter: saturate(1.08);
            }
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes softFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-8px);
            }
        }

        @keyframes shineMove {
            from {
                transform: translateX(-135%) rotate(18deg);
            }
            to {
                transform: translateX(155%) rotate(18deg);
            }
        }

        @keyframes pulseDot {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.55;
                transform: scale(1.25);
            }
        }

        @keyframes pulseRing {
            0% {
                opacity: 0.65;
                transform: scale(0.72);
            }
            70%, 100% {
                opacity: 0;
                transform: scale(1.42);
            }
        }

        @keyframes warningFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-3px);
            }
        }

        @keyframes progressIn {
            from {
                width: 0;
            }
        }

        @keyframes subtleGlow {
            0%, 100% {
                box-shadow: 0 12px 30px rgba(90, 123, 64, 0.12);
            }
            50% {
                box-shadow: 0 18px 46px rgba(90, 123, 64, 0.18);
            }
        }

        @keyframes rowIn {
            from {
                opacity: 0;
                transform: translateX(-12px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* =========================
           NAVBAR FORMAT GAMBAR
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
            animation: fadeDown 0.55s ease both;
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
            transition: transform 0.22s ease, background 0.22s ease, opacity 0.22s ease, box-shadow 0.22s ease;
        }

        .nav-link {
            padding: 0 4px;
        }

        .nav-link:hover,
        .nav-dropdown summary:hover,
        .user-dropdown summary:hover {
            transform: translateY(-2px);
            opacity: 0.88;
        }

        .nav-link.active {
            font-weight: 700;
            background: rgba(255, 255, 255, 0.18);
            padding: 0 14px;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.16);
        }

        .nav-link.active::after {
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
            box-shadow: 0 22px 52px rgba(47, 68, 35, 0.20);
            backdrop-filter: blur(12px);
            animation: fadeUp 0.22s ease both;
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
            text-align: left;
            white-space: nowrap;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .dropdown-box a:hover,
        .dropdown-box button:hover {
            background: var(--green-soft);
            transform: translateX(3px);
        }

        .dropdown-disabled {
            color: rgba(0, 0, 0, 0.4);
            cursor: not-allowed;
            pointer-events: none;
            user-select: none;
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

        /* =========================
           DASHBOARD FORMAT GAMBAR
        ========================= */
        .dashboard-container {
            width: min(100% - 132px, 1160px);
            margin: 34px auto 54px;
        }

        .page-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            margin: 0 0 26px 8px;
            animation: fadeUp 0.55s ease both;
        }

        .eyebrow {
            margin-bottom: 5px;
            color: var(--green-dark);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2.6px;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            font-size: clamp(24px, 3vw, 32px);
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .page-subtitle {
            margin-top: 5px;
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 500;
        }

        .page-status-card {
            min-width: 198px;
            padding: 12px 15px;
            border: 1px solid rgba(111, 150, 81, 0.16);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.76);
            box-shadow: 0 14px 34px rgba(90, 123, 64, 0.12);
            backdrop-filter: blur(10px);
            display: grid;
            grid-template-columns: 38px 1fr;
            column-gap: 10px;
            align-items: center;
        }

        .page-status-icon {
            grid-row: span 2;
            width: 38px;
            height: 38px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--green-soft);
            color: var(--green-dark);
            box-shadow: inset 0 0 0 1px rgba(111, 150, 81, 0.12);
        }

        .page-status-icon svg {
            width: 21px;
            height: 21px;
        }

        .page-status-card span {
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.1;
        }

        .page-status-card strong {
            font-size: 13px;
            font-weight: 800;
            line-height: 1.2;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 30px;
            margin-bottom: 34px;
        }

        .summary-card {
            min-height: 138px;
            padding: 18px 22px;
            border-radius: 24px;
            background: linear-gradient(135deg, #99bd78 0%, var(--green-main) 56%, #7fa35f 100%);
            box-shadow: 0 16px 34px rgba(90, 123, 64, 0.16);
            position: relative;
            overflow: hidden;
            color: #000000;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            isolation: isolate;
            animation: fadeUp 0.65s ease both;
            border: 1px solid rgba(255, 255, 255, 0.28);
            transform: perspective(900px) rotateX(var(--tilt-x, 0deg)) rotateY(var(--tilt-y, 0deg)) translateY(0);
            transition: transform 0.28s ease, box-shadow 0.28s ease, filter 0.28s ease;
        }

        .summary-card:nth-child(2) {
            animation-delay: 0.07s;
        }

        .summary-card:nth-child(3) {
            animation-delay: 0.14s;
        }

        .summary-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(105deg, transparent 0%, rgba(255, 255, 255, 0.26) 42%, transparent 62%);
            transform: translateX(-135%) rotate(18deg);
            z-index: -1;
        }

        .summary-card::after {
            content: "";
            position: absolute;
            width: 145px;
            height: 145px;
            right: -55px;
            bottom: -58px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            z-index: -1;
            transition: transform 0.3s ease;
        }

        .summary-card:hover {
            transform: perspective(900px) rotateX(var(--tilt-x, 0deg)) rotateY(var(--tilt-y, 0deg)) translateY(-7px);
            box-shadow: var(--shadow-hover);
            filter: saturate(1.04);
        }

        .summary-card:hover::before {
            animation: shineMove 0.85s ease forwards;
        }

        .summary-card:hover::after {
            transform: scale(1.18);
        }

        .summary-label {
            margin-bottom: 10px;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1.2px;
        }

        .summary-number {
            font-size: 34px;
            font-weight: 800;
            letter-spacing: 2px;
            line-height: 1;
        }

        .summary-meta {
            margin-top: 16px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.3px;
            color: rgba(0, 0, 0, 0.58);
            transition: transform 0.22s ease, color 0.22s ease;
        }

        .summary-card:hover .summary-meta {
            color: rgba(0, 0, 0, 0.82);
            transform: translateX(4px);
        }

        .summary-icon {
            width: 48px;
            height: 48px;
            margin-top: 2px;
            border: 1.5px solid rgba(255, 255, 255, 0.26);
            border-radius: 17px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.22);
            opacity: 0.72;
            animation: softFloat 3.8s ease-in-out infinite;
        }

        .summary-icon svg {
            width: 24px;
            height: 24px;
        }

        .panel {
            width: 100%;
            background: linear-gradient(135deg, #98bc77 0%, var(--green-main) 58%, #7fa35f 100%);
            border-radius: 24px;
            position: relative;
            animation: fadeUp 0.7s ease both, subtleGlow 6s ease-in-out infinite;
            box-shadow: 0 12px 30px rgba(90, 123, 64, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.24);
            overflow: hidden;
        }

        .panel::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: linear-gradient(110deg, rgba(255, 255, 255, 0.18), transparent 34%, transparent 70%, rgba(255, 255, 255, 0.08));
        }

        .chart-panel {
            min-height: 420px;
            padding: 20px 16px 22px;
            margin-bottom: 30px;
        }

        .panel-heading {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin: 0 4px 16px 8px;
        }

        .panel-title {
            margin: 0;
            color: #000000;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 1.6px;
        }

        .panel-subtitle {
            margin-top: 4px;
            color: rgba(0, 0, 0, 0.62);
            font-size: 13px;
            font-weight: 600;
        }

        .panel-chip {
            min-height: 34px;
            padding: 8px 13px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.34);
            border: 1px solid rgba(255, 255, 255, 0.28);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.12);
            color: rgba(0, 0, 0, 0.70);
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .chart-area {
            width: 100%;
            height: 320px;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(251, 253, 249, 0.98));
            border-radius: 18px;
            border: 1px solid rgba(255, 255, 255, 0.76);
            box-shadow: inset 0 0 0 1px rgba(63, 97, 27, 0.06), 0 14px 30px rgba(63, 97, 27, 0.10);
            position: relative;
            overflow: hidden;
        }

        .chart-area::before,
        .chart-area::after {
            content: "";
            position: absolute;
            left: -10%;
            top: 50%;
            width: 120%;
            height: 1px;
            background: rgba(0, 0, 0, 0.14);
            pointer-events: none;
            opacity: 0;
        }

        .chart-area.empty::before {
            opacity: 1;
            transform: rotate(16deg);
        }

        .chart-area.empty::after {
            opacity: 1;
            transform: rotate(-16deg);
        }

        #stockChart {
            width: 100% !important;
            height: 100% !important;
            padding: 12px 14px 8px;
        }

        .empty-chart-text {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            color: rgba(0, 0, 0, 0.52);
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(1px);
            z-index: 2;
        }

        .stock-panel {
            padding: 22px;
            overflow: hidden;
        }

        .stock-panel::before {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            left: -68px;
            bottom: -92px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.13);
            animation: softFloat 6.5s ease-in-out infinite;
            pointer-events: none;
        }

        .stock-panel::after {
            content: "";
            position: absolute;
            width: 130px;
            height: 130px;
            right: -48px;
            top: -52px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.10);
            animation: softFloat 7.2s ease-in-out infinite reverse;
            pointer-events: none;
        }

        .stock-inner {
            width: 100%;
            min-height: 335px;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(255, 255, 255, 0.82);
            border-radius: 18px;
            padding: 18px 20px 30px;
            position: relative;
            z-index: 2;
            box-shadow: inset 0 0 0 1px rgba(63, 97, 27, 0.04);
        }

        .stock-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .stock-title {
            font-size: 20px;
            font-weight: 700;
            color: #000000;
            margin: 0;
        }

        .stock-subtitle {
            margin-top: 4px;
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 500;
        }

        .stock-warning-badge,
        .stock-ok-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 30px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.2px;
            white-space: nowrap;
        }

        .stock-warning-badge {
            background: var(--danger-soft);
            border: 1px solid rgba(217, 52, 43, 0.24);
            color: var(--danger);
            animation: warningFloat 2.4s ease-in-out infinite;
        }

        .stock-ok-badge {
            background: var(--safe-soft);
            border: 1px solid rgba(85, 139, 63, 0.22);
            color: var(--safe);
        }

        .warning-dot,
        .ok-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            position: relative;
            flex-shrink: 0;
        }

        .warning-dot {
            background: var(--danger);
        }

        .ok-dot {
            background: var(--safe);
        }

        .warning-dot::after,
        .ok-dot::after {
            content: "";
            position: absolute;
            inset: -5px;
            border-radius: 50%;
            animation: pulseRing 1.8s ease-out infinite;
        }

        .warning-dot::after {
            background: rgba(217, 52, 43, 0.22);
        }

        .ok-dot::after {
            background: rgba(85, 139, 63, 0.22);
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border-radius: 18px;
            border: 1px solid rgba(90, 123, 64, 0.16);
            background: linear-gradient(180deg, #ffffff 0%, #fbfdf9 100%);
            box-shadow: 0 12px 26px rgba(63, 97, 27, 0.08);
            scrollbar-width: thin;
            scrollbar-color: rgba(111, 150, 81, 0.46) transparent;
        }

        .stock-table {
            width: 100%;
            min-width: 760px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            color: #000000;
            background: transparent;
        }

        .stock-table th,
        .stock-table td {
            text-align: center;
            padding: 14px 14px;
            min-height: 46px;
            vertical-align: middle;
            font-weight: 400;
            border-bottom: 1px solid rgba(90, 123, 64, 0.14);
        }

        .stock-table thead th {
            position: sticky;
            top: 0;
            z-index: 1;
            background: linear-gradient(180deg, #edf3e8 0%, #dfe9d7 100%);
            color: #1e2b17;
            font-weight: 700;
            letter-spacing: 0.15px;
        }

        .stock-table thead th:not(:last-child),
        .stock-table tbody td:not(:last-child) {
            border-right: 1px solid rgba(90, 123, 64, 0.12);
        }

        .stock-table tbody tr {
            animation: rowIn 0.45s ease both;
            transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stock-table tbody tr:nth-child(even) {
            background: rgba(247, 251, 244, 0.62);
        }

        .stock-table tbody tr:nth-child(2) { animation-delay: 0.03s; }
        .stock-table tbody tr:nth-child(3) { animation-delay: 0.06s; }
        .stock-table tbody tr:nth-child(4) { animation-delay: 0.09s; }
        .stock-table tbody tr:nth-child(5) { animation-delay: 0.12s; }
        .stock-table tbody tr:nth-child(6) { animation-delay: 0.15s; }
        .stock-table tbody tr:nth-child(7) { animation-delay: 0.18s; }

        .stock-table tbody tr:hover {
            background: #f1f8ec;
            transform: translateY(-1px);
            box-shadow: inset 4px 0 0 var(--green-main);
        }

        .stock-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .col-no {
            width: 64px;
        }

        .col-category {
            width: 28%;
        }

        .col-name {
            width: 48%;
        }

        .col-stock {
            width: 150px;
        }

        .text-left {
            text-align: left !important;
        }

        .stock-category {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            max-width: 100%;
            padding: 6px 12px;
            border-radius: 999px;
            background: linear-gradient(135deg, #eef6e8, #ffffff);
            border: 1px solid rgba(111, 150, 81, 0.22);
            font-size: 13px;
            font-weight: 700;
            color: var(--green-dark);
            box-shadow: 0 5px 12px rgba(90, 123, 64, 0.08);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .stock-category::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--green-main);
            box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.14);
            flex-shrink: 0;
        }

        .stock-value-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .stock-value {
            min-width: 34px;
            height: 26px;
            border-radius: 8px;
            background: #f3f3f3;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #000000;
        }

        .stock-bar-track {
            width: 48px;
            height: 7px;
            background: #eeeeee;
            border-radius: 999px;
            overflow: hidden;
        }

        .stock-bar-fill {
            height: 100%;
            border-radius: 999px;
            animation: progressIn 0.9s ease both;
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

        .empty-row {
            height: 210px !important;
            color: rgba(0, 0, 0, 0.55);
            font-size: 15px;
            padding: 18px 12px;
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

            .dashboard-container {
                width: min(100% - 48px, 1100px);
            }

            .page-heading {
                margin-left: 0;
            }

            .summary-grid {
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

            .dropdown-box {
                position: static;
                margin-top: 6px;
                box-shadow: none;
            }

            .page-heading {
                align-items: stretch;
                flex-direction: column;
            }

            .page-status-card {
                width: 100%;
            }

            .panel-heading {
                flex-direction: column;
                gap: 8px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .summary-card {
                min-height: 118px;
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

            .dashboard-container {
                width: min(100% - 28px, 1100px);
                margin-top: 24px;
            }

            .page-title {
                margin-left: 0;
                font-size: 22px;
            }

            .chart-panel {
                min-height: 340px;
            }

            .chart-area {
                height: 255px;
            }

            .stock-panel {
                padding: 14px;
            }

            .stock-inner {
                padding: 14px 10px 20px;
            }

            .stock-title {
                font-size: 17px;
            }

            .stock-table {
                min-width: 680px;
            }

            .stock-table th,
            .stock-table td {
                padding: 11px 10px;
            }

            .col-stock {
                width: 120px;
            }
        }
    </style>
</head>
<body>
    @php
        $labels = isset($chartLabels) && is_array($chartLabels) ? $chartLabels : [];
        $stocks = isset($chartStocks) && is_array($chartStocks) ? $chartStocks : [];
        $hasChart = count($labels) > 0 && count($stocks) > 0;
        $stokItems = isset($stokMinimum) ? collect($stokMinimum)->values() : collect();

        /*
            Status Cetak PDF harus mengikuti data laporan bulanan,
            bukan total kategori atau total stok di dashboard.
            Controller Dashboard mengirim $laporanPdfTersedia berdasarkan transaksi 1 bulan terakhir.
        */
        $laporanPdfTersedia = $laporanPdfTersedia ?? \App\Models\Transaksi::where('created_at', '>=', now()->subMonth())->exists();
    @endphp

    <nav class="top-navbar" id="topNavbar">
        <a href="{{ route('home') }}" class="brand" aria-label="MyWarehouse">
            <img src="{{ asset('images/logo-warehouse.png') }}" alt="MyWarehouse Logo">
            <span>MyWarehouse</span>
        </a>

        <button type="button" class="mobile-toggle" id="mobileToggle" aria-label="Buka menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="nav-menu">
            <a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a>

            <details class="nav-dropdown">
                <summary>Data</summary>
                <div class="dropdown-box">
                    <a href="{{ route('master-data.produk.index') }}">Data Barang</a>
                    <a href="{{ route('master-data.kategori-produk.index') }}">Kategori Barang</a>
                </div>
            </details>

            <details class="nav-dropdown">
                <summary>Transaksi</summary>
                <div class="dropdown-box">
                    <a href="{{ route('master-data.transaksi.masuk') }}">Barang Masuk</a>
                    <a href="{{ route('master-data.transaksi.keluar') }}">Barang Keluar</a>
                </div>
            </details>

            <details class="nav-dropdown">
                <summary>Laporan</summary>
                <div class="dropdown-box">
                    <a href="{{ route('laporan.index') }}">Laporan</a>
                    @if ($laporanPdfTersedia)
                        <a href="{{ route('laporan.pdf') }}">Cetak PDF</a>
                    @else
                        <span
                            class="dropdown-disabled"
                            role="link"
                            aria-disabled="true"
                            tabindex="-1"
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

    <main class="dashboard-container">
        <div class="page-heading">
            <div>
                <p class="eyebrow">Warehouse Overview</p>
                <h1 class="page-title">DASHBOARD</h1>
                <p class="page-subtitle">Pantau ringkasan aktivitas barang dan kondisi stok terbaru anda secara cepat.</p>
            </div>

            <div class="page-status-card" aria-label="Status sistem">
                <span class="page-status-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3v4"></path>
                        <path d="M12 17v4"></path>
                        <path d="M3 12h4"></path>
                        <path d="M17 12h4"></path>
                        <circle cx="12" cy="12" r="4"></circle>
                    </svg>
                </span>
                <span>Status Sistem</span>
                <strong>Aktif · {{ now()->format('d M Y') }}</strong>
            </div>
        </div>

        <section class="summary-grid" aria-label="Ringkasan dashboard">
            <a href="{{ route('master-data.kategori-produk.index') }}" class="summary-card">
                <div>
                    <p class="summary-label">Kategori Barang</p>
                    <p class="summary-number js-counter" data-target="{{ (int) ($totalKategoriBarang ?? 0) }}">{{ (int) ($totalKategoriBarang ?? 0) }}</p>
                    <span class="summary-meta">Kelola kategori →</span>
                </div>
                <span class="summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16"></path>
                        <path d="M4 12h16"></path>
                        <path d="M4 18h16"></path>
                    </svg>
                </span>
            </a>

            <a href="{{ route('master-data.transaksi.masuk') }}" class="summary-card">
                <div>
                    <p class="summary-label">Barang Masuk</p>
                    <p class="summary-number js-counter" data-target="{{ (int) ($totalBarangMasuk ?? 0) }}">{{ (int) ($totalBarangMasuk ?? 0) }}</p>
                    <span class="summary-meta">Lihat transaksi →</span>
                </div>
                <span class="summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3v12"></path>
                        <path d="m7 10 5 5 5-5"></path>
                        <path d="M4 21h16"></path>
                    </svg>
                </span>
            </a>

            <a href="{{ route('master-data.transaksi.keluar') }}" class="summary-card">
                <div>
                    <p class="summary-label">Barang Keluar</p>
                    <p class="summary-number js-counter" data-target="{{ (int) ($totalBarangKeluar ?? 0) }}">{{ (int) ($totalBarangKeluar ?? 0) }}</p>
                    <span class="summary-meta">Cek barang keluar →</span>
                </div>
                <span class="summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 21V9"></path>
                        <path d="m7 14 5-5 5 5"></path>
                        <path d="M4 3h16"></path>
                    </svg>
                </span>
            </a>
        </section>

        <section class="panel chart-panel">
            <div class="panel-heading">
                <div>
                    <h2 class="panel-title">Grafik Stok Barang</h2>
                    <p class="panel-subtitle">Visualisasi pergerakan stok yang memudahkan pemantauan persediaan.</p>
                </div>
                <span class="panel-chip">{{ count($labels) }} item tercatat</span>
            </div>
            <div class="chart-area {{ $hasChart ? '' : 'empty' }}">
                <canvas id="stockChart"></canvas>
                @if (!$hasChart)
                    <div class="empty-chart-text">Belum ada data stok barang untuk ditampilkan.</div>
                @endif
            </div>
        </section>

        <section class="panel stock-panel">
            <div class="stock-inner">
                <div class="stock-title-row">
                    <div>
                        <h2 class="stock-title">Stok mencapai batas minimum</h2>
                        <p class="stock-subtitle">Barang yang perlu dipantau agar tidak mengganggu operasional gudang.</p>
                    </div>

                    @if ($stokItems->count() > 0)
                        <div class="stock-warning-badge" title="Ada barang yang stoknya mencapai batas minimum">
                            <span class="warning-dot"></span>
                            <span>{{ $stokItems->count() }} barang perlu diperhatikan</span>
                        </div>
                    @else
                        <div class="stock-ok-badge" title="Semua stok masih aman">
                            <span class="ok-dot"></span>
                            <span>Stok aman</span>
                        </div>
                    @endif
                </div>

                <div class="table-wrap">
                    <table class="stock-table">
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th class="col-category">Kategori Barang</th>
                                <th class="col-name">Nama Barang</th>
                                <th class="col-stock">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stokItems as $index => $item)
                                @php
                                    $stokValue = (int) data_get($item, 'stok', 0);
                                    $stokPercent = $stokValue <= 0 ? 6 : min(100, max(10, $stokValue * 18));

                                    if ($stokValue <= 2) {
                                        $stockLevelClass = 'stock-low';
                                    } elseif ($stokValue <= 5) {
                                        $stockLevelClass = 'stock-warning';
                                    } else {
                                        $stockLevelClass = 'stock-safe';
                                    }

                                    $kategoriBarang = data_get($item, 'kategori.nama_kategori')
                                        ?? data_get($item, 'kategori_produk.nama_kategori')
                                        ?? data_get($item, 'nama_kategori')
                                        ?? data_get($item, 'kategori')
                                        ?? 'Tanpa Kategori';

                                    $namaBarang = data_get($item, 'nama_barang')
                                        ?? data_get($item, 'nama_produk')
                                        ?? data_get($item, 'nama')
                                        ?? '-';
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><span class="stock-category" title="{{ $kategoriBarang }}">{{ $kategoriBarang }}</span></td>
                                    <td class="text-left">{{ $namaBarang }}</td>
                                    <td>
                                        <div class="stock-value-wrap">
                                            <span class="stock-value">{{ $stokValue }}</span>
                                            <div class="stock-bar-track" title="Stok {{ $stokValue }}">
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
                                    <td colspan="4" class="empty-row">Semua stok masih aman. Tidak ada barang yang mencapai batas minimum.</td>
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
        document.addEventListener('DOMContentLoaded', function () {
            const navbar = document.getElementById('topNavbar');
            const toggle = document.getElementById('mobileToggle');

            if (toggle && navbar) {
                toggle.addEventListener('click', function () {
                    navbar.classList.toggle('open');
                });
            }

            document.querySelectorAll('details').forEach(function (detail) {
                detail.addEventListener('toggle', function () {
                    if (detail.open) {
                        document.querySelectorAll('details').forEach(function (otherDetail) {
                            if (otherDetail !== detail) {
                                otherDetail.removeAttribute('open');
                            }
                        });
                    }
                });
            });

            document.addEventListener('click', function (event) {
                if (!event.target.closest('details')) {
                    document.querySelectorAll('details[open]').forEach(function (detail) {
                        detail.removeAttribute('open');
                    });
                }
            });


            document.querySelectorAll('.summary-card').forEach(function (card) {
                card.addEventListener('mousemove', function (event) {
                    const rect = card.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;
                    const rotateY = ((x / rect.width) - 0.5) * 5;
                    const rotateX = -(((y / rect.height) - 0.5) * 5);
                    card.style.setProperty('--tilt-x', rotateX.toFixed(2) + 'deg');
                    card.style.setProperty('--tilt-y', rotateY.toFixed(2) + 'deg');
                });

                card.addEventListener('mouseleave', function () {
                    card.style.setProperty('--tilt-x', '0deg');
                    card.style.setProperty('--tilt-y', '0deg');
                });
            });

            document.querySelectorAll('.js-counter').forEach(function (counter) {
                const target = Number(counter.dataset.target || 0);
                const duration = 900;
                const startTime = performance.now();

                function animateCounter(now) {
                    const progress = Math.min((now - startTime) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    counter.textContent = Math.round(target * eased).toLocaleString('id-ID');

                    if (progress < 1) {
                        requestAnimationFrame(animateCounter);
                    }
                }

                requestAnimationFrame(animateCounter);
            });

            const canvas = document.getElementById('stockChart');
            const labels = @json($labels);
            const stocks = @json($stocks);

            if (canvas && Array.isArray(labels) && labels.length > 0 && Array.isArray(stocks) && stocks.length > 0 && window.Chart) {
                const ctx = canvas.getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 310);
                gradient.addColorStop(0, 'rgba(143, 179, 107, 0.55)');
                gradient.addColorStop(1, 'rgba(143, 179, 107, 0.05)');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Stok Barang',
                            data: stocks,
                            borderColor: '#6f9651',
                            backgroundColor: gradient,
                            fill: true,
                            borderWidth: 3,
                            pointRadius: 5,
                            pointHoverRadius: 8,
                            pointBackgroundColor: '#8fb36b',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            tension: 0.42
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 1150,
                            easing: 'easeOutQuart'
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.82)',
                                padding: 12,
                                cornerRadius: 10,
                                titleFont: {
                                    family: 'Poppins',
                                    size: 13,
                                    weight: '600'
                                },
                                bodyFont: {
                                    family: 'Poppins',
                                    size: 12
                                },
                                callbacks: {
                                    label: function (context) {
                                        return ' Stok: ' + Number(context.parsed.y || 0).toLocaleString('id-ID');
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#29331f',
                                    font: {
                                        family: 'Poppins',
                                        size: 12
                                    },
                                    maxRotation: 0,
                                    autoSkip: true,
                                    maxTicksLimit: 7
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.08)'
                                },
                                ticks: {
                                    color: '#29331f',
                                    precision: 0,
                                    font: {
                                        family: 'Poppins',
                                        size: 12
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
