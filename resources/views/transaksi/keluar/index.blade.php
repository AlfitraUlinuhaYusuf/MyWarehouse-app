@extends('layouts.admin')

@section('content')
<style>
    :root {
        --mw-green: #8fb36b;
        --mw-green-dark: #5f823f;
        --mw-green-soft: #eef6e7;
        --mw-red: #ff5c5c;
        --mw-red-dark: #c62828;
        --mw-red-soft: #fff0f0;
        --mw-blue: #405565;
        --mw-text: #121212;
        --mw-muted: #6e746b;
        --mw-line: #dfe5db;
        --mw-card: rgba(255, 255, 255, 0.92);
        --mw-shadow: 0 18px 45px rgba(32, 47, 24, 0.10);
    }

    .keluar-page,
    .keluar-page * {
        box-sizing: border-box;
    }

    .keluar-page {
        width: 100%;
        min-height: calc(100vh - 72px);
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at 96% 18%, rgba(143, 179, 107, 0.18) 0 115px, transparent 116px),
            radial-gradient(circle at 12% 92%, rgba(143, 179, 107, 0.11) 0 150px, transparent 151px),
            linear-gradient(180deg, #ffffff 0%, #fbfdf8 100%);
        padding: 44px 46px 72px;
        font-family: "Poppins", sans-serif;
        color: var(--mw-text);
        animation: pageFadeIn 0.55s ease both;
    }

    .keluar-page::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        right: -180px;
        top: 160px;
        border-radius: 50%;
        background: rgba(143, 179, 107, 0.09);
        animation: floatBlob 7s ease-in-out infinite;
        pointer-events: none;
    }

    .keluar-page::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        left: -70px;
        bottom: 80px;
        border-radius: 50%;
        border: 34px solid rgba(143, 179, 107, 0.08);
        animation: rotateSoft 12s linear infinite;
        pointer-events: none;
    }

    @keyframes pageFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes floatBlob {
        0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
        50% { transform: translate3d(-18px, 24px, 0) scale(1.04); }
    }

    @keyframes rotateSoft {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .keluar-header {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 34px;
    }

    .title-area {
        min-width: 0;
    }

    .keluar-title {
        position: relative;
        width: fit-content;
        margin: 0 0 10px;
        font-size: 31px;
        font-weight: 700;
        letter-spacing: 0.1px;
        text-transform: uppercase;
        color: #111111;
        animation: titleSlide 0.55s ease both;
    }

    .keluar-title::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -7px;
        width: 56px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--mw-green), #b7e68d);
        animation: underlineGrow 0.75s 0.2s ease both;
    }

    .keluar-subtitle {
        margin: 0;
        color: var(--mw-muted);
        font-size: 14px;
        line-height: 1.7;
        animation: titleSlide 0.65s 0.08s ease both;
    }

    @keyframes titleSlide {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes underlineGrow {
        from { width: 0; opacity: 0; }
        to { width: 56px; opacity: 1; }
    }

    .header-mini-card {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        min-width: 208px;
        padding: 13px 16px;
        border-radius: 20px;
        border: 1px solid rgba(143, 179, 107, 0.26);
        background: rgba(255, 255, 255, 0.72);
        backdrop-filter: blur(10px);
        box-shadow: 0 12px 28px rgba(58, 80, 46, 0.08);
        animation: titleSlide 0.65s 0.12s ease both;
    }

    .mini-icon {
        width: 42px;
        height: 42px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--mw-green-soft);
        color: var(--mw-green-dark);
        animation: iconFloat 3s ease-in-out infinite;
    }

    .mini-icon svg {
        width: 23px;
        height: 23px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.4;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    @keyframes iconFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }

    .mini-content span {
        display: block;
        color: var(--mw-muted);
        font-size: 12px;
        margin-bottom: 2px;
    }

    .mini-content strong {
        display: block;
        color: #1d1d1d;
        font-size: 18px;
        line-height: 1.2;
    }

    .keluar-panel {
        position: relative;
        z-index: 1;
        width: 100%;
        padding: 0;
        animation: panelSlideUp 0.65s 0.12s ease both;
    }

    @keyframes panelSlideUp {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .top-action-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 30px;
        margin-bottom: 34px;
    }

    .filter-block {
        flex: 1;
        min-width: 0;
    }

    .date-label {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin: 0 0 15px;
        font-size: 16px;
        font-weight: 600;
        color: #1b1b1b;
    }

    .date-label svg {
        width: 18px;
        height: 18px;
        stroke: var(--mw-green-dark);
        stroke-width: 2.4;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .filter-form {
        display: grid;
        grid-template-columns: minmax(260px, 1fr) minmax(260px, 1fr) 128px 128px;
        align-items: center;
        gap: 16px;
        width: 100%;
    }

    .date-input-wrap {
        position: relative;
        width: 100%;
    }

    .date-input {
        width: 100%;
        height: 58px;
        border: 1px solid rgba(31, 31, 31, 0.07);
        border-radius: 14px;
        background: #f0f0f0;
        color: #777777;
        font-family: "Poppins", sans-serif;
        font-size: 22px;
        font-weight: 500;
        letter-spacing: 2px;
        padding: 0 56px 0 20px;
        outline: none;
        transition: background 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease, transform 0.22s ease;
    }

    .date-input:hover {
        background: #f6f6f6;
        transform: translateY(-1px);
    }

    .date-input:focus {
        background: #ffffff;
        border-color: rgba(143, 179, 107, 0.75);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.18), 0 10px 24px rgba(54, 74, 41, 0.08);
    }

    .date-input::-webkit-calendar-picker-indicator {
        opacity: 0;
        cursor: pointer;
        position: absolute;
        right: 0;
        width: 54px;
        height: 58px;
    }

    .calendar-icon {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        width: 25px;
        height: 25px;
        pointer-events: none;
        color: #222222;
        transition: transform 0.22s ease, color 0.22s ease;
    }

    .date-input-wrap:hover .calendar-icon {
        transform: translateY(-50%) scale(1.08);
        color: var(--mw-green-dark);
    }

    .calendar-icon svg {
        width: 25px;
        height: 25px;
        stroke: currentColor;
        stroke-width: 2;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .filter-btn,
    .refresh-btn {
        width: 128px;
        height: 58px;
        border: none;
        border-radius: 14px;
        font-family: "Poppins", sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #ffffff;
        cursor: pointer;
        transition: transform 0.22s ease, box-shadow 0.22s ease, background 0.22s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        position: relative;
        overflow: hidden;
    }

    .filter-btn::before,
    .refresh-btn::before,
    .add-btn::before {
        content: "";
        position: absolute;
        top: 0;
        left: -110%;
        width: 85%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.32), transparent);
        transform: skewX(-18deg);
        transition: left 0.55s ease;
    }

    .filter-btn:hover::before,
    .refresh-btn:hover::before,
    .add-btn:hover::before {
        left: 120%;
    }

    .filter-btn svg,
    .refresh-btn svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.4;
        stroke-linecap: round;
        stroke-linejoin: round;
        position: relative;
        z-index: 1;
    }

    .filter-btn span,
    .refresh-btn span {
        position: relative;
        z-index: 1;
    }

    .filter-btn {
        background: var(--mw-blue);
        box-shadow: 0 9px 19px rgba(64, 85, 101, 0.18);
    }

    .filter-btn:hover {
        background: #344755;
        transform: translateY(-3px);
        box-shadow: 0 14px 28px rgba(64, 85, 101, 0.24);
    }

    .refresh-btn {
        background: #5a9829;
        box-shadow: 0 9px 19px rgba(90, 152, 41, 0.18);
    }

    .refresh-btn:hover {
        background: #4d8522;
        color: #ffffff;
        text-decoration: none;
        transform: translateY(-3px);
        box-shadow: 0 14px 28px rgba(90, 152, 41, 0.24);
    }

    .add-area {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 13px;
        padding-top: 36px;
        white-space: nowrap;
        min-width: 370px;
    }

    .add-label {
        font-size: 22px;
        font-weight: 500;
        color: #111111;
    }

    .add-btn {
        width: 92px;
        height: 38px;
        border: none;
        border-radius: 10px;
        background: #9dff8f;
        color: #000000;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        transition: transform 0.22s ease, box-shadow 0.22s ease, background 0.22s ease;
        overflow: hidden;
        box-shadow: 0 9px 18px rgba(75, 174, 61, 0.19);
    }

    .add-btn::after {
        content: "";
        position: absolute;
        inset: -6px;
        border-radius: 14px;
        border: 2px solid rgba(157, 255, 143, 0.68);
        animation: addPulse 2.1s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes addPulse {
        0% { opacity: 0.65; transform: scale(0.94); }
        65%, 100% { opacity: 0; transform: scale(1.18); }
    }

    .add-btn:hover {
        background: #8ff080;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 13px 24px rgba(75, 174, 61, 0.27);
    }

    .add-btn span {
        font-size: 40px;
        font-weight: 700;
        line-height: 1;
        margin-top: -5px;
        position: relative;
        z-index: 1;
    }

    .table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 12px;
    }

    .entries-control {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 18px;
        font-weight: 500;
        color: #111111;
    }

    .entries-control select {
        width: 72px;
        height: 38px;
        border: 1px solid #c9d2c2;
        border-radius: 8px;
        background: #eeeeee;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        color: #111111;
        padding: 0 8px;
        outline: none;
        transition: 0.2s ease;
    }

    .entries-control select:focus {
        border-color: var(--mw-green);
        box-shadow: 0 0 0 3px rgba(143, 179, 107, 0.18);
    }

    .search-box {
        width: 312px;
        height: 50px;
        border: 1px solid #a7aaa4;
        border-radius: 999px;
        display: flex;
        align-items: center;
        padding: 0 18px;
        background: rgba(255,255,255,0.74);
        backdrop-filter: blur(8px);
        transition: border-color 0.22s ease, box-shadow 0.22s ease, background 0.22s ease, transform 0.22s ease;
    }

    .search-box:focus-within {
        border-color: var(--mw-green);
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.18), 0 12px 24px rgba(47, 64, 37, 0.08);
        transform: translateY(-2px);
    }

    .search-box svg {
        width: 27px;
        height: 27px;
        margin-right: 14px;
        stroke: #111111;
        stroke-width: 2.7;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
        transition: transform 0.22s ease, stroke 0.22s ease;
    }

    .search-box:focus-within svg {
        transform: rotate(-8deg) scale(1.05);
        stroke: var(--mw-green-dark);
    }

    .search-box input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        font-family: "Poppins", sans-serif;
        font-size: 26px;
        font-weight: 400;
        color: #111111;
        line-height: 1;
    }

    .search-box input::placeholder {
        color: #686868;
    }

    .table-card {
        width: 100%;
        border-radius: 18px;
        border: 1px solid rgba(143, 179, 107, 0.22);
        background: var(--mw-card);
        box-shadow: var(--mw-shadow);
        overflow: hidden;
        position: relative;
    }

    .table-card::before {
        content: "";
        position: absolute;
        inset: 0 0 auto;
        height: 5px;
        background: linear-gradient(90deg, var(--mw-green), #bde58e, var(--mw-green-dark));
        background-size: 200% 100%;
        animation: gradientMove 4s ease infinite;
        z-index: 2;
    }

    @keyframes gradientMove {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .keluar-table-wrap {
        width: 100%;
        overflow-x: auto;
        border-radius: 18px 18px 0 0;
    }

    .keluar-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        font-family: "Poppins", sans-serif;
        color: #111111;
    }

    .keluar-table th {
        height: 56px;
        background: #eeeeee;
        border: 1px solid #dde1d9;
        text-align: center;
        vertical-align: middle;
        font-size: 17px;
        font-weight: 700;
        text-transform: uppercase;
        color: #161616;
        letter-spacing: 0.1px;
    }

    .keluar-table td {
        height: 58px;
        border: 1px solid #e3e7df;
        text-align: center;
        vertical-align: middle;
        font-size: 16px;
        font-weight: 500;
        color: #111111;
        background: #ffffff;
        transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }

    .keluar-row {
        animation: rowFade 0.42s ease both;
        transition: 0.22s ease;
    }

    .keluar-row:nth-child(1) { animation-delay: 0.03s; }
    .keluar-row:nth-child(2) { animation-delay: 0.06s; }
    .keluar-row:nth-child(3) { animation-delay: 0.09s; }
    .keluar-row:nth-child(4) { animation-delay: 0.12s; }
    .keluar-row:nth-child(5) { animation-delay: 0.15s; }
    .keluar-row:nth-child(6) { animation-delay: 0.18s; }
    .keluar-row:nth-child(7) { animation-delay: 0.21s; }
    .keluar-row:nth-child(8) { animation-delay: 0.24s; }

    @keyframes rowFade {
        from { opacity: 0; transform: translateY(7px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .keluar-table tbody tr:nth-child(even) td {
        background: #fcfdfb;
    }

    .keluar-table tbody tr:hover td {
        background: #f3faef;
        box-shadow: inset 0 1px 0 rgba(143, 179, 107, 0.14), inset 0 -1px 0 rgba(143, 179, 107, 0.14);
    }

    .col-no { width: 8%; }
    .col-kategori { width: 17%; }
    .col-tanggal { width: 17%; }
    .col-barang { width: 22%; }
    .col-jumlah { width: 15%; }
    .col-keterangan { width: 21%; }

    .number-pill {
        min-width: 38px;
        height: 28px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eff4eb;
        border: 1px solid rgba(143, 179, 107, 0.30);
        color: #465b35;
        font-size: 14px;
        font-weight: 700;
    }

    .category-badge,
    .date-badge,
    .jumlah-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border-radius: 999px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .category-badge {
        min-width: 100px;
        min-height: 31px;
        padding: 6px 14px;
        background: #eef5e8;
        border: 1px solid rgba(143, 179, 107, 0.45);
        color: #31521a;
        font-size: 14px;
        font-weight: 700;
    }

    .date-badge {
        min-width: 114px;
        height: 32px;
        background: #f6f7f5;
        border: 1px solid #dbe3d5;
        color: #343434;
        font-size: 14px;
        font-weight: 700;
    }

    .date-badge svg {
        width: 15px;
        height: 15px;
        stroke: var(--mw-green-dark);
        fill: none;
        stroke-width: 2.4;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .jumlah-badge {
        min-width: 64px;
        height: 34px;
        background: #e6f5df;
        color: #2f7d32;
        border: 1px solid rgba(47, 125, 50, 0.25);
        font-size: 15px;
        font-weight: 800;
        box-shadow: inset 0 -8px 18px rgba(47, 125, 50, 0.04);
    }

    .keluar-table tr:hover .category-badge,
    .keluar-table tr:hover .date-badge,
    .keluar-table tr:hover .jumlah-badge {
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(78, 108, 56, 0.10);
    }

    .product-name {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        max-width: 100%;
        font-weight: 700;
        color: #161616;
    }

    .product-dot {
        width: 9px;
        height: 9px;
        min-width: 9px;
        border-radius: 50%;
        background: var(--mw-green);
        box-shadow: 0 0 0 5px rgba(143, 179, 107, 0.15);
        animation: dotPulse 2s ease-in-out infinite;
    }

    @keyframes dotPulse {
        0%, 100% { box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.13); }
        50% { box-shadow: 0 0 0 8px rgba(143, 179, 107, 0.05); }
    }

    .keterangan-text {
        display: inline-block;
        max-width: 92%;
        color: #393939;
        font-size: 15px;
        line-height: 1.45;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
    }

    .empty-row {
        height: 92px !important;
        color: #737b6d !important;
        font-size: 16px !important;
        background: #ffffff !important;
    }

    .empty-state {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 18px;
        border-radius: 999px;
        background: #f6f9f2;
        border: 1px dashed rgba(143, 179, 107, 0.45);
    }

    .empty-state svg {
        width: 19px;
        height: 19px;
        stroke: var(--mw-green-dark);
        fill: none;
        stroke-width: 2.4;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 14px 3px 0;
        margin-top: 0;
        font-family: "Poppins", sans-serif;
        font-size: 16px;
        font-weight: 500;
        color: #111111;
    }

    .table-footer strong {
        color: var(--mw-green-dark);
    }

    .pagination-custom {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .pagination-custom button,
    .pagination-custom span {
        border: none;
        background: transparent;
        font-family: "Poppins", sans-serif;
        font-size: 18px;
        font-weight: 500;
        color: #111111;
        cursor: pointer;
        padding: 0;
        transition: color 0.2s ease, transform 0.2s ease, opacity 0.2s ease;
    }

    .pagination-custom button:hover:not(:disabled) {
        color: var(--mw-green-dark);
        transform: translateY(-1px);
    }

    .pagination-custom button:disabled {
        opacity: 0.43;
        cursor: not-allowed;
    }

    .pagination-custom .page-number {
        min-width: 48px;
        height: 36px;
        border: 1px solid #c9d1c2;
        border-radius: 8px;
        background: #eeeeee;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 700;
        cursor: default;
    }

    .alert-custom {
        position: relative;
        z-index: 2;
        margin-bottom: 18px;
        border-radius: 14px;
        font-family: "Poppins", sans-serif;
        border: none;
        box-shadow: 0 12px 26px rgba(0,0,0,0.08);
    }

    /* =========================
       MODAL TAMBAH BARANG KELUAR
    ========================= */
    .modal-backdrop.show {
        opacity: 0.34 !important;
        backdrop-filter: blur(4px);
    }

    body.modal-open .keluar-page {
        overflow: visible;
    }

    #modalKeluar .modal-dialog {
        max-width: 720px;
    }

    #modalKeluar .modal-content {
        border: none;
        border-radius: 24px;
        box-shadow: 0 24px 70px rgba(0, 0, 0, 0.24);
        overflow: hidden;
        font-family: "Poppins", sans-serif;
    }

    #modalKeluar.fade .modal-dialog {
        transform: translateY(18px) scale(0.98);
    }

    #modalKeluar.show .modal-dialog {
        transform: translateY(0) scale(1);
    }

    #modalKeluar .modal-header {
        min-height: 78px;
        background: linear-gradient(135deg, #8fb36b 0%, #7da45a 100%);
        border-bottom: none;
        padding: 22px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    #modalKeluar .modal-title {
        color: #111111;
        font-size: 24px;
        font-weight: 800;
        margin: 0;
    }

    #modalKeluar .modal-header .close {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border: none;
        border-radius: 50%;
        background: #ffe4e4;
        color: #d93636;
        opacity: 1;
        padding: 0;
        margin: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: none;
        text-shadow: none;
        font-size: 0;
        line-height: 1;
        transition: 0.22s ease;
    }

    #modalKeluar .modal-header .close:hover {
        background: #ffd1d1;
        transform: rotate(90deg) scale(1.04);
    }

    #modalKeluar .modal-header .close::before {
        content: "×";
        font-family: "Poppins", sans-serif;
        font-size: 31px;
        font-weight: 800;
        color: #d93636;
        line-height: 1;
        margin-top: -3px;
    }

    #modalKeluar .modal-header .close span {
        display: none;
    }

    #modalKeluar .modal-body {
        padding: 28px 30px 12px;
        background: #ffffff;
    }

    #modalKeluar .modal-body label {
        font-size: 15px;
        font-weight: 700;
        color: #111111;
        margin-bottom: 8px;
    }

    #modalKeluar .form-control {
        min-height: 46px;
        border: 1px solid #ccd5c7;
        border-radius: 12px;
        box-shadow: none;
        font-family: "Poppins", sans-serif;
        font-size: 15px;
        color: #111111;
        padding: 10px 13px;
        background: #ffffff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    }

    #modalKeluar textarea.form-control {
        min-height: 96px;
        resize: vertical;
    }

    #modalKeluar .form-control:focus {
        border-color: var(--mw-green);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.18);
        transform: translateY(-1px);
    }

    #modalKeluar .modal-footer {
        border-top: none;
        background: #ffffff;
        padding: 16px 30px 30px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    #modalKeluar .modal-footer .btn {
        min-width: 118px;
        height: 44px;
        border: none;
        border-radius: 14px;
        font-family: "Poppins", sans-serif;
        font-size: 15px;
        font-weight: 700;
        box-shadow: none;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.22s ease;
    }

    .btn-modal-cancel {
        background: #eeeeee;
        color: #111111;
    }

    .btn-modal-cancel:hover {
        background: #dddddd;
        color: #111111;
        transform: translateY(-2px);
    }

    .btn-modal-save {
        background: var(--mw-green);
        color: #111111;
    }

    .btn-modal-save:hover {
        background: #7da45a;
        color: #111111;
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(143, 179, 107, 0.28);
    }

    @media (max-width: 1200px) {
        .top-action-row {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .add-area {
            padding-top: 0;
            min-width: 0;
            justify-content: flex-end;
        }

        .filter-form {
            grid-template-columns: 1fr 1fr;
        }

        .filter-btn,
        .refresh-btn {
            width: 100%;
        }
    }

    @media (max-width: 850px) {
        .keluar-page {
            padding: 34px 20px 64px;
        }

        .keluar-header {
            flex-direction: column;
        }

        .keluar-title {
            font-size: 25px;
        }

        .header-mini-card {
            width: 100%;
            min-width: 0;
        }

        .filter-form {
            grid-template-columns: 1fr;
        }

        .date-input {
            font-size: 19px;
            height: 54px;
        }

        .table-toolbar {
            flex-direction: column-reverse;
            align-items: flex-start;
        }

        .search-box {
            width: 100%;
            max-width: 390px;
        }

        .keluar-table {
            min-width: 1080px;
        }

        .table-footer {
            flex-direction: column;
            align-items: flex-start;
            padding-top: 14px;
        }

        .add-area {
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .add-label {
            font-size: 19px;
        }
    }


    /* =========================
       AKSEN KHUSUS BARANG KELUAR
    ========================= */
    .keluar-page {
        background:
            radial-gradient(circle at 96% 18%, rgba(255, 92, 92, 0.13) 0 115px, transparent 116px),
            radial-gradient(circle at 12% 92%, rgba(143, 179, 107, 0.10) 0 150px, transparent 151px),
            linear-gradient(180deg, #ffffff 0%, #fffdfb 100%);
    }

    .keluar-page::before {
        background: rgba(255, 92, 92, 0.075);
    }

    .keluar-page::after {
        border-color: rgba(143, 179, 107, 0.07);
    }

    .keluar-title::after {
        background: linear-gradient(90deg, var(--mw-red), #ffb0b0);
    }

    .header-mini-card {
        border-color: rgba(255, 92, 92, 0.24);
    }

    .mini-icon {
        background: var(--mw-red-soft);
        color: var(--mw-red-dark);
    }

    .date-label svg {
        stroke: var(--mw-red-dark);
    }

    .date-input:focus {
        border-color: rgba(255, 92, 92, 0.55);
        box-shadow: 0 0 0 4px rgba(255, 92, 92, 0.14), 0 10px 24px rgba(110, 43, 43, 0.08);
    }

    .date-input-wrap:hover .calendar-icon,
    .search-box:focus-within svg,
    .pagination-custom button:hover:not(:disabled) {
        color: var(--mw-red-dark);
        stroke: var(--mw-red-dark);
    }

    .add-btn {
        background: #ff6b6b;
        color: #111111;
        box-shadow: 0 9px 18px rgba(255, 92, 92, 0.22);
    }

    .add-btn::after {
        border-color: rgba(255, 92, 92, 0.56);
    }

    .add-btn:hover {
        background: #ff5757;
        box-shadow: 0 13px 24px rgba(255, 92, 92, 0.31);
    }

    .table-card {
        border-color: rgba(255, 92, 92, 0.18);
    }

    .table-card::before {
        background: linear-gradient(90deg, var(--mw-red), #ffc1c1, var(--mw-red-dark));
        background-size: 200% 100%;
    }

    .keluar-table tbody tr:nth-child(even) td {
        background: #fffdfd;
    }

    .keluar-table tbody tr:hover td {
        background: #fff5f5;
        box-shadow: inset 0 1px 0 rgba(255, 92, 92, 0.13), inset 0 -1px 0 rgba(255, 92, 92, 0.13);
    }

    .number-pill {
        background: #fff3f3;
        border-color: rgba(255, 92, 92, 0.24);
        color: #883838;
    }

    .category-badge {
        background: #fff3f3;
        border-color: rgba(255, 92, 92, 0.34);
        color: #9d2d2d;
    }

    .date-badge svg {
        stroke: var(--mw-red-dark);
    }

    .jumlah-badge {
        background: #ffe8e8;
        color: var(--mw-red-dark);
        border-color: rgba(198, 40, 40, 0.25);
        box-shadow: inset 0 -8px 18px rgba(198, 40, 40, 0.04);
    }

    .product-dot {
        background: var(--mw-red);
        box-shadow: 0 0 0 5px rgba(255, 92, 92, 0.14);
    }

    @keyframes dotPulse {
        0%, 100% { box-shadow: 0 0 0 4px rgba(255, 92, 92, 0.13); }
        50% { box-shadow: 0 0 0 8px rgba(255, 92, 92, 0.05); }
    }

    .table-footer strong {
        color: var(--mw-red-dark);
    }

    .empty-state {
        background: #fff7f7;
        border-color: rgba(255, 92, 92, 0.34);
    }

    .empty-state svg {
        stroke: var(--mw-red-dark);
    }

    .btn-modal-save {
        background: var(--mw-red);
        color: #ffffff;
    }

    .btn-modal-save:hover {
        background: #e84a4a;
        color: #ffffff;
        box-shadow: 0 10px 22px rgba(255, 92, 92, 0.28);
    }

</style>

<div class="keluar-page">
    <div class="keluar-header">
        <div class="title-area">
            <h1 class="keluar-title">Laporan Barang Keluar</h1>
            <p class="keluar-subtitle">Pantau riwayat barang keluar, pengurangan stok, tanggal transaksi, dan keterangan tujuan barang dengan tampilan yang lebih rapi.</p>
        </div>

        <div class="header-mini-card">
            <span class="mini-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 9.5 12 5l8 4.5-8 4.5-8-4.5Z"></path>
                    <path d="M4 9.5V16l8 4.5 8-4.5V9.5"></path>
                    <path d="M12 14v6.5"></path>
                    <path d="M15 10.5h5"></path>
                    <path d="M17.5 8 20 10.5 17.5 13"></path>
                </svg>
            </span>
            <span class="mini-content">
                <span>Total data keluar</span>
                <strong>{{ method_exists($riwayat, 'total') ? $riwayat->total() : $riwayat->count() }}</strong>
            </span>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
            {{ session('error') }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="keluar-panel">
        <div class="top-action-row">
            <div class="filter-block">
                <label class="date-label">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 21v-7"></path>
                        <path d="M4 10V3"></path>
                        <path d="M12 21v-9"></path>
                        <path d="M12 8V3"></path>
                        <path d="M20 21v-5"></path>
                        <path d="M20 12V3"></path>
                        <path d="M2 14h4"></path>
                        <path d="M10 8h4"></path>
                        <path d="M18 16h4"></path>
                    </svg>
                    Pilih tanggal keluar
                </label>

                <form action="{{ url()->current() }}" method="GET" class="filter-form">
                    <div class="date-input-wrap">
                        <input
                            type="date"
                            name="start_date"
                            class="date-input"
                            value="{{ request('start_date') }}"
                        >

                        <span class="calendar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M7 3V6"></path>
                                <path d="M17 3V6"></path>
                                <path d="M4 9H20"></path>
                                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                            </svg>
                        </span>
                    </div>

                    <div class="date-input-wrap">
                        <input
                            type="date"
                            name="end_date"
                            class="date-input"
                            value="{{ request('end_date') }}"
                        >

                        <span class="calendar-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M7 3V6"></path>
                                <path d="M17 3V6"></path>
                                <path d="M4 9H20"></path>
                                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                            </svg>
                        </span>
                    </div>

                    <button type="submit" class="filter-btn">
                        <svg viewBox="0 0 24 24">
                            <path d="M22 3H2l8 9.5V19l4 2v-8.5L22 3z"></path>
                        </svg>
                        <span>Filter</span>
                    </button>

                    <a href="{{ url()->current() }}" class="refresh-btn">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 12a9 9 0 0 1-15.3 6.4"></path>
                            <path d="M3 12A9 9 0 0 1 18.3 5.6"></path>
                            <path d="M21 4v6h-6"></path>
                            <path d="M3 20v-6h6"></path>
                        </svg>
                        <span>Refresh</span>
                    </a>
                </form>
            </div>

            <div class="add-area">
                <span class="add-label">Tambah barang keluar :</span>

                <button class="add-btn" type="button" data-toggle="modal" data-target="#modalKeluar" aria-label="Tambah barang keluar">
                    <span>−</span>
                </button>
            </div>
        </div>

        <div class="table-toolbar">
            <div class="entries-control">
                <span>Show</span>

                <select id="keluarEntries">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>

                <span>Entries</span>
            </div>

            <div class="search-box">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="M16.5 16.5L21 21"></path>
                </svg>

                <input type="text" id="keluarSearch" placeholder="Search" autocomplete="off">
            </div>
        </div>

        <div class="table-card">
            <div class="keluar-table-wrap">
                <table class="keluar-table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-kategori">KODE TRANSAKSI</th>
                            <th class="col-tanggal">TANGGAL KELUAR</th>
                            <th class="col-barang">NAMA BARANG</th>
                            <th class="col-jumlah">JUMLAH KELUAR</th>
                            <th class="col-keterangan">KETERANGAN</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($riwayat as $r)
                            <tr class="keluar-row">
                                <td>
                                    <span class="number-pill">{{ $loop->iteration }}</span>
                                </td>

                                <td>
                                    <span class="category-badge">
                                        {{ $r->kode_transaksi ?? $r->kode ?? 'OUT-' . str_pad($r->id ?? $loop->iteration, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="date-badge">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M7 3V6"></path>
                                            <path d="M17 3V6"></path>
                                            <path d="M4 9H20"></path>
                                            <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        </svg>
                                        {{ optional($r->created_at)->format('d/m/Y') ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="product-name">
                                        <span class="product-dot"></span>
                                        {{ $r->produk?->nama_produk ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="jumlah-badge">-{{ $r->jumlah ?? 0 }}</span>
                                </td>

                                <td>
                                    <span class="keterangan-text" title="{{ $r->keterangan ?? '-' }}">{{ $r->keterangan ?? '-' }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-row">
                                    <span class="empty-state">
                                        <svg viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <path d="M9 12h6"></path>
                                        </svg>
                                        Data barang keluar belum tersedia.
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-footer">
            <div id="keluarInfo">
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

<div class="modal fade" id="modalKeluar" tabindex="-1" role="dialog" aria-labelledby="modalKeluarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('master-data.transaksi.keluar.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="modalKeluarLabel">Tambah Barang Keluar</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Tutup">
                    <span>×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Produk</label>
                    <select name="produk_id" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($produks as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nama_produk }} — Stok: {{ $p->stok }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah Keluar</label>
                    <input type="number" name="jumlah" class="form-control" min="1" placeholder="Masukkan jumlah barang keluar" required>
                </div>

                <div class="form-group mb-0">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan atau tujuan barang keluar..."></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-modal-cancel" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-modal-save" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalKeluar = document.getElementById('modalKeluar');

        if (modalKeluar && modalKeluar.parentElement !== document.body) {
            document.body.appendChild(modalKeluar);
        }

        const searchInput = document.getElementById('keluarSearch');
        const entriesSelect = document.getElementById('keluarEntries');
        const rows = Array.from(document.querySelectorAll('.keluar-row'));
        const info = document.getElementById('keluarInfo');
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

            filteredRows.slice(startIndex, endIndex).forEach(function (row, index) {
                row.style.display = '';
                row.style.animationDelay = (index * 0.045) + 's';
            });

            const showingStart = totalRows === 0 ? 0 : startIndex + 1;
            const showingEnd = Math.min(endIndex, totalRows);

            info.innerHTML = `Showing <strong>${showingStart}</strong> to <strong>${showingEnd}</strong> out of <strong>${totalRows}</strong> entries`;
            currentPageText.textContent = currentPage;

            prevButton.disabled = currentPage <= 1;
            nextButton.disabled = currentPage >= totalPages;
        }

        if (searchInput && entriesSelect && info && prevButton && nextButton && currentPageText) {
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
        }
    });
</script>
@endsection
