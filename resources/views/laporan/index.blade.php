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

    .laporan-page {
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
        animation: laporanFadeIn 0.52s ease both;
    }

    .laporan-page::before,
    .laporan-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        background: rgba(143, 179, 107, 0.10);
        filter: blur(1px);
        pointer-events: none;
        animation: laporanFloat 6s ease-in-out infinite;
    }

    .laporan-page::before {
        width: 145px;
        height: 145px;
        right: 52px;
        top: 108px;
    }

    .laporan-page::after {
        width: 92px;
        height: 92px;
        left: 38px;
        bottom: 74px;
        animation-delay: 1.2s;
    }

    @keyframes laporanFadeIn {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes laporanFloat {
        0%, 100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-12px);
        }
    }

    @keyframes laporanSlideUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes laporanShine {
        0%, 58% {
            transform: translateX(-120%) rotate(14deg);
        }

        100% {
            transform: translateX(120%) rotate(14deg);
        }
    }

    @keyframes laporanPulse {
        0% {
            opacity: 0.55;
            transform: scale(0.94);
        }

        70%, 100% {
            opacity: 0;
            transform: scale(1.18);
        }
    }

    @keyframes laporanDotPulse {
        0%, 100% {
            opacity: 0.72;
            transform: scale(1);
        }

        50% {
            opacity: 1;
            transform: scale(1.25);
        }
    }

    @keyframes laporanRowIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .laporan-shell {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
    }

    .laporan-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 28px;
        margin-bottom: 24px;
        animation: laporanSlideUp 0.58s ease both;
    }

    .laporan-title-wrap {
        max-width: 660px;
    }

    .laporan-eyebrow {
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

    .laporan-eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--mw-green);
        box-shadow: 0 0 0 5px rgba(143, 179, 107, 0.16);
        animation: laporanDotPulse 2s ease-in-out infinite;
    }

    .laporan-title {
        margin: 0;
        color: var(--mw-black);
        font-size: clamp(26px, 3vw, 38px);
        font-weight: 800;
        line-height: 1.14;
        letter-spacing: -0.8px;
    }

    .laporan-subtitle {
        max-width: 610px;
        margin: 12px 0 0;
        color: var(--mw-muted);
        font-size: 15px;
        font-weight: 500;
        line-height: 1.72;
    }

    .print-row {
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

    .print-label-group {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .print-label {
        font-size: 14px;
        font-weight: 800;
        color: var(--mw-black);
        line-height: 1.1;
    }

    .print-helper {
        font-size: 12px;
        font-weight: 600;
        color: var(--mw-muted);
        line-height: 1.25;
    }

    .print-button {
        width: 48px;
        height: 48px;
        border: none;
        border-radius: 17px;
        background: linear-gradient(135deg, var(--mw-blue), var(--mw-blue-dark));
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        cursor: pointer;
        transition: transform 0.24s ease, box-shadow 0.24s ease, filter 0.24s ease;
        position: relative;
        isolation: isolate;
        flex-shrink: 0;
        box-shadow: 0 13px 24px rgba(76, 148, 255, 0.28);
    }

    .print-button::after {
        content: "";
        position: absolute;
        inset: -6px;
        border-radius: 22px;
        border: 2px solid rgba(76, 148, 255, 0.25);
        animation: laporanPulse 2.4s ease-in-out infinite;
        z-index: -1;
    }

    .print-button:hover {
        color: #ffffff;
        text-decoration: none;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 18px 34px rgba(76, 148, 255, 0.34);
        filter: saturate(1.06);
    }

    .print-button.is-disabled {
        background: #dce2e8;
        color: #75808c;
        cursor: not-allowed;
        opacity: 0.9;
        pointer-events: none;
        box-shadow: none;
    }

    .print-button.is-disabled::after {
        display: none;
    }

    .print-button svg {
        width: 25px;
        height: 25px;
        stroke: currentColor;
        stroke-width: 2.2;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        position: relative;
        z-index: 1;
    }

    .laporan-alert {
        margin: 0 0 22px;
        padding: 14px 16px;
        border-radius: 18px;
        background: var(--mw-warning-soft);
        border: 1px solid rgba(244, 178, 62, 0.36);
        color: #7a540d;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 10px 24px rgba(93, 66, 10, 0.08);
        animation: laporanSlideUp 0.5s ease both;
    }

    .laporan-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
        animation: laporanSlideUp 0.58s ease both;
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
        animation: laporanShine 5s ease-in-out infinite;
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

    .summary-in .summary-icon {
        background: #e7f7df;
        color: #2f7d32;
    }

    .summary-out .summary-icon {
        background: var(--mw-danger-soft);
        color: var(--mw-danger);
    }

    .laporan-card {
        width: 100%;
        border: 1px solid var(--mw-border);
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.92);
        padding: 22px;
        box-shadow: var(--mw-shadow);
        backdrop-filter: blur(10px);
        animation: laporanSlideUp 0.6s ease both;
        animation-delay: 0.15s;
        position: relative;
        overflow: hidden;
    }

    .laporan-card::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 5px;
        background: linear-gradient(90deg, var(--mw-green), rgba(143, 179, 107, 0.25), var(--mw-green-dark));
    }

    .laporan-card-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
        padding-top: 6px;
    }

    .laporan-section-title {
        margin: 0;
        font-size: 20px;
        font-weight: 800;
        color: var(--mw-black);
        letter-spacing: -0.2px;
    }

    .laporan-section-text {
        margin: 7px 0 0;
        color: var(--mw-muted);
        font-size: 13px;
        font-weight: 600;
        line-height: 1.55;
    }

    .laporan-control-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 18px;
    }

    .entries-control {
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

    .entries-control select {
        width: 76px;
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

    .entries-control select:focus {
        border-color: var(--mw-green);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.15);
        transform: translateY(-1px);
    }

    .laporan-search {
        width: min(100%, 340px);
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

    .laporan-search:focus-within {
        border-color: var(--mw-green);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.15), 0 14px 28px rgba(90, 123, 64, 0.11);
        transform: translateY(-2px);
    }

    .laporan-search svg {
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

    .laporan-search input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: var(--mw-black);
    }

    .laporan-search input::placeholder {
        color: #92a187;
    }

    .laporan-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid rgba(79, 116, 56, 0.14);
        border-radius: 22px;
        background: #ffffff;
        box-shadow: 0 12px 28px rgba(90, 123, 64, 0.08);
    }

    .laporan-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: fixed;
        font-family: "Poppins", sans-serif;
        color: var(--mw-black);
        overflow: hidden;
    }

    .laporan-table th {
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

    .laporan-table th:not(:last-child),
    .laporan-table td:not(:last-child) {
        border-right: 1px solid rgba(79, 116, 56, 0.10);
    }

    .laporan-table td {
        height: 64px;
        border-bottom: 1px solid rgba(79, 116, 56, 0.10);
        text-align: center;
        vertical-align: middle;
        font-size: 14px;
        font-weight: 600;
        color: var(--mw-black);
        background: rgba(255, 255, 255, 0.94);
        transition: background 0.22s ease, transform 0.22s ease;
    }

    .laporan-table tbody tr:last-child td {
        border-bottom: none;
    }

    .laporan-row {
        animation: laporanRowIn 0.38s ease both;
    }

    .laporan-row:nth-child(1) { animation-delay: 0.03s; }
    .laporan-row:nth-child(2) { animation-delay: 0.06s; }
    .laporan-row:nth-child(3) { animation-delay: 0.09s; }
    .laporan-row:nth-child(4) { animation-delay: 0.12s; }
    .laporan-row:nth-child(5) { animation-delay: 0.15s; }

    .laporan-table tbody .laporan-row:hover td {
        background: #fbfef8;
    }

    .laporan-table tbody .laporan-row:hover td:first-child {
        color: var(--mw-green-dark);
    }

    .col-no {
        width: 8%;
    }

    .col-tanggal {
        width: 20%;
    }

    .col-tipe {
        width: 24%;
    }

    .col-barang {
        width: 30%;
    }

    .col-jumlah {
        width: 18%;
    }

    .date-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 108px;
        height: 34px;
        padding: 0 12px;
        border-radius: 999px;
        background: #f6faf2;
        border: 1px solid rgba(79, 116, 56, 0.14);
        color: #53634a;
        font-size: 13px;
        font-weight: 800;
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

    .transaction-badge {
        min-width: 128px;
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
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .transaction-badge::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        animation: laporanDotPulse 1.8s ease-in-out infinite;
        flex-shrink: 0;
    }

    .transaction-in {
        background: #e7f7df;
        color: #2f7d32;
        border: 1px solid rgba(47, 125, 50, 0.22);
        box-shadow: 0 8px 18px rgba(47, 125, 50, 0.08);
    }

    .transaction-in::before {
        background: #2f7d32;
        box-shadow: 0 0 0 4px rgba(47, 125, 50, 0.12);
    }

    .transaction-out {
        background: var(--mw-danger-soft);
        color: #c52d25;
        border: 1px solid rgba(217, 52, 43, 0.20);
        box-shadow: 0 8px 18px rgba(217, 52, 43, 0.08);
    }

    .transaction-out::before {
        background: var(--mw-danger);
        box-shadow: 0 0 0 4px rgba(217, 52, 43, 0.12);
    }

    .transaction-neutral {
        background: #f1f3f0;
        color: #555f50;
        border: 1px solid #d8ded3;
    }

    .transaction-neutral::before {
        background: #75806d;
    }

    .jumlah-badge {
        min-width: 70px;
        height: 36px;
        border-radius: 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 900;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .jumlah-in {
        background: #e7f7df;
        color: #2f7d32;
        border: 1px solid rgba(47, 125, 50, 0.22);
    }

    .jumlah-out {
        background: var(--mw-danger-soft);
        color: #c52d25;
        border: 1px solid rgba(217, 52, 43, 0.20);
    }

    .jumlah-neutral {
        background: #f1f3f0;
        color: #555f50;
        border: 1px solid #d8ded3;
    }

    .laporan-row:hover .transaction-badge,
    .laporan-row:hover .jumlah-badge {
        transform: translateY(-2px);
    }

    .laporan-row:hover .jumlah-in {
        box-shadow: 0 10px 18px rgba(47, 125, 50, 0.14);
    }

    .laporan-row:hover .jumlah-out {
        box-shadow: 0 10px 18px rgba(217, 52, 43, 0.13);
    }

    .laporan-empty {
        height: 96px !important;
        padding: 28px !important;
        color: var(--mw-muted) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        line-height: 1.7;
        background: #fbfef8 !important;
    }

    .laporan-footer {
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

    .pagination-custom button,
    .pagination-custom span {
        font-family: "Poppins", sans-serif;
        font-size: 13px;
        font-weight: 800;
    }

    .pagination-custom button {
        min-height: 38px;
        border: 1px solid rgba(79, 116, 56, 0.16);
        border-radius: 999px;
        background: #ffffff;
        color: var(--mw-green-deep);
        cursor: pointer;
        padding: 0 14px;
        transition: transform 0.22s ease, box-shadow 0.22s ease, background 0.22s ease, opacity 0.22s ease;
    }

    .pagination-custom button:hover:not(:disabled) {
        background: var(--mw-green-soft);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(90, 123, 64, 0.12);
    }

    .pagination-custom button:disabled {
        opacity: 0.46;
        cursor: not-allowed;
    }

    .pagination-custom .page-number {
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

    .no-result-row {
        display: none;
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
        .laporan-page {
            padding: 34px 24px 68px;
        }

        .laporan-header {
            flex-direction: column;
        }

        .print-row {
            width: 100%;
            max-width: 420px;
        }

        .laporan-summary {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 760px) {
        .laporan-page {
            padding: 28px 16px 56px;
        }

        .laporan-card {
            padding: 18px 14px;
            border-radius: 22px;
        }

        .laporan-card-head,
        .laporan-control-row,
        .laporan-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .laporan-search,
        .entries-control {
            width: 100%;
        }

        .laporan-table {
            min-width: 860px;
        }

        .pagination-custom {
            justify-content: space-between;
        }
    }
</style>

@php
    $laporanCollection = $laporan instanceof \Illuminate\Pagination\AbstractPaginator
        ? collect($laporan->items())
        : collect($laporan);

    $totalTransaksi = $laporanCollection->count();
    $totalMasuk = $laporanCollection->filter(fn ($row) => strtolower($row->jenis ?? '') === 'masuk')->count();
    $totalKeluar = $laporanCollection->filter(fn ($row) => strtolower($row->jenis ?? '') === 'keluar')->count();
@endphp

<div class="laporan-page">
    <div class="laporan-shell">
        <div class="laporan-header">
            <div class="laporan-title-wrap">
                <span class="laporan-eyebrow">Laporan Bulanan</span>
                <h1 class="laporan-title">Laporan Transaksi Barang</h1>
                <p class="laporan-subtitle">
                    Rekap transaksi barang masuk dan barang keluar dalam periode satu bulan terakhir untuk membantu pemantauan aktivitas gudang.
                </p>
            </div>

            <div class="print-row">
                <div class="print-label-group">
                    <span class="print-label">Cetak Laporan</span>
                    <span class="print-helper">
                        {{ $totalTransaksi > 0 ? 'Unduh data dalam PDF' : 'Belum ada data laporan' }}
                    </span>
                </div>

                @if($totalTransaksi > 0)
                    <a href="{{ route('laporan.pdf') }}" class="print-button" title="Cetak laporan PDF">
                        <svg viewBox="0 0 24 24">
                            <path d="M6 9V3H18V9"></path>
                            <path d="M6 17H4C3.4 17 3 16.6 3 16V11C3 9.9 3.9 9 5 9H19C20.1 9 21 9.9 21 11V16C21 16.6 20.6 17 20 17H18"></path>
                            <path d="M6 14H18V21H6V14Z"></path>
                            <path d="M8 17H16"></path>
                        </svg>
                    </a>
                @else
                    <span class="print-button is-disabled" title="Tidak ada data laporan untuk dicetak" aria-disabled="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M6 9V3H18V9"></path>
                            <path d="M6 17H4C3.4 17 3 16.6 3 16V11C3 9.9 3.9 9 5 9H19C20.1 9 21 9.9 21 11V16C21 16.6 20.6 17 20 17H18"></path>
                            <path d="M6 14H18V21H6V14Z"></path>
                            <path d="M8 17H16"></path>
                        </svg>
                    </span>
                @endif
            </div>
        </div>

        @if(session('error'))
            <div class="laporan-alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="laporan-summary">
            <div class="summary-card summary-total">
                <div>
                    <div class="summary-label">Total Transaksi</div>
                    <div class="summary-number">{{ $totalTransaksi }}</div>
                    <div class="summary-caption">Data tercatat bulan ini</div>
                </div>
                <div class="summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M8 6H21"></path>
                        <path d="M8 12H21"></path>
                        <path d="M8 18H21"></path>
                        <path d="M3 6H3.01"></path>
                        <path d="M3 12H3.01"></path>
                        <path d="M3 18H3.01"></path>
                    </svg>
                </div>
            </div>

            <div class="summary-card summary-in">
                <div>
                    <div class="summary-label">Barang Masuk</div>
                    <div class="summary-number">{{ $totalMasuk }}</div>
                    <div class="summary-caption">Transaksi penambahan stok</div>
                </div>
                <div class="summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 5V19"></path>
                        <path d="M5 12H19"></path>
                    </svg>
                </div>
            </div>

            <div class="summary-card summary-out">
                <div>
                    <div class="summary-label">Barang Keluar</div>
                    <div class="summary-number">{{ $totalKeluar }}</div>
                    <div class="summary-caption">Transaksi pengurangan stok</div>
                </div>
                <div class="summary-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M5 12H19"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="laporan-card">
            <div class="laporan-card-head">
                <div>
                    <h2 class="laporan-section-title">Daftar Transaksi</h2>
                    <p class="laporan-section-text">
                        Gunakan pencarian dan jumlah entri untuk melihat data laporan dengan lebih nyaman.
                    </p>
                </div>
            </div>

            <div class="laporan-control-row">
                <div class="entries-control">
                    <span>Show</span>

                    <select id="laporanEntries">
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>

                    <span>Entries</span>
                </div>

                <div class="laporan-search">
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="M16.5 16.5L21 21"></path>
                    </svg>

                    <input type="text" id="laporanSearch" placeholder="Cari laporan...">
                </div>
            </div>

            <div class="laporan-table-wrap">
                <table class="laporan-table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-tanggal">TANGGAL</th>
                            <th class="col-tipe">TIPE TRANSAKSI</th>
                            <th class="col-barang">NAMA BARANG</th>
                            <th class="col-jumlah">JUMLAH</th>
                        </tr>
                    </thead>

                    <tbody id="laporanTableBody">
                        @forelse($laporan as $row)
                            @php
                                $jenis = strtolower($row->jenis ?? '-');
                                $jumlah = (int) ($row->jumlah ?? 0);

                                if ($jenis === 'masuk') {
                                    $jenisLabel = 'Barang Masuk';
                                    $jenisClass = 'transaction-in';
                                    $jumlahClass = 'jumlah-in';
                                    $jumlahText = '+' . $jumlah;
                                } elseif ($jenis === 'keluar') {
                                    $jenisLabel = 'Barang Keluar';
                                    $jenisClass = 'transaction-out';
                                    $jumlahClass = 'jumlah-out';
                                    $jumlahText = '-' . $jumlah;
                                } else {
                                    $jenisLabel = ucfirst($row->jenis ?? '-');
                                    $jenisClass = 'transaction-neutral';
                                    $jumlahClass = 'jumlah-neutral';
                                    $jumlahText = (string) $jumlah;
                                }
                            @endphp

                            <tr class="laporan-row">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="date-pill">
                                        {{ optional($row->created_at)->format('d/m/Y') ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="transaction-badge {{ $jenisClass }}">
                                        {{ $jenisLabel }}
                                    </span>
                                </td>
                                <td>
                                    <span class="item-name" title="{{ $row->produk->nama_produk ?? '-' }}">
                                        {{ $row->produk->nama_produk ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="jumlah-badge {{ $jumlahClass }}">
                                        {{ $jumlahText }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="5" class="laporan-empty">
                                    Data laporan transaksi belum tersedia.
                                </td>
                            </tr>
                        @endforelse

                        <tr class="no-result-row" id="noResultRow">
                            <td colspan="5" class="laporan-empty">
                                Data yang dicari tidak ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="laporan-footer">
                <div id="laporanInfo">
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('laporanSearch');
        const entriesSelect = document.getElementById('laporanEntries');
        const rows = Array.from(document.querySelectorAll('.laporan-row'));
        const info = document.getElementById('laporanInfo');
        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');
        const currentPageText = document.getElementById('currentPageText');
        const noResultRow = document.getElementById('noResultRow');

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

            filteredRows.slice(startIndex, endIndex).forEach(function (row) {
                row.style.display = '';
            });

            if (noResultRow) {
                noResultRow.style.display = totalRows === 0 && rows.length > 0 ? '' : 'none';
            }

            const showingStart = totalRows === 0 ? 0 : startIndex + 1;
            const showingEnd = Math.min(endIndex, totalRows);

            info.textContent = `Showing ${showingStart} to ${showingEnd} out of ${totalRows} entries`;
            currentPageText.textContent = currentPage;

            prevButton.disabled = currentPage <= 1;
            nextButton.disabled = currentPage >= totalPages;
        }

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
    });
</script>
@endsection
