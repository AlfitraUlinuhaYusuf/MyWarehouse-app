@extends('layouts.admin')

@section('content')
<style>
    :root {
        --mw-green: #8fb36b;
        --mw-green-dark: #6f9651;
        --mw-green-deep: #4f7438;
        --mw-green-soft: #eef7e8;
        --mw-green-pale: #f8fcf5;
        --mw-black: #050704;
        --mw-white: #ffffff;
        --mw-muted: #6d7567;
        --mw-border: rgba(79, 116, 56, 0.16);
        --mw-shadow: 0 18px 42px rgba(90, 123, 64, 0.14);
        --mw-shadow-soft: 0 12px 28px rgba(90, 123, 64, 0.10);
        --mw-danger: #d9342b;
        --mw-danger-soft: #fff0ee;
        --mw-blue: #4c94ff;
        --mw-blue-dark: #397feb;
        --mw-warning: #f4b23e;
        --mw-warning-soft: #fff8e8;
    }

    .produk-page,
    .produk-page * {
        box-sizing: border-box;
    }

    .produk-page {
        width: 100%;
        min-height: calc(100vh - 72px);
        padding: 42px 46px 82px;
        font-family: "Poppins", sans-serif;
        color: var(--mw-black);
        background:
            radial-gradient(circle at 8% 14%, rgba(143, 179, 107, 0.15), transparent 28%),
            radial-gradient(circle at 92% 72%, rgba(143, 179, 107, 0.12), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #fbfdf9 100%);
        overflow: hidden;
        position: relative;
        animation: produkFadeIn 0.52s ease both;
    }

    .produk-page::before,
    .produk-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        background: rgba(143, 179, 107, 0.10);
        filter: blur(1px);
        pointer-events: none;
        animation: produkFloat 6s ease-in-out infinite;
    }

    .produk-page::before {
        width: 145px;
        height: 145px;
        right: 52px;
        top: 108px;
    }

    .produk-page::after {
        width: 92px;
        height: 92px;
        left: 38px;
        bottom: 74px;
        animation-delay: 1.2s;
    }

    @keyframes produkFadeIn {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes produkFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-12px); }
    }

    @keyframes produkSlideUp {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes produkShine {
        0%, 58% { transform: translateX(-120%) rotate(14deg); }
        100% { transform: translateX(120%) rotate(14deg); }
    }

    @keyframes produkPulse {
        0% { opacity: 0.55; transform: scale(0.94); }
        70%, 100% { opacity: 0; transform: scale(1.18); }
    }

    @keyframes produkDotPulse {
        0%, 100% { opacity: 0.72; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.25); }
    }

    @keyframes produkRowIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes stockGrow {
        from { transform: scaleX(0); }
        to { transform: scaleX(1); }
    }

    @keyframes modalPop {
        from { opacity: 0; transform: scale(0.96) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes pulseDanger {
        0%, 100% { box-shadow: 0 0 0 0 rgba(217, 52, 43, 0.22); }
        50% { box-shadow: 0 0 0 12px rgba(217, 52, 43, 0); }
    }

    .produk-shell {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
    }

    .produk-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 28px;
        margin-bottom: 24px;
        animation: produkSlideUp 0.58s ease both;
    }

    .produk-title-wrap {
        max-width: 680px;
    }

    .produk-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(143, 179, 107, 0.14);
        color: var(--mw-green-deep);
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.2px;
    }

    .produk-eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--mw-green);
        box-shadow: 0 0 0 5px rgba(143, 179, 107, 0.16);
        animation: produkDotPulse 2s ease-in-out infinite;
    }

    .produk-title {
        margin: 0;
        color: var(--mw-black);
        font-size: clamp(26px, 3vw, 38px);
        font-weight: 800;
        line-height: 1.14;
        letter-spacing: -0.8px;
    }

    .produk-subtitle {
        max-width: 625px;
        margin: 12px 0 0;
        color: var(--mw-muted);
        font-size: 15px;
        font-weight: 500;
        line-height: 1.72;
    }

    .produk-action-row {
        min-width: 250px;
        padding: 14px;
        border: 1px solid var(--mw-border);
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.82);
        box-shadow: var(--mw-shadow-soft);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .produk-action-label-group {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .produk-action-label {
        font-size: 14px;
        font-weight: 800;
        color: var(--mw-black);
        line-height: 1.1;
    }

    .produk-action-helper {
        font-size: 12px;
        font-weight: 600;
        color: var(--mw-muted);
        line-height: 1.25;
    }

    .add-product-control {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        position: relative;
    }

    .add-product-control > .btn,
    .add-product-control > button,
    .add-product-control > a.btn,
    .add-product-control button[data-toggle="modal"],
    .add-product-control .btn[data-toggle="modal"],
    .add-product-control button[data-bs-toggle="modal"],
    .add-product-control .btn[data-bs-toggle="modal"] {
        width: 48px !important;
        height: 48px !important;
        min-width: 48px !important;
        border: none !important;
        border-radius: 17px !important;
        background: linear-gradient(135deg, var(--mw-green), var(--mw-green-dark)) !important;
        color: #ffffff !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
        cursor: pointer !important;
        transition: transform 0.24s ease, box-shadow 0.24s ease, filter 0.24s ease !important;
        position: relative !important;
        isolation: isolate !important;
        flex-shrink: 0 !important;
        box-shadow: 0 13px 24px rgba(143, 179, 107, 0.30) !important;
        padding: 0 !important;
        margin: 0 !important;
        overflow: visible !important;
        font-size: 0 !important;
        line-height: 1 !important;
    }

    .add-product-control > .btn::before,
    .add-product-control > button::before,
    .add-product-control > a.btn::before,
    .add-product-control button[data-toggle="modal"]::before,
    .add-product-control .btn[data-toggle="modal"]::before,
    .add-product-control button[data-bs-toggle="modal"]::before,
    .add-product-control .btn[data-bs-toggle="modal"]::before {
        content: "" !important;
        width: 25px !important;
        height: 25px !important;
        display: block !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        background-size: 25px 25px !important;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill='none' stroke='%23ffffff' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 5v14'/%3E%3Cpath d='M5 12h14'/%3E%3C/svg%3E") !important;
    }

    .add-product-control > .btn::after,
    .add-product-control > button::after,
    .add-product-control > a.btn::after {
        content: "" !important;
        position: absolute !important;
        inset: -6px !important;
        border-radius: 22px !important;
        border: 2px solid rgba(143, 179, 107, 0.25) !important;
        animation: produkPulse 2.4s ease-in-out infinite !important;
        z-index: -1 !important;
    }

    .add-product-control > .btn:hover,
    .add-product-control > button:hover,
    .add-product-control > a.btn:hover,
    .add-product-control button[data-toggle="modal"]:hover,
    .add-product-control .btn[data-toggle="modal"]:hover,
    .add-product-control button[data-bs-toggle="modal"]:hover,
    .add-product-control .btn[data-bs-toggle="modal"]:hover {
        color: #ffffff !important;
        text-decoration: none !important;
        transform: translateY(-3px) scale(1.02) !important;
        box-shadow: 0 18px 34px rgba(143, 179, 107, 0.36) !important;
        filter: saturate(1.06) !important;
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

    .produk-alert {
        margin: 0 0 22px;
        padding: 14px 16px;
        border-radius: 18px;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 10px 24px rgba(93, 66, 10, 0.08);
        animation: produkSlideUp 0.5s ease both;
    }

    .produk-alert.alert-danger {
        background: var(--mw-danger-soft);
        border: 1px solid rgba(217, 52, 43, 0.22);
        color: #9f251e;
    }

    .produk-alert.alert-success {
        background: var(--mw-green-soft);
        border: 1px solid rgba(79, 116, 56, 0.22);
        color: var(--mw-green-deep);
    }

    .produk-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
        animation: produkSlideUp 0.58s ease both;
        animation-delay: 0.08s;
    }

    .summary-card {
        min-height: 116px;
        border-radius: 24px;
        border: 1px solid var(--mw-border);
        background: rgba(255, 255, 255, 0.90);
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        box-shadow: var(--mw-shadow-soft);
        transition: transform 0.24s ease, box-shadow 0.24s ease, border-color 0.24s ease;
        overflow: hidden;
        position: relative;
    }

    .summary-card::before {
        content: "";
        position: absolute;
        top: -48%;
        left: -45%;
        width: 52%;
        height: 190%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.58), transparent);
        animation: produkShine 5s ease-in-out infinite;
        pointer-events: none;
    }

    .summary-card::after {
        content: "";
        position: absolute;
        width: 112px;
        height: 112px;
        right: -36px;
        bottom: -42px;
        border-radius: 50%;
        background: rgba(143, 179, 107, 0.10);
    }

    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--mw-shadow);
        border-color: rgba(143, 179, 107, 0.34);
    }

    .summary-label,
    .summary-number,
    .summary-caption,
    .summary-icon {
        position: relative;
        z-index: 1;
    }

    .summary-label {
        margin-bottom: 7px;
        font-size: 14px;
        font-weight: 700;
        color: var(--mw-muted);
    }

    .summary-number {
        color: var(--mw-black);
        font-size: 34px;
        font-weight: 800;
        line-height: 1;
        letter-spacing: -0.6px;
    }

    .summary-caption {
        margin-top: 8px;
        color: #839077;
        font-size: 12px;
        font-weight: 600;
    }

    .summary-icon {
        width: 56px;
        height: 56px;
        border-radius: 19px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: transform 0.24s ease;
    }

    .summary-card:hover .summary-icon {
        transform: translateY(-2px) rotate(-4deg) scale(1.04);
    }

    .summary-icon svg {
        width: 28px;
        height: 28px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2.25;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .summary-total .summary-icon {
        background: var(--mw-green-soft);
        color: var(--mw-green-deep);
    }

    .summary-low .summary-icon {
        background: var(--mw-warning-soft);
        color: #aa7200;
    }

    .summary-empty .summary-icon {
        background: var(--mw-danger-soft);
        color: var(--mw-danger);
    }

    .produk-card {
        width: 100%;
        border: 1px solid var(--mw-border);
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.92);
        padding: 22px;
        box-shadow: var(--mw-shadow);
        backdrop-filter: blur(10px);
        animation: produkSlideUp 0.6s ease both;
        animation-delay: 0.15s;
        position: relative;
        overflow: hidden;
    }

    .produk-card::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 5px;
        background: linear-gradient(90deg, var(--mw-green), rgba(143, 179, 107, 0.25), var(--mw-green-dark));
    }

    .produk-card-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
        padding-top: 6px;
    }

    .produk-section-title {
        margin: 0;
        font-size: 20px;
        font-weight: 800;
        color: var(--mw-black);
        letter-spacing: -0.2px;
    }

    .produk-section-text {
        margin: 7px 0 0;
        color: var(--mw-muted);
        font-size: 13px;
        font-weight: 600;
        line-height: 1.55;
    }

    .produk-control-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .entries-control,
    .filter-control {
        min-height: 48px;
        padding: 7px 12px;
        border: 1px solid rgba(79, 116, 56, 0.18);
        border-radius: 18px;
        background: var(--mw-green-pale);
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 13px;
        font-weight: 700;
        color: var(--mw-muted);
        white-space: nowrap;
    }

    .entries-control select,
    .filter-control select {
        height: 34px;
        border: 1px solid rgba(79, 116, 56, 0.20);
        border-radius: 12px;
        background: #ffffff;
        font-family: "Poppins", sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: var(--mw-black);
        padding: 0 9px;
        outline: none;
        cursor: pointer;
        transition: border-color 0.22s ease, box-shadow 0.22s ease, transform 0.22s ease;
    }

    .entries-control select {
        width: 76px;
    }

    .filter-control select {
        width: 152px;
    }

    .entries-control select:focus,
    .filter-control select:focus {
        border-color: var(--mw-green);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.15);
        transform: translateY(-1px);
    }

    .produk-search-form {
        width: min(100%, 340px);
        margin-left: auto;
    }

    .produk-search {
        width: 100%;
        height: 50px;
        border: 1px solid rgba(79, 116, 56, 0.18);
        border-radius: 999px;
        display: flex;
        align-items: center;
        padding: 0 18px;
        background: #ffffff;
        box-shadow: 0 10px 20px rgba(90, 123, 64, 0.06);
        transition: border-color 0.22s ease, box-shadow 0.22s ease, transform 0.22s ease;
    }

    .produk-search:focus-within {
        border-color: var(--mw-green);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.15), 0 14px 28px rgba(90, 123, 64, 0.11);
        transform: translateY(-2px);
    }

    .produk-search button {
        border: none;
        background: transparent;
        padding: 0;
        margin: 0;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .produk-search svg {
        width: 20px;
        height: 20px;
        margin-right: 10px;
        stroke: var(--mw-green-dark);
        stroke-width: 2.6;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
    }

    .produk-search input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: var(--mw-black);
    }

    .produk-search input::placeholder {
        color: #92a187;
    }

    .search-clear {
        width: 24px;
        height: 24px;
        min-width: 24px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        background: #edf2e9;
        color: var(--mw-green-deep);
        font-size: 18px;
        font-weight: 800;
        line-height: 1;
        transition: transform 0.22s ease, background 0.22s ease, color 0.22s ease;
    }

    .search-clear:hover {
        background: var(--mw-danger-soft);
        color: var(--mw-danger);
        transform: rotate(90deg);
        text-decoration: none;
    }

    .produk-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid rgba(79, 116, 56, 0.14);
        border-radius: 22px;
        background: #ffffff;
        box-shadow: 0 12px 28px rgba(90, 123, 64, 0.08);
    }

    .produk-table-wrap::-webkit-scrollbar {
        height: 10px;
    }

    .produk-table-wrap::-webkit-scrollbar-track {
        background: #eef3ea;
        border-radius: 999px;
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
        font-family: "Poppins", sans-serif;
        color: var(--mw-black);
        overflow: hidden;
    }

    .produk-table th {
        height: 58px;
        background: linear-gradient(180deg, #f1f6ed, #e9f2e4);
        border-bottom: 1px solid rgba(79, 116, 56, 0.15);
        text-align: center;
        vertical-align: middle;
        color: #385a25;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.45px;
        white-space: nowrap;
    }

    .produk-table th:not(:last-child),
    .produk-table td:not(:last-child) {
        border-right: 1px solid rgba(79, 116, 56, 0.10);
    }

    .produk-table td {
        height: 88px;
        border-bottom: 1px solid rgba(79, 116, 56, 0.10);
        text-align: center;
        vertical-align: middle;
        padding: 12px 14px;
        font-size: 14px;
        font-weight: 600;
        color: var(--mw-black);
        background: rgba(255, 255, 255, 0.94);
        transition: background 0.22s ease, transform 0.22s ease;
    }

    .produk-table tbody tr:last-child td {
        border-bottom: none;
    }

    .produk-row {
        animation: produkRowIn 0.38s ease both;
    }

    .produk-row:nth-child(1) { animation-delay: 0.03s; }
    .produk-row:nth-child(2) { animation-delay: 0.06s; }
    .produk-row:nth-child(3) { animation-delay: 0.09s; }
    .produk-row:nth-child(4) { animation-delay: 0.12s; }
    .produk-row:nth-child(5) { animation-delay: 0.15s; }

    .produk-table tbody .produk-row:hover td {
        background: #fbfef8;
    }

    .produk-table tbody .produk-row:hover td:first-child {
        color: var(--mw-green-dark);
    }

    .col-no { width: 7%; }
    .col-gambar { width: 13%; }
    .col-nama { width: 23%; }
    .col-kategori { width: 16%; }
    .col-stok { width: 14%; }
    .col-harga { width: 16%; }
    .col-opsi { width: 11%; }

    .row-number {
        min-width: 36px;
        height: 36px;
        border-radius: 14px;
        border: 1px solid rgba(79, 116, 56, 0.18);
        background: var(--mw-green-soft);
        color: var(--mw-green-deep);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 900;
    }

    .produk-image-card {
        width: 62px;
        height: 62px;
        margin: 0 auto;
        border-radius: 18px;
        border: 1px solid rgba(79, 116, 56, 0.16);
        background: #f7fbf4;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 18px rgba(90, 123, 64, 0.10);
        transition: transform 0.22s ease, box-shadow 0.22s ease;
        overflow: hidden;
    }

    .produk-row:hover .produk-image-card {
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 14px 24px rgba(90, 123, 64, 0.16);
    }

    .produk-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .produk-placeholder svg {
        width: 32px;
        height: 32px;
        stroke: var(--mw-green-dark);
        stroke-width: 2.2;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .item-name {
        display: inline-block;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
        font-weight: 800;
    }

    .kategori-badge {
        min-width: 94px;
        min-height: 34px;
        padding: 7px 13px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 0.1px;
        position: relative;
        overflow: hidden;
        background: #e7f7df;
        color: #2f7d32;
        border: 1px solid rgba(47, 125, 50, 0.22);
        box-shadow: 0 8px 18px rgba(47, 125, 50, 0.08);
        max-width: 100%;
    }

    .kategori-badge::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        background: #2f7d32;
        box-shadow: 0 0 0 4px rgba(47, 125, 50, 0.12);
        animation: produkDotPulse 1.8s ease-in-out infinite;
        flex-shrink: 0;
    }

    .stock-cell {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-width: 104px;
    }

    .stock-number {
        min-width: 44px;
        height: 36px;
        border-radius: 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 900;
        background: var(--mw-green-soft);
        color: var(--mw-green-deep);
        border: 1px solid rgba(79, 116, 56, 0.18);
    }

    .stock-mini {
        width: 48px;
        height: 7px;
        border-radius: 999px;
        background: #e7ece3;
        overflow: hidden;
        flex-shrink: 0;
    }

    .stock-fill {
        display: block;
        height: 100%;
        border-radius: 999px;
        transform-origin: left center;
        animation: stockGrow 1s ease both;
    }

    .stock-fill.habis { background: var(--mw-danger); }
    .stock-fill.rendah { background: var(--mw-warning); }
    .stock-fill.aman,
    .stock-fill.tinggi { background: var(--mw-green); }

    .harga-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 118px;
        height: 36px;
        padding: 0 13px;
        border-radius: 999px;
        background: #f6faf2;
        border: 1px solid rgba(79, 116, 56, 0.14);
        color: #53634a;
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    .opsi-actions {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
    }

    .delete-form {
        margin: 0;
        padding: 0;
        display: inline-flex;
    }

    .btn-delete-custom,
    .edit-control > .btn,
    .edit-control > button,
    .edit-control > a.btn,
    .edit-control button[data-toggle="modal"],
    .edit-control .btn[data-toggle="modal"],
    .edit-control button[data-bs-toggle="modal"],
    .edit-control .btn[data-bs-toggle="modal"] {
        width: 40px !important;
        height: 40px !important;
        min-width: 40px !important;
        border: none !important;
        border-radius: 14px !important;
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
        transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease !important;
    }

    .btn-delete-custom {
        background: var(--mw-danger-soft) !important;
        color: var(--mw-danger) !important;
        border: 1px solid rgba(217, 52, 43, 0.20) !important;
    }

    .edit-control > .btn,
    .edit-control > button,
    .edit-control > a.btn,
    .edit-control button[data-toggle="modal"],
    .edit-control .btn[data-toggle="modal"],
    .edit-control button[data-bs-toggle="modal"],
    .edit-control .btn[data-bs-toggle="modal"] {
        background: #e8f0ff !important;
        color: var(--mw-blue-dark) !important;
        border: 1px solid rgba(76, 148, 255, 0.22) !important;
    }

    .btn-delete-custom:hover,
    .edit-control > .btn:hover,
    .edit-control > button:hover,
    .edit-control > a.btn:hover,
    .edit-control button[data-toggle="modal"]:hover,
    .edit-control .btn[data-toggle="modal"]:hover,
    .edit-control button[data-bs-toggle="modal"]:hover,
    .edit-control .btn[data-bs-toggle="modal"]:hover {
        transform: translateY(-2px) !important;
        filter: saturate(1.05) !important;
    }

    .btn-delete-custom:hover {
        box-shadow: 0 10px 18px rgba(217, 52, 43, 0.13) !important;
    }

    .edit-control > .btn:hover,
    .edit-control > button:hover,
    .edit-control > a.btn:hover,
    .edit-control button[data-toggle="modal"]:hover,
    .edit-control .btn[data-toggle="modal"]:hover,
    .edit-control button[data-bs-toggle="modal"]:hover,
    .edit-control .btn[data-bs-toggle="modal"]:hover {
        box-shadow: 0 10px 18px rgba(76, 148, 255, 0.14) !important;
    }

    .btn-delete-custom svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        stroke-width: 2.35;
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
        width: 20px !important;
        height: 20px !important;
        display: block !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        background-size: 20px 20px !important;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill='none' stroke='%23397feb' stroke-width='2.35' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 20h9'/%3E%3Cpath d='M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z'/%3E%3C/svg%3E") !important;
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
        height: 96px !important;
        padding: 28px !important;
        color: var(--mw-muted) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        line-height: 1.7;
        background: #fbfef8 !important;
    }

    .empty-state {
        min-height: 120px;
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
        background: var(--mw-green-soft);
        color: var(--mw-green-deep);
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
        margin-top: 18px;
        font-size: 13px;
        font-weight: 700;
        color: var(--mw-muted);
    }

    .pagination-custom {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pagination-custom a,
    .pagination-custom span {
        font-family: "Poppins", sans-serif;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
    }

    .pagination-custom a {
        min-height: 38px;
        border: 1px solid rgba(79, 116, 56, 0.16);
        border-radius: 999px;
        background: #ffffff;
        color: var(--mw-green-deep);
        cursor: pointer;
        padding: 9px 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.22s ease, box-shadow 0.22s ease, background 0.22s ease, opacity 0.22s ease;
    }

    .pagination-custom a:hover {
        background: var(--mw-green-soft);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(90, 123, 64, 0.12);
        text-decoration: none;
        color: var(--mw-green-deep);
    }

    .pagination-custom .disabled {
        min-height: 38px;
        border: 1px solid rgba(79, 116, 56, 0.16);
        border-radius: 999px;
        background: #ffffff;
        color: var(--mw-green-deep);
        opacity: 0.46;
        cursor: not-allowed;
        padding: 9px 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .pagination-custom .page-num {
        min-width: 42px;
        height: 38px;
        border-radius: 14px;
        border: 1px solid rgba(79, 116, 56, 0.18);
        background: var(--mw-green);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 18px rgba(143, 179, 107, 0.24);
    }

    /* Modal tambah/edit produk */
    body.modal-open .produk-page {
        overflow: visible !important;
    }

    .modal-backdrop.show {
        opacity: 0.38 !important;
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
        background: linear-gradient(135deg, var(--mw-green) 0%, #9bc67a 100%) !important;
        border-bottom: none !important;
        padding: 22px 26px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }

    .modal-title {
        color: var(--mw-black) !important;
        font-family: inherit !important;
        font-size: 24px !important;
        font-weight: 800 !important;
        margin: 0 !important;
    }

    .modal-header .close,
    .modal-header .btn-close {
        width: 38px !important;
        height: 38px !important;
        min-width: 38px !important;
        border: none !important;
        border-radius: 50% !important;
        background: #ffe4e4 !important;
        color: var(--mw-danger) !important;
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

    .modal-header .close::before,
    .modal-header .btn-close::before {
        content: "×";
        font-family: inherit;
        font-size: 30px;
        font-weight: 800;
        color: var(--mw-danger);
        line-height: 1;
        margin-top: -3px;
    }

    .modal-header .close span,
    .modal-header .close i,
    .modal-header .close::after,
    .modal-header .btn-close::after {
        display: none !important;
    }

    .modal-header .close:hover,
    .modal-header .btn-close:hover {
        background: #ffd2d2 !important;
        transform: rotate(90deg) !important;
    }

    .modal form {
        display: block !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #ffffff !important;
    }

    .modal-body {
        background: #ffffff !important;
        width: 100% !important;
        max-height: calc(100vh - 220px) !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        padding: 26px 28px 14px !important;
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

    .modal-body label,
    .modal .form-group label {
        font-family: inherit !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        color: var(--mw-black) !important;
        margin-bottom: 8px !important;
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
        min-height: 44px !important;
        border: 1px solid rgba(79, 116, 56, 0.20) !important;
        border-radius: 12px !important;
        box-shadow: none !important;
        font-family: inherit !important;
        font-size: 15px !important;
        font-weight: 600 !important;
        color: var(--mw-black) !important;
        padding: 9px 12px !important;
        background: #ffffff !important;
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

    .modal textarea {
        min-height: 88px !important;
        resize: vertical;
    }

    .modal select.form-control {
        appearance: auto !important;
    }

    .modal .form-control:focus,
    .modal select:focus,
    .modal input:focus,
    .modal textarea:focus {
        border-color: var(--mw-green) !important;
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.15) !important;
        outline: none !important;
    }

    .modal .text-muted,
    .modal small {
        font-family: inherit !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: var(--mw-muted) !important;
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
        font-weight: 800 !important;
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
    .modal-footer button[data-dismiss="modal"],
    .modal-footer button[data-bs-dismiss="modal"] {
        background: #eeeeee !important;
        color: var(--mw-black) !important;
    }

    .modal-footer .btn-primary,
    .modal-footer .btn-success,
    .modal-footer button[type="submit"] {
        background: var(--mw-green) !important;
        color: #ffffff !important;
    }

    .modal .invalid-feedback,
    .modal .text-danger {
        font-family: inherit !important;
        font-size: 13px !important;
        font-weight: 700 !important;
    }

    /* Delete popup */
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
        font-family: "Poppins", sans-serif;
        text-align: center;
        animation: modalPop 0.25s ease both;
    }

    .delete-modal-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 17px;
        border-radius: 50%;
        background: var(--mw-danger-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulseDanger 1.65s ease-in-out infinite;
    }

    .delete-modal-icon svg {
        width: 39px;
        height: 39px;
        stroke: var(--mw-danger);
        stroke-width: 2.4;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .delete-modal-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--mw-black);
        margin-bottom: 8px;
    }

    .delete-modal-text {
        font-size: 15px;
        font-weight: 500;
        color: var(--mw-muted);
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .delete-modal-text strong {
        color: var(--mw-black);
        font-weight: 800;
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
        font-weight: 800;
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
        color: var(--mw-black);
    }

    .delete-confirm-btn {
        background: var(--mw-danger);
        color: #ffffff;
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation: none !important;
            transition: none !important;
        }
    }

    @media (max-width: 1050px) {
        .produk-page {
            padding: 34px 24px 68px;
        }

        .produk-header {
            flex-direction: column;
        }

        .produk-action-row {
            width: 100%;
            max-width: 420px;
        }

        .produk-summary {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 760px) {
        .produk-page {
            padding: 28px 16px 56px;
        }

        .produk-card {
            padding: 18px 14px;
            border-radius: 22px;
        }

        .produk-card-head,
        .produk-control-row,
        .produk-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .produk-search-form,
        .entries-control,
        .filter-control {
            width: 100%;
        }

        .filter-control select,
        .entries-control select {
            flex: 1;
            width: auto;
        }

        .pagination-custom {
            justify-content: space-between;
        }

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
        .modal-footer button,
        .delete-cancel-btn,
        .delete-confirm-btn {
            width: 100% !important;
        }

        .delete-modal-actions {
            flex-direction: column;
        }
    }
</style>

<div class="produk-page">
    <div class="produk-shell">
        @php
            $currentSearch = request('search', '');
            $currentStockFilter = request('stock_filter', 'semua');

            if ($produk instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                $currentPerPage = request('per_page', $produk->perPage());
                $produkCollection = collect($produk->items());
                $totalProduk = $produk->total();
            } else {
                $currentPerPage = request('per_page', 10);
                $produkCollection = collect($produk);
                $totalProduk = $produkCollection->count();
            }

            $stokRendah = $produkCollection->filter(fn ($item) => (int) ($item->stok ?? 0) > 0 && (int) ($item->stok ?? 0) <= 5)->count();
            $stokHabis = $produkCollection->filter(fn ($item) => (int) ($item->stok ?? 0) <= 0)->count();
        @endphp

        <div class="produk-header">
            <div class="produk-title-wrap">
                <span class="produk-eyebrow">Master Data</span>
                <h1 class="produk-title">Daftar Barang</h1>
                <p class="produk-subtitle">
                    Kelola data barang, stok, kategori, gambar, dan harga agar data persediaan gudang tetap rapi serta mudah dipantau.
                </p>
            </div>

            <div class="produk-action-row">
                <div class="produk-action-label-group">
                    <span class="produk-action-label">Tambah Barang</span>
                    <span class="produk-action-helper">Buat data barang baru</span>
                </div>

                <div class="add-product-control">
                    <x-produk.form-data-produk />
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show produk-alert" role="alert">
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
            <div class="alert alert-success alert-dismissible fade show produk-alert" role="alert">
                {{ session('success') }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="produk-summary">
            <div class="summary-card summary-total">
                <div>
                    <div class="summary-label">Total Barang</div>
                    <div class="summary-number">{{ $totalProduk }}</div>
                    <div class="summary-caption">Data barang tercatat</div>
                </div>
                <div class="summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 16V8A2 2 0 0 0 20 6.27L13 2.27A2 2 0 0 0 11 2.27L4 6.27A2 2 0 0 0 3 8V16A2 2 0 0 0 4 17.73L11 21.73A2 2 0 0 0 13 21.73L20 17.73A2 2 0 0 0 21 16Z"></path>
                        <path d="M3.27 6.96L12 12.01L20.73 6.96"></path>
                        <path d="M12 22.08V12"></path>
                    </svg>
                </div>
            </div>

            <div class="summary-card summary-low">
                <div>
                    <div class="summary-label">Stok Rendah</div>
                    <div class="summary-number">{{ $stokRendah }}</div>
                    <div class="summary-caption">Perlu dipantau kembali</div>
                </div>
                <div class="summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 9V13"></path>
                        <path d="M12 17H12.01"></path>
                        <path d="M10.29 3.86L1.82 18A2 2 0 0 0 3.53 21H20.47A2 2 0 0 0 22.18 18L13.71 3.86A2 2 0 0 0 10.29 3.86Z"></path>
                    </svg>
                </div>
            </div>

            <div class="summary-card summary-empty">
                <div>
                    <div class="summary-label">Stok Habis</div>
                    <div class="summary-number">{{ $stokHabis }}</div>
                    <div class="summary-caption">Barang perlu restock</div>
                </div>
                <div class="summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M6 9V3H18V9"></path>
                        <path d="M6 17H4C3.4 17 3 16.6 3 16V11C3 9.9 3.9 9 5 9H19C20.1 9 21 9.9 21 11V16C21 16.6 20.6 17 20 17H18"></path>
                        <path d="M6 14H18V21H6V14Z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="produk-card">
            <div class="produk-card-head">
                <div>
                    <h2 class="produk-section-title">Data Barang</h2>
                    <p class="produk-section-text">
                        Gunakan filter stok, pencarian, dan jumlah entri untuk mengelola data barang dengan lebih nyaman.
                    </p>
                </div>
            </div>

            <div class="produk-control-row">
                <form action="{{ route('master-data.produk.index') }}" method="GET" id="entriesForm">
                    <input type="hidden" name="search" value="{{ $currentSearch }}">
                    <input type="hidden" name="stock_filter" value="{{ $currentStockFilter }}">

                    <div class="entries-control">
                        <span>Show</span>
                        <select
                            name="per_page"
                            onchange="document.getElementById('entriesForm').submit()"
                            aria-label="Jumlah data per halaman"
                        >
                            <option value="5" {{ (int) $currentPerPage === 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ (int) $currentPerPage === 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ (int) $currentPerPage === 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ (int) $currentPerPage === 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <span>Entries</span>
                    </div>
                </form>

                <form action="{{ route('master-data.produk.index') }}" method="GET" id="filterStockForm">
                    <input type="hidden" name="search" value="{{ $currentSearch }}">
                    <input type="hidden" name="per_page" value="{{ $currentPerPage }}">

                    <div class="filter-control">
                        <span>Filter Stok</span>
                        <select
                            name="stock_filter"
                            id="stock_filter"
                            onchange="document.getElementById('filterStockForm').submit()"
                            aria-label="Filter stok barang"
                        >
                            <option value="semua" {{ $currentStockFilter === 'semua' ? 'selected' : '' }}>Semua</option>
                            <option value="habis" {{ $currentStockFilter === 'habis' ? 'selected' : '' }}>Stok Habis</option>
                            <option value="rendah" {{ $currentStockFilter === 'rendah' ? 'selected' : '' }}>Stok Rendah</option>
                            <option value="tersedia" {{ $currentStockFilter === 'tersedia' ? 'selected' : '' }}>Stok Tersedia</option>
                        </select>
                    </div>
                </form>

                <form action="{{ route('master-data.produk.index') }}" method="GET" class="produk-search-form">
                    <input type="hidden" name="stock_filter" value="{{ $currentStockFilter }}">
                    <input type="hidden" name="per_page" value="{{ $currentPerPage }}">

                    <div class="produk-search">
                        <button type="submit" aria-label="Cari produk">
                            <svg viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="7"></circle>
                                <path d="M16.5 16.5L21 21"></path>
                            </svg>
                        </button>

                        <input
                            type="text"
                            name="search"
                            placeholder="Cari barang..."
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
            </div>

            <div class="produk-table-wrap">
                <table class="produk-table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-gambar">GAMBAR</th>
                            <th class="col-nama">NAMA BARANG</th>
                            <th class="col-kategori">KATEGORI</th>
                            <th class="col-stok">STOK</th>
                            <th class="col-harga">HARGA</th>
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
                                $kategoriNama = data_get($item, 'kategori.nama_kategori') ?? data_get($item, 'kategoriProduk.nama_kategori') ?? '-';
                            @endphp

                            <tr class="produk-row">
                                <td>
                                    <span class="row-number">{{ $rowNumber }}</span>
                                </td>

                                <td>
                                    <div class="produk-image-card">
                                        @if($item->gambar)
                                            <img
                                                src="{{ asset('storage/' . $item->gambar) }}"
                                                alt="{{ $item->nama_produk }}"
                                                class="produk-image"
                                            >
                                        @else
                                            <div class="produk-placeholder" aria-label="Tidak ada gambar">
                                                <svg viewBox="0 0 24 24">
                                                    <rect x="3" y="3" width="18" height="18" rx="3"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <path d="M21 15L16 10L5 21"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <span class="item-name" title="{{ $item->nama_produk ?? '-' }}">
                                        {{ $item->nama_produk ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="kategori-badge" title="{{ $kategoriNama }}">
                                        {{ $kategoriNama }}
                                    </span>
                                </td>

                                <td>
                                    <div class="stock-cell">
                                        <span class="stock-number">{{ $stok }}</span>
                                        <span class="stock-mini" aria-hidden="true">
                                            <span class="stock-fill {{ $stockStatus }}" style="width: {{ $stockPercent }}%"></span>
                                        </span>
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
                                        <strong>Data barang tidak ditemukan.</strong>
                                        <span>Coba ubah kata kunci pencarian atau filter stok.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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

            document.querySelectorAll('.modal-header .close, .modal-header .btn-close').forEach(function (button) {
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
