@extends('layouts.admin')

@section('content')
<style>
    :root {
        --warehouse-green: #8fb36b;
        --warehouse-green-dark: #789d56;
        --warehouse-green-soft: #edf6e8;
        --warehouse-lime: #9dff8f;
        --warehouse-blue: #6391ff;
        --warehouse-red: #ff4b4b;
        --warehouse-ink: #151816;
        --warehouse-muted: #6f746d;
        --warehouse-line: #e8ece5;
        --warehouse-card: #ffffff;
        --warehouse-shadow: 0 18px 45px rgba(45, 67, 35, 0.10);
        --warehouse-shadow-soft: 0 10px 25px rgba(55, 74, 45, 0.08);
    }

    .produk-page,
    .produk-page * {
        box-sizing: border-box;
    }

    .produk-page {
        position: relative;
        width: 100%;
        min-height: calc(100vh - 72px);
        padding: 31px 30px 74px;
        overflow: hidden;
        font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        background:
            radial-gradient(circle at 88% 7%, rgba(157, 255, 143, 0.18), transparent 32%),
            radial-gradient(circle at 0% 28%, rgba(143, 179, 107, 0.12), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #fbfdf9 56%, #f7fbf4 100%);
        color: var(--warehouse-ink);
    }

    .produk-page::before,
    .produk-page::after {
        content: "";
        position: absolute;
        z-index: 0;
        border-radius: 999px;
        pointer-events: none;
        filter: blur(1px);
        opacity: 0.7;
        animation: floatBlob 8s ease-in-out infinite;
    }

    .produk-page::before {
        width: 210px;
        height: 210px;
        right: -96px;
        top: 116px;
        background: rgba(143, 179, 107, 0.16);
    }

    .produk-page::after {
        width: 170px;
        height: 170px;
        left: -95px;
        bottom: 120px;
        background: rgba(157, 255, 143, 0.18);
        animation-delay: -2.5s;
    }

    .produk-content {
        position: relative;
        z-index: 1;
        animation: pageReveal 0.55s ease both;
    }

    .produk-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 29px;
    }

    .produk-title-block {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .produk-title {
        position: relative;
        width: fit-content;
        margin: 0;
        font-size: 27px;
        font-weight: 600;
        color: #000000;
        letter-spacing: 0.2px;
        text-transform: uppercase;
    }

    .produk-title::after {
        content: "";
        position: absolute;
        left: 2px;
        bottom: -8px;
        width: 58px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--warehouse-green), var(--warehouse-lime));
        animation: lineGrow 0.9s ease both;
    }

    .produk-subtitle {
        margin: 9px 0 0;
        font-size: 13px;
        color: var(--warehouse-muted);
        letter-spacing: 0.1px;
    }

    .produk-header-right {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 11px;
        margin-right: 38px;
    }

    .produk-search-form {
        width: 238px;
    }

    .search-box {
        width: 100%;
        height: 38px;
        border: 1px solid rgba(25, 28, 24, 0.20);
        border-radius: 999px;
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.88);
        padding: 0 11px 0 12px;
        box-shadow: 0 8px 20px rgba(33, 45, 26, 0.06);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease, background 0.25s ease;
    }

    .search-box:focus-within {
        transform: translateY(-1px);
        border-color: rgba(143, 179, 107, 0.95);
        background: #ffffff;
        box-shadow: 0 12px 26px rgba(87, 125, 65, 0.18), 0 0 0 4px rgba(143, 179, 107, 0.14);
    }

    .search-box button {
        border: none;
        background: transparent;
        padding: 0;
        margin: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .search-box svg {
        width: 21px;
        height: 21px;
        margin-right: 9px;
        color: #20241f;
        flex-shrink: 0;
        transition: transform 0.25s ease, color 0.25s ease;
    }

    .search-box:focus-within svg {
        color: var(--warehouse-green-dark);
        transform: scale(1.08) rotate(-5deg);
    }

    .search-box input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        font-family: inherit;
        font-size: 20px;
        font-weight: 400;
        color: #111111;
        line-height: 1;
    }

    .search-box input::placeholder {
        color: #6b6b6b;
    }

    .search-clear {
        width: 22px;
        height: 22px;
        min-width: 22px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: #ffffff;
        background: #adb5a5;
        font-size: 16px;
        line-height: 1;
        transition: transform 0.2s ease, background 0.2s ease;
    }

    .search-clear:hover {
        color: #ffffff;
        background: var(--warehouse-red);
        transform: rotate(90deg) scale(1.05);
        text-decoration: none;
    }

    .add-product-area {
        display: flex;
        align-items: center;
        gap: 9px;
        white-space: nowrap;
    }

    .add-product-label {
        font-size: 16px;
        font-weight: 400;
        color: #000000;
    }

    .add-product-control > .btn,
    .add-product-control > button,
    .add-product-control > a.btn,
    .add-product-control button[data-toggle="modal"],
    .add-product-control .btn[data-toggle="modal"],
    .add-product-control button[data-bs-toggle="modal"],
    .add-product-control .btn[data-bs-toggle="modal"] {
        position: relative !important;
        width: 68px !important;
        height: 28px !important;
        min-width: 68px !important;
        border: none !important;
        border-radius: 8px !important;
        background: linear-gradient(135deg, #a7ff99 0%, #8ef481 100%) !important;
        color: #000000 !important;
        box-shadow: 0 8px 17px rgba(90, 190, 80, 0.24) !important;
        outline: none !important;
        padding: 0 !important;
        margin: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 0 !important;
        line-height: 1 !important;
        overflow: hidden !important;
        transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease !important;
    }

    .add-product-control > .btn:hover,
    .add-product-control > button:hover,
    .add-product-control > a.btn:hover,
    .add-product-control button[data-toggle="modal"]:hover,
    .add-product-control .btn[data-toggle="modal"]:hover,
    .add-product-control button[data-bs-toggle="modal"]:hover,
    .add-product-control .btn[data-bs-toggle="modal"]:hover {
        transform: translateY(-2px) scale(1.03) !important;
        filter: brightness(1.01) !important;
        box-shadow: 0 12px 24px rgba(90, 190, 80, 0.30) !important;
    }

    .add-product-control > .btn::before,
    .add-product-control > button::before,
    .add-product-control > a.btn::before,
    .add-product-control button[data-toggle="modal"]::before,
    .add-product-control .btn[data-toggle="modal"]::before,
    .add-product-control button[data-bs-toggle="modal"]::before,
    .add-product-control .btn[data-bs-toggle="modal"]::before {
        content: "+" !important;
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -56%) !important;
        font-family: inherit !important;
        font-size: 36px !important;
        font-weight: 500 !important;
        color: #000000 !important;
        line-height: 1 !important;
    }

    .add-product-control > .btn::after,
    .add-product-control > button::after,
    .add-product-control > a.btn::after {
        content: "" !important;
        position: absolute !important;
        inset: -20px !important;
        background: linear-gradient(120deg, transparent 30%, rgba(255,255,255,0.55), transparent 70%) !important;
        transform: translateX(-110%) !important;
        animation: shimmerButton 2.8s ease-in-out infinite !important;
    }

    .add-product-control > .btn i,
    .add-product-control > button i,
    .add-product-control > a.btn i,
    .add-product-control > .btn span,
    .add-product-control > button span,
    .add-product-control > a.btn span,
    .add-product-control button[data-toggle="modal"] i,
    .add-product-control .btn[data-toggle="modal"] i,
    .add-product-control button[data-toggle="modal"] span,
    .add-product-control .btn[data-toggle="modal"] span,
    .add-product-control button[data-bs-toggle="modal"] i,
    .add-product-control .btn[data-bs-toggle="modal"] i,
    .add-product-control button[data-bs-toggle="modal"] span,
    .add-product-control .btn[data-bs-toggle="modal"] span {
        display: none !important;
    }

    .filter-section {
        margin-bottom: 64px;
        animation: fadeUp 0.55s ease both;
        animation-delay: 0.08s;
    }

    .filter-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
        color: #000000;
    }

    .filter-label::before {
        content: "";
        width: 17px;
        height: 17px;
        background-repeat: no-repeat;
        background-size: contain;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill='none' stroke='%23789d56' stroke-width='2.3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M3 5h18'/%3E%3Cpath d='M6 12h12'/%3E%3Cpath d='M10 19h4'/%3E%3C/svg%3E");
    }

    .filter-select-wrap {
        position: relative;
    }

    .filter-select {
        width: 100%;
        height: 44px;
        border: 1px solid rgba(25, 28, 24, 0.20);
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.92);
        font-family: inherit;
        font-size: 21px;
        font-weight: 400;
        color: #5a5a5a;
        padding: 0 44px 0 14px;
        outline: none;
        appearance: none;
        box-shadow: var(--warehouse-shadow-soft);
        cursor: pointer;
        transition: border-color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
    }

    .filter-select-wrap::after {
        content: "";
        position: absolute;
        right: 16px;
        top: 50%;
        width: 12px;
        height: 12px;
        border-right: 3px solid #151816;
        border-bottom: 3px solid #151816;
        transform: translateY(-70%) rotate(45deg);
        pointer-events: none;
        transition: transform 0.25s ease;
    }

    .filter-select:hover,
    .filter-select:focus {
        border-color: rgba(143, 179, 107, 0.95);
        box-shadow: 0 14px 30px rgba(87, 125, 65, 0.15), 0 0 0 4px rgba(143, 179, 107, 0.12);
        transform: translateY(-1px);
    }

    .table-control-row {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
        font-size: 15px;
        font-weight: 400;
        color: #000000;
        animation: fadeUp 0.55s ease both;
        animation-delay: 0.15s;
    }

    .entries-select {
        height: 32px;
        min-width: 58px;
        border: 1px solid #d5dbd1;
        border-radius: 8px;
        background: #f3f6ef;
        font-family: inherit;
        font-size: 13px;
        color: #000000;
        padding: 0 8px;
        outline: none;
        cursor: pointer;
        transition: border-color 0.22s ease, box-shadow 0.22s ease;
    }

    .entries-select:focus,
    .entries-select:hover {
        border-color: var(--warehouse-green);
        box-shadow: 0 0 0 3px rgba(143, 179, 107, 0.13);
    }

    .produk-table-card {
        position: relative;
        width: 100%;
        border: 1px solid rgba(143, 179, 107, 0.16);
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.86);
        box-shadow: var(--warehouse-shadow);
        overflow: hidden;
        animation: fadeUp 0.58s ease both;
        animation-delay: 0.22s;
    }

    .produk-table-card::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 5px;
        background: linear-gradient(90deg, var(--warehouse-green), var(--warehouse-lime), var(--warehouse-green));
        background-size: 200% 100%;
        animation: gradientSlide 4.5s linear infinite;
        z-index: 1;
    }

    .produk-table-wrap {
        position: relative;
        width: 100%;
        overflow-x: auto;
        padding-top: 5px;
    }

    .produk-table-wrap::-webkit-scrollbar {
        height: 10px;
    }

    .produk-table-wrap::-webkit-scrollbar-track {
        background: #eef3ea;
    }

    .produk-table-wrap::-webkit-scrollbar-thumb {
        background: #b6caa5;
        border-radius: 999px;
        border: 2px solid #eef3ea;
    }

    .produk-table {
        width: 100%;
        min-width: 1080px;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: fixed;
        font-family: inherit;
        color: #000000;
    }

    .produk-table thead th {
        position: sticky;
        top: 0;
        z-index: 2;
        height: 45px;
        background: linear-gradient(180deg, #f4f5f3 0%, #ecefec 100%);
        border-right: 1px solid #e1e5df;
        border-bottom: 1px solid #dce2d9;
        text-align: center;
        vertical-align: middle;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.1px;
        color: #272b25;
    }

    .produk-table thead th:last-child {
        border-right: none;
    }

    .produk-table tbody tr {
        background: rgba(255, 255, 255, 0.84);
        animation: rowIn 0.48s ease both;
        animation-delay: var(--delay, 0ms);
        transition: transform 0.23s ease, box-shadow 0.23s ease, background 0.23s ease;
    }

    .produk-table tbody tr:nth-child(even) {
        background: rgba(250, 253, 248, 0.94);
    }

    .produk-table tbody tr:hover {
        position: relative;
        z-index: 3;
        background: #fbfff7;
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(60, 82, 48, 0.10);
    }

    .produk-table td {
        height: 165px;
        border-right: 1px solid #e8ece5;
        border-bottom: 1px solid #e8ece5;
        text-align: center;
        vertical-align: top;
        padding: 14px 12px;
        font-size: 14px;
        font-weight: 400;
    }

    .produk-table td:last-child {
        border-right: none;
    }

    .col-no { width: 90px; }
    .col-gambar { width: 210px; }
    .col-nama { width: 175px; }
    .col-kategori { width: 160px; }
    .col-stok { width: 96px; }
    .col-harga { width: 150px; }
    .col-opsi { width: 220px; }

    .row-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 28px;
        margin-top: -2px;
        border-radius: 999px;
        background: #f1f5ed;
        color: #33402c;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid #dfe8d7;
    }

    .produk-image-wrap {
        width: 100%;
        height: 130px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .produk-image-card {
        width: 116px;
        height: 116px;
        border-radius: 18px;
        background:
            linear-gradient(#ffffff, #ffffff) padding-box,
            linear-gradient(135deg, rgba(143,179,107,0.55), rgba(157,255,143,0.35)) border-box;
        border: 1px solid transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 12px 28px rgba(35, 49, 27, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .produk-table tbody tr:hover .produk-image-card {
        transform: scale(1.03) rotate(-1deg);
        box-shadow: 0 17px 34px rgba(35, 49, 27, 0.14);
    }

    .produk-image {
        width: 104px;
        height: 104px;
        border-radius: 14px;
        object-fit: cover;
        display: block;
    }

    .produk-placeholder {
        width: 106px;
        height: 106px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .produk-placeholder svg {
        width: 96px;
        height: 96px;
        stroke: #222222;
        stroke-width: 2.35;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        transition: stroke 0.25s ease, transform 0.25s ease;
    }

    .produk-table tbody tr:hover .produk-placeholder svg {
        stroke: var(--warehouse-green-dark);
        transform: scale(1.02);
    }

    .nama-text,
    .kategori-text,
    .stok-text,
    .harga-text {
        display: block;
        color: #000000;
        font-size: 14px;
        font-weight: 500;
        word-break: break-word;
    }

    .nama-text {
        max-width: 150px;
        margin: 0 auto;
        line-height: 1.45;
    }

    .nama-dot {
        width: 8px;
        height: 8px;
        margin: 0 auto 8px;
        border-radius: 50%;
        background: var(--warehouse-green);
        box-shadow: 0 0 0 5px rgba(143, 179, 107, 0.14);
    }

    .kategori-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        max-width: 130px;
        min-height: 30px;
        padding: 6px 11px;
        border-radius: 999px;
        background: #eef6e9;
        border: 1px solid #dcebd2;
        color: #3f5e31;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.25;
    }

    .stock-cell {
        width: 100%;
        max-width: 72px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .stock-number {
        min-width: 42px;
        height: 30px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #111111;
        background: #f3f6ef;
        border: 1px solid #dfe7d8;
    }

    .stock-bar {
        width: 64px;
        height: 7px;
        border-radius: 999px;
        background: #e7ece3;
        overflow: hidden;
    }

    .stock-fill {
        display: block;
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #ff6b6b 0%, #ffd166 48%, #8fb36b 100%);
        animation: stockGrow 1s ease both;
        transform-origin: left center;
    }

    .stock-status {
        padding: 3px 8px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.25px;
        text-transform: uppercase;
    }

    .stock-status.habis {
        background: #ffe8e8;
        color: #d93030;
    }

    .stock-status.rendah {
        background: #fff2cf;
        color: #aa7200;
    }

    .stock-status.aman,
    .stock-status.tinggi {
        background: #eaf7e6;
        color: #477837;
    }

    .harga-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 30px;
        padding: 6px 12px;
        border-radius: 999px;
        background: #f7f8f6;
        border: 1px solid #e5e9e1;
        color: #20241f;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .opsi-actions {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        gap: 13px;
        padding-top: 0;
    }

    .delete-form {
        margin: 0;
        padding: 0;
    }

    .btn-delete-custom,
    .edit-control > .btn,
    .edit-control > button,
    .edit-control > a.btn,
    .edit-control button[data-toggle="modal"],
    .edit-control .btn[data-toggle="modal"],
    .edit-control button[data-bs-toggle="modal"],
    .edit-control .btn[data-bs-toggle="modal"] {
        position: relative !important;
        width: 64px !important;
        height: 27px !important;
        min-width: 64px !important;
        border: none !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        padding: 0 !important;
        margin: 0 !important;
        box-shadow: none !important;
        outline: none !important;
        font-size: 0 !important;
        line-height: 1 !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease !important;
    }

    .btn-delete-custom {
        background: linear-gradient(135deg, #ff6464 0%, #ff4b4b 100%);
    }

    .edit-control > .btn,
    .edit-control > button,
    .edit-control > a.btn,
    .edit-control button[data-toggle="modal"],
    .edit-control .btn[data-toggle="modal"],
    .edit-control button[data-bs-toggle="modal"],
    .edit-control .btn[data-bs-toggle="modal"] {
        background: linear-gradient(135deg, #78a3ff 0%, #5f8df5 100%) !important;
        color: #000000 !important;
    }

    .btn-delete-custom:hover,
    .edit-control > .btn:hover,
    .edit-control > button:hover,
    .edit-control > a.btn:hover,
    .edit-control button[data-toggle="modal"]:hover,
    .edit-control .btn[data-toggle="modal"]:hover,
    .edit-control button[data-bs-toggle="modal"]:hover,
    .edit-control .btn[data-bs-toggle="modal"]:hover {
        transform: translateY(-2px) scale(1.04) !important;
        filter: brightness(1.02) !important;
        box-shadow: 0 10px 18px rgba(0, 0, 0, 0.13) !important;
    }

    .btn-delete-custom svg {
        width: 18px;
        height: 18px;
        stroke: #000000;
        stroke-width: 2.5;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .edit-control > .btn::before,
    .edit-control > button::before,
    .edit-control > a.btn::before,
    .edit-control button[data-toggle="modal"]::before,
    .edit-control .btn[data-toggle="modal"]::before,
    .edit-control button[data-bs-toggle="modal"]::before,
    .edit-control .btn[data-bs-toggle="modal"]::before {
        content: "" !important;
        width: 18px !important;
        height: 18px !important;
        display: block !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        background-size: 18px 18px !important;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill='none' stroke='%23000000' stroke-width='2.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 20h9'/%3E%3Cpath d='M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z'/%3E%3C/svg%3E") !important;
    }

    .edit-control > .btn::after,
    .edit-control > button::after,
    .edit-control > a.btn::after {
        display: none !important;
        content: none !important;
    }

    .edit-control > .btn i,
    .edit-control > button i,
    .edit-control > a.btn i,
    .edit-control > .btn span,
    .edit-control > button span,
    .edit-control > a.btn span,
    .edit-control button[data-toggle="modal"] i,
    .edit-control .btn[data-toggle="modal"] i,
    .edit-control button[data-toggle="modal"] span,
    .edit-control .btn[data-toggle="modal"] span,
    .edit-control button[data-bs-toggle="modal"] i,
    .edit-control .btn[data-bs-toggle="modal"] i,
    .edit-control button[data-bs-toggle="modal"] span,
    .edit-control .btn[data-bs-toggle="modal"] span {
        display: none !important;
    }

    .produk-empty {
        height: 170px !important;
        vertical-align: middle !important;
        color: #777777;
        font-size: 15px;
    }

    .empty-state {
        min-height: 132px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .empty-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f0f6eb;
        color: var(--warehouse-green-dark);
    }

    .empty-icon svg {
        width: 25px;
        height: 25px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2.2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .produk-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-top: 12px;
        font-size: 14px;
        color: #000000;
        animation: fadeUp 0.55s ease both;
        animation-delay: 0.28s;
    }

    .produk-footer-count {
        color: #30342e;
    }

    .pagination-custom {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pagination-custom a,
    .pagination-custom span {
        text-decoration: none;
        color: #000000;
        font-size: 15px;
        font-weight: 400;
    }

    .pagination-custom a {
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .pagination-custom a:hover {
        color: var(--warehouse-green-dark);
        transform: translateY(-1px);
        text-decoration: none;
    }

    .pagination-custom .page-num {
        min-width: 41px;
        height: 30px;
        border-radius: 8px;
        background: #eef3ea;
        border: 1px solid #c8d6bd;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 7px 14px rgba(71, 100, 52, 0.09);
    }

    .pagination-custom .disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    .alert-custom {
        margin-bottom: 18px;
        border-radius: 14px;
        font-family: inherit;
        font-size: 14px;
        box-shadow: var(--warehouse-shadow-soft);
    }

    /* =========================
       POPUP TAMBAH / EDIT PRODUK
    ========================= */
    .modal-backdrop.show {
        opacity: 0.38 !important;
    }

    .modal-dialog {
        max-width: 860px !important;
    }

    .modal-content {
        border: none !important;
        border-radius: 22px !important;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.22) !important;
        overflow: hidden !important;
        font-family: "Poppins", system-ui, sans-serif !important;
        animation: modalPop 0.25s ease both !important;
    }

    .modal-header {
        min-height: 74px;
        background: linear-gradient(135deg, #8fb36b 0%, #9bc67a 100%) !important;
        border-bottom: none !important;
        padding: 22px 26px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }

    .modal-title {
        color: #000000 !important;
        font-family: inherit !important;
        font-size: 24px !important;
        font-weight: 700 !important;
        margin: 0 !important;
    }

    .modal-header .close {
        width: 38px !important;
        height: 38px !important;
        min-width: 38px !important;
        border: none !important;
        border-radius: 50% !important;
        background: #ffe4e4 !important;
        color: #e53935 !important;
        opacity: 1 !important;
        padding: 0 !important;
        margin: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: none !important;
        text-shadow: none !important;
        font-size: 0 !important;
        line-height: 1 !important;
        transition: transform 0.22s ease, background 0.22s ease !important;
    }

    .modal-header .close::before {
        content: "×";
        font-family: inherit;
        font-size: 30px;
        font-weight: 700;
        color: #e53935;
        line-height: 1;
        margin-top: -3px;
    }

    .modal-header .close span,
    .modal-header .close i,
    .modal-header .close::after {
        display: none !important;
    }

    .modal-header .close:hover {
        background: #ffd2d2 !important;
        transform: rotate(90deg) !important;
    }

    .modal-body {
        background: #ffffff !important;
        padding: 26px 28px 14px !important;
    }

    .modal-body label,
    .modal .form-group label {
        font-family: inherit !important;
        font-size: 15px !important;
        font-weight: 600 !important;
        color: #000000 !important;
        margin-bottom: 8px !important;
    }

    .modal .form-control,
    .modal select,
    .modal input[type="text"],
    .modal input[type="number"],
    .modal input[type="file"],
    .modal textarea {
        min-height: 44px !important;
        border: 1px solid #c9c9c9 !important;
        border-radius: 10px !important;
        box-shadow: none !important;
        font-family: inherit !important;
        font-size: 15px !important;
        color: #000000 !important;
        padding: 9px 12px !important;
        background: #ffffff !important;
    }

    .modal textarea {
        min-height: 88px !important;
        resize: vertical;
    }

    .modal .form-control:focus,
    .modal select:focus,
    .modal input:focus,
    .modal textarea:focus {
        border-color: #8fb36b !important;
        box-shadow: 0 0 0 3px rgba(143, 179, 107, 0.22) !important;
        outline: none !important;
    }

    .modal .text-muted,
    .modal small {
        font-family: inherit !important;
        font-size: 14px !important;
        color: #6f7b85 !important;
    }

    .modal-footer {
        border-top: none !important;
        background: #ffffff !important;
        padding: 16px 28px 28px !important;
        display: flex !important;
        justify-content: flex-end !important;
        align-items: center !important;
        gap: 12px !important;
    }

    .modal-footer .btn::before,
    .modal-footer .btn::after,
    .modal-footer button::before,
    .modal-footer button::after {
        display: none !important;
        content: none !important;
    }

    .modal-footer .btn,
    .modal-footer button {
        min-width: 118px !important;
        height: 43px !important;
        border: none !important;
        border-radius: 14px !important;
        font-family: inherit !important;
        font-size: 15px !important;
        font-weight: 600 !important;
        box-shadow: none !important;
        padding: 0 18px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        line-height: 1 !important;
        transition: transform 0.22s ease, filter 0.22s ease !important;
    }

    .modal-footer .btn:hover,
    .modal-footer button:hover {
        transform: translateY(-1px) !important;
        filter: brightness(0.98) !important;
    }

    .modal-footer .btn-secondary,
    .modal-footer .btn-light,
    .modal-footer button[data-dismiss="modal"] {
        background: #eeeeee !important;
        color: #000000 !important;
    }

    .modal-footer .btn-primary,
    .modal-footer .btn-success,
    .modal-footer button[type="submit"] {
        background: #8fb36b !important;
        color: #000000 !important;
    }

    .modal .invalid-feedback,
    .modal .text-danger {
        font-family: inherit !important;
        font-size: 13px !important;
    }



    /* FIX MODAL TAMBAH / EDIT
       Modal dari component berada di dalam header/table. Agar tidak terpotong
       oleh wrapper tabel dan tetap rapi, style di bawah membuat form mandiri
       tanpa bergantung penuh pada grid Bootstrap. */
    body.modal-open .produk-page {
        overflow: visible !important;
    }

    .modal {
        z-index: 5050 !important;
        overflow-x: hidden !important;
        overflow-y: auto !important;
        padding-right: 0 !important;
    }

    .modal-backdrop {
        z-index: 5040 !important;
    }

    .modal.show .modal-dialog {
        transform: none !important;
    }

    .modal-dialog.modal-lg,
    .modal-dialog {
        width: min(860px, calc(100vw - 36px)) !important;
        max-width: min(860px, calc(100vw - 36px)) !important;
        margin: 54px auto !important;
        pointer-events: auto !important;
    }

    .modal form {
        display: block !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #ffffff !important;
    }

    .modal-body {
        width: 100% !important;
        max-height: calc(100vh - 220px) !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
    }

    .modal-body::-webkit-scrollbar {
        width: 9px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #f1f5ed;
        border-radius: 999px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: #b9cfa8;
        border-radius: 999px;
        border: 2px solid #f1f5ed;
    }

    .modal-body .row {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        gap: 18px !important;
        margin: 0 0 18px 0 !important;
        width: 100% !important;
    }

    .modal-body .row:last-child {
        margin-bottom: 0 !important;
    }

    .modal-body .col-md-6,
    .modal-body .col-md-12,
    .modal-body [class*="col-"] {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        flex: none !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .modal .form-group {
        width: 100% !important;
        margin: 0 0 18px 0 !important;
    }

    .modal-body .row .form-group {
        margin-bottom: 0 !important;
    }

    .modal .form-control,
    .modal .form-control-file,
    .modal select,
    .modal input[type="text"],
    .modal input[type="number"],
    .modal input[type="file"],
    .modal textarea {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .modal input[type="file"],
    .modal .form-control-file {
        height: auto !important;
        min-height: 48px !important;
        line-height: 1.4 !important;
        cursor: pointer !important;
    }

    .modal select.form-control {
        appearance: auto !important;
    }

    .modal .img-thumbnail {
        display: block !important;
        width: 112px !important;
        height: 112px !important;
        object-fit: cover !important;
        border-radius: 16px !important;
        border: 1px solid rgba(143, 179, 107, 0.45) !important;
        padding: 6px !important;
        background: #f7fbf4 !important;
        box-shadow: 0 8px 18px rgba(65, 82, 54, 0.10) !important;
    }

    .modal-footer {
        position: relative !important;
        z-index: 2 !important;
    }

    @media (max-width: 640px) {
        .modal-dialog.modal-lg,
        .modal-dialog {
            width: calc(100vw - 24px) !important;
            max-width: calc(100vw - 24px) !important;
            margin: 28px auto !important;
        }

        .modal-body {
            max-height: calc(100vh - 185px) !important;
            padding: 20px 18px 10px !important;
        }

        .modal-body .row {
            grid-template-columns: 1fr !important;
            gap: 14px !important;
        }

        .modal-header {
            min-height: 66px !important;
            padding: 18px 20px !important;
        }

        .modal-title {
            font-size: 20px !important;
        }

        .modal-footer {
            padding: 14px 18px 22px !important;
            flex-direction: column-reverse !important;
        }

        .modal-footer .btn,
        .modal-footer button {
            width: 100% !important;
        }
    }

    /* =========================
       DELETE POPUP
    ========================= */
    .delete-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.38);
        backdrop-filter: blur(5px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 5000;
        padding: 20px;
    }

    .delete-modal-overlay.show {
        display: flex;
        animation: fadeIn 0.2s ease both;
    }

    .delete-modal-box {
        width: 100%;
        max-width: 430px;
        background: #ffffff;
        border-radius: 22px;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.22);
        padding: 30px 30px 25px;
        font-family: inherit;
        text-align: center;
        animation: modalPop 0.25s ease both;
    }

    .delete-modal-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 17px;
        border-radius: 50%;
        background: #ffe4e4;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulseDanger 1.65s ease-in-out infinite;
    }

    .delete-modal-icon svg {
        width: 39px;
        height: 39px;
        stroke: #ff4b4b;
        stroke-width: 2.4;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .delete-modal-title {
        font-size: 22px;
        font-weight: 600;
        color: #000000;
        margin-bottom: 8px;
    }

    .delete-modal-text {
        font-size: 15px;
        font-weight: 400;
        color: #555555;
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .delete-modal-text strong {
        color: #000000;
        font-weight: 600;
    }

    .delete-modal-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .delete-cancel-btn,
    .delete-confirm-btn {
        min-width: 122px;
        height: 42px;
        border: none;
        border-radius: 12px;
        font-family: inherit;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.22s ease, filter 0.22s ease;
    }

    .delete-cancel-btn:hover,
    .delete-confirm-btn:hover {
        transform: translateY(-1px);
        filter: brightness(0.98);
    }

    .delete-cancel-btn {
        background: #eeeeee;
        color: #000000;
    }

    .delete-confirm-btn {
        background: #ff4b4b;
        color: #ffffff;
    }

    @keyframes pageReveal {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes rowIn {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes lineGrow {
        from { width: 0; }
        to { width: 58px; }
    }

    @keyframes floatBlob {
        0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
        50% { transform: translate3d(-12px, 12px, 0) scale(1.05); }
    }

    @keyframes shimmerButton {
        0%, 45% { transform: translateX(-115%); }
        70%, 100% { transform: translateX(115%); }
    }

    @keyframes gradientSlide {
        from { background-position: 0% 50%; }
        to { background-position: 200% 50%; }
    }

    @keyframes stockGrow {
        from { transform: scaleX(0); }
        to { transform: scaleX(1); }
    }

    @keyframes modalPop {
        from { opacity: 0; transform: scale(0.96) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    @keyframes pulseDanger {
        0%, 100% { box-shadow: 0 0 0 0 rgba(255, 75, 75, 0.22); }
        50% { box-shadow: 0 0 0 12px rgba(255, 75, 75, 0); }
    }

    @media (max-width: 900px) {
        .produk-page {
            padding: 24px 18px 50px;
        }

        .produk-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 22px;
        }

        .produk-header-right {
            width: 100%;
            margin-right: 0;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .produk-search-form {
            width: 100%;
            max-width: 420px;
        }

        .filter-section {
            margin-bottom: 36px;
        }

        .produk-footer {
            flex-direction: column;
            align-items: flex-start;
        }

        .delete-modal-actions {
            flex-direction: column;
        }

        .delete-cancel-btn,
        .delete-confirm-btn {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .produk-page *,
        .produk-page::before,
        .produk-page::after,
        .delete-modal-overlay,
        .delete-modal-box,
        .delete-modal-icon,
        .modal-content {
            animation: none !important;
            transition: none !important;
        }
    }
</style>

<div class="produk-page">
    <div class="produk-content">
        @php
            $currentSearch = request('search', '');
            $currentStockFilter = request('stock_filter', 'semua');

            if ($produk instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                $currentPerPage = request('per_page', $produk->perPage());
            } else {
                $currentPerPage = request('per_page', 10);
            }
        @endphp

        <div class="produk-header">
            <div class="produk-title-block">
                <h1 class="produk-title">DAFTAR BARANG</h1>
                <p class="produk-subtitle">Kelola data barang, stok, kategori, dan harga dengan tampilan yang lebih rapi.</p>
            </div>

            <div class="produk-header-right">
                <form action="{{ route('master-data.produk.index') }}" method="GET" class="produk-search-form">
                    <input type="hidden" name="stock_filter" value="{{ $currentStockFilter }}">
                    <input type="hidden" name="per_page" value="{{ $currentPerPage }}">

                    <div class="search-box">
                        <button type="submit" aria-label="Cari produk">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="11" cy="11" r="7" stroke-width="2.7"></circle>
                                <path d="M16.5 16.5L21 21" stroke-width="2.7" stroke-linecap="round"></path>
                            </svg>
                        </button>

                        <input
                            type="text"
                            name="search"
                            placeholder="Search"
                            value="{{ $currentSearch }}"
                        >

                        @if($currentSearch !== '')
                            <a
                                href="{{ route('master-data.produk.index', ['stock_filter' => $currentStockFilter, 'per_page' => $currentPerPage]) }}"
                                class="search-clear"
                                aria-label="Hapus pencarian"
                                title="Hapus pencarian"
                            >×</a>
                        @endif
                    </div>
                </form>

                <div class="add-product-area">
                    <span class="add-product-label">Tambah barang :</span>

                    <div class="add-product-control">
                        <x-produk.form-data-produk />
                    </div>
                </div>
            </div>
        </div>

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

        <div class="filter-section">
            <form action="{{ route('master-data.produk.index') }}" method="GET" id="filterStockForm">
                <input type="hidden" name="search" value="{{ $currentSearch }}">
                <input type="hidden" name="per_page" value="{{ $currentPerPage }}">

                <label for="stock_filter" class="filter-label">Filter stock berdasarkan :</label>

                <div class="filter-select-wrap">
                    <select
                        name="stock_filter"
                        id="stock_filter"
                        class="filter-select"
                        onchange="document.getElementById('filterStockForm').submit()"
                    >
                        <option value="semua" {{ $currentStockFilter === 'semua' ? 'selected' : '' }}>Semua</option>
                        <option value="habis" {{ $currentStockFilter === 'habis' ? 'selected' : '' }}>Stok Habis</option>
                        <option value="rendah" {{ $currentStockFilter === 'rendah' ? 'selected' : '' }}>Stok Rendah</option>
                        <option value="tersedia" {{ $currentStockFilter === 'tersedia' ? 'selected' : '' }}>Stok Tersedia</option>
                    </select>
                </div>
            </form>
        </div>

        <form action="{{ route('master-data.produk.index') }}" method="GET" id="entriesForm">
            <input type="hidden" name="search" value="{{ $currentSearch }}">
            <input type="hidden" name="stock_filter" value="{{ $currentStockFilter }}">

            <div class="table-control-row">
                <span>Show</span>

                <select
                    name="per_page"
                    class="entries-select"
                    onchange="document.getElementById('entriesForm').submit()"
                >
                    <option value="5" {{ (int) $currentPerPage === 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ (int) $currentPerPage === 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ (int) $currentPerPage === 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ (int) $currentPerPage === 50 ? 'selected' : '' }}>50</option>
                </select>

                <span>Entries</span>
            </div>
        </form>

        <div class="produk-table-card">
            <div class="produk-table-wrap">
                <table class="produk-table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-gambar">GAMBAR BARANG</th>
                            <th class="col-nama">Nama Barang</th>
                            <th class="col-kategori">Kategori</th>
                            <th class="col-stok">Stok</th>
                            <th class="col-harga">Harga</th>
                            <th class="col-opsi">OPSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($produk as $index => $item)
                            @php
                                $rowNumber = $produk instanceof \Illuminate\Pagination\LengthAwarePaginator ? $produk->firstItem() + $index : $index + 1;
                                $stok = (int) ($item->stok ?? 0);
                                $stockPercent = max(8, min(100, ($stok / 50) * 100));
                                $stockStatus = $stok <= 0 ? 'habis' : ($stok <= 5 ? 'rendah' : ($stok <= 20 ? 'aman' : 'tinggi'));
                                $stockStatusLabel = $stok <= 0 ? 'Habis' : ($stok <= 5 ? 'Rendah' : ($stok <= 20 ? 'Aman' : 'Tinggi'));
                                $kategoriNama = data_get($item, 'kategori.nama_kategori') ?? data_get($item, 'kategoriProduk.nama_kategori') ?? '-';
                            @endphp

                            <tr style="--delay: {{ $index * 45 }}ms;">
                                <td>
                                    <span class="row-number">{{ $rowNumber }}</span>
                                </td>

                                <td>
                                    <div class="produk-image-wrap">
                                        <div class="produk-image-card">
                                            @if($item->gambar)
                                                <img
                                                    src="{{ asset('storage/' . $item->gambar) }}"
                                                    alt="{{ $item->nama_produk }}"
                                                    class="produk-image"
                                                >
                                            @else
                                                <div class="produk-placeholder" aria-label="Tidak ada gambar">
                                                    <svg viewBox="0 0 120 120">
                                                        <rect x="18" y="16" width="84" height="88" rx="10"></rect>
                                                        <circle cx="42" cy="42" r="8"></circle>
                                                        <path d="M24 100L62 60L102 100"></path>
                                                        <path d="M70 72L84 58L102 76"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="nama-dot"></div>
                                    <span class="nama-text">{{ $item->nama_produk ?? '-' }}</span>
                                </td>

                                <td>
                                    <span class="kategori-badge">
                                        {{ $kategoriNama }}
                                    </span>
                                </td>

                                <td>
                                    <div class="stock-cell">
                                        <span class="stock-number">{{ $stok }}</span>
                                        <span class="stock-bar" aria-hidden="true">
                                            <span class="stock-fill" style="width: {{ $stockPercent }}%"></span>
                                        </span>
                                        <span class="stock-status {{ $stockStatus }}">{{ $stockStatusLabel }}</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="harga-pill">
                                        Rp {{ number_format((float) ($item->harga ?? 0), 0, ',', '.') }}
                                    </span>
                                </td>

                                <td>
                                    <div class="opsi-actions">
                                        <form
                                            action="{{ route('master-data.produk.destroy', $item->id) }}"
                                            method="POST"
                                            class="delete-form"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                class="btn-delete-custom open-delete-modal"
                                                title="Hapus data"
                                                data-product-name="{{ $item->nama_produk ?? 'barang ini' }}"
                                            >
                                                <svg viewBox="0 0 24 24">
                                                    <path d="M3 6H21"></path>
                                                    <path d="M8 6V4H16V6"></path>
                                                    <path d="M6 6L7 21H17L18 6"></path>
                                                    <path d="M10 10V17"></path>
                                                    <path d="M14 10V17"></path>
                                                </svg>
                                            </button>
                                        </form>

                                        <div class="edit-control">
                                            <x-produk.form-data-produk :id="$item->id" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="produk-empty">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <svg viewBox="0 0 24 24">
                                                <circle cx="11" cy="11" r="7"></circle>
                                                <path d="M16.5 16.5L21 21"></path>
                                                <path d="M8.5 11H13.5"></path>
                                            </svg>
                                        </div>
                                        <strong>Data produk tidak ditemukan.</strong>
                                        <span>Coba ubah kata kunci pencarian atau filter stok.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="produk-footer">
            <div class="produk-footer-count">
                @if($produk instanceof \Illuminate\Pagination\LengthAwarePaginator && $produk->total() > 0)
                    Showing {{ $produk->firstItem() }} to {{ $produk->lastItem() }} out of {{ $produk->total() }} entries
                @else
                    Showing 0 out of 0 entries
                @endif
            </div>

            @if($produk instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="pagination-custom">
                    @if($produk->onFirstPage())
                        <span class="disabled">‹ Prev</span>
                    @else
                        <a href="{{ $produk->appends(request()->query())->previousPageUrl() }}">‹ Prev</a>
                    @endif

                    <span class="page-num">{{ $produk->currentPage() }}</span>

                    @if($produk->hasMorePages())
                        <a href="{{ $produk->appends(request()->query())->nextPageUrl() }}">Next ›</a>
                    @else
                        <span class="disabled">Next ›</span>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<div class="delete-modal-overlay" id="deleteModal">
    <div class="delete-modal-box">
        <div class="delete-modal-icon">
            <svg viewBox="0 0 24 24">
                <path d="M3 6H21"></path>
                <path d="M8 6V4H16V6"></path>
                <path d="M6 6L7 21H17L18 6"></path>
                <path d="M10 10V17"></path>
                <path d="M14 10V17"></path>
            </svg>
        </div>

        <h2 class="delete-modal-title">Hapus Barang?</h2>

        <p class="delete-modal-text">
            Data <strong id="deleteProductName">barang ini</strong> akan dihapus secara permanen.
            Tindakan ini tidak dapat dibatalkan.
        </p>

        <div class="delete-modal-actions">
            <button type="button" class="delete-cancel-btn" id="cancelDeleteBtn">
                Batal
            </button>

            <button type="button" class="delete-confirm-btn" id="confirmDeleteBtn">
                Hapus
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Modal tambah/edit dari component awalnya tercetak di dalam header/tabel.
        // Dipindahkan ke body supaya Bootstrap tidak terpotong oleh wrapper tabel.
        document.querySelectorAll('.add-product-control .modal, .edit-control .modal').forEach(function (modal) {
            if (modal.parentElement !== document.body) {
                document.body.appendChild(modal);
            }
        });

        const deleteModal = document.getElementById('deleteModal');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const deleteProductName = document.getElementById('deleteProductName');
        let selectedDeleteForm = null;

        document.querySelectorAll('.open-delete-modal').forEach(function (button) {
            button.addEventListener('click', function () {
                selectedDeleteForm = button.closest('form');
                const productName = button.getAttribute('data-product-name') || 'barang ini';

                if (deleteProductName) {
                    deleteProductName.textContent = productName;
                }

                if (deleteModal) {
                    deleteModal.classList.add('show');
                }
            });
        });

        if (cancelDeleteBtn) {
            cancelDeleteBtn.addEventListener('click', function () {
                selectedDeleteForm = null;
                deleteModal.classList.remove('show');
            });
        }

        if (deleteModal) {
            deleteModal.addEventListener('click', function (event) {
                if (event.target === deleteModal) {
                    selectedDeleteForm = null;
                    deleteModal.classList.remove('show');
                }
            });
        }

        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', function () {
                if (selectedDeleteForm) {
                    selectedDeleteForm.submit();
                }
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && deleteModal && deleteModal.classList.contains('show')) {
                selectedDeleteForm = null;
                deleteModal.classList.remove('show');
            }
        });

        function cleanProductModalButtons() {
            document.querySelectorAll('.modal-footer button, .modal-footer .btn').forEach(function (button) {
                const text = button.textContent.trim().toLowerCase();

                if (text.includes('simpan')) {
                    button.textContent = 'Simpan';
                }

                if (text.includes('batal')) {
                    button.textContent = 'Batal';
                }
            });

            document.querySelectorAll('.modal-header .close').forEach(function (button) {
                button.setAttribute('aria-label', 'Tutup popup');
            });
        }

        cleanProductModalButtons();

        document.addEventListener('click', function () {
            setTimeout(cleanProductModalButtons, 120);
        });

        if (window.jQuery) {
            window.jQuery('.modal').on('shown.bs.modal', function () {
                cleanProductModalButtons();
            });
        }

        document.addEventListener('shown.bs.modal', function () {
            cleanProductModalButtons();
        });
    });
</script>
@endsection
