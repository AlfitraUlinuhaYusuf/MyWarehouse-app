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

    .masuk-page,
    .masuk-page * {
        box-sizing: border-box;
    }

    .masuk-page {
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
        animation: masukFadeIn 0.52s ease both;
    }

    .masuk-page::before,
    .masuk-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        background: rgba(143, 179, 107, 0.10);
        filter: blur(1px);
        pointer-events: none;
        animation: masukFloat 6s ease-in-out infinite;
    }

    .masuk-page::before {
        width: 145px;
        height: 145px;
        right: 52px;
        top: 108px;
    }

    .masuk-page::after {
        width: 92px;
        height: 92px;
        left: 38px;
        bottom: 74px;
        animation-delay: 1.2s;
    }

    @keyframes masukFadeIn {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes masukFloat {
        0%, 100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-12px);
        }
    }

    @keyframes masukSlideUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes masukShine {
        0%, 58% {
            transform: translateX(-120%) rotate(14deg);
        }

        100% {
            transform: translateX(120%) rotate(14deg);
        }
    }

    @keyframes masukPulse {
        0% {
            opacity: 0.55;
            transform: scale(0.94);
        }

        70%, 100% {
            opacity: 0;
            transform: scale(1.18);
        }
    }

    @keyframes masukDotPulse {
        0%, 100% {
            opacity: 0.72;
            transform: scale(1);
        }

        50% {
            opacity: 1;
            transform: scale(1.25);
        }
    }

    @keyframes masukRowIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .masuk-shell {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
    }

    .masuk-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 28px;
        margin-bottom: 24px;
        animation: masukSlideUp 0.58s ease both;
    }

    .title-area {
        max-width: 670px;
        min-width: 0;
    }

    .masuk-eyebrow {
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

    .masuk-eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--mw-green);
        box-shadow: 0 0 0 5px rgba(143, 179, 107, 0.16);
        animation: masukDotPulse 2s ease-in-out infinite;
    }

    .masuk-title {
        margin: 0;
        color: var(--mw-black);
        font-size: clamp(26px, 3vw, 38px);
        font-weight: 800;
        line-height: 1.14;
        letter-spacing: -0.8px;
    }

    .masuk-subtitle {
        max-width: 650px;
        margin: 12px 0 0;
        color: var(--mw-muted);
        font-size: 15px;
        font-weight: 500;
        line-height: 1.72;
    }

    .header-mini-card {
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

    .mini-content {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .mini-content span {
        font-size: 12px;
        font-weight: 700;
        color: var(--mw-muted);
        line-height: 1.25;
    }

    .mini-content strong {
        font-size: 25px;
        font-weight: 900;
        color: var(--mw-black);
        line-height: 1;
        letter-spacing: -0.5px;
    }

    .mini-helper {
        font-size: 12px;
        font-weight: 700;
        color: var(--mw-green-deep) !important;
        margin-top: 2px;
    }

    .mini-icon {
        width: 48px;
        height: 48px;
        border-radius: 17px;
        background: var(--mw-green-soft);
        color: var(--mw-green-deep);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        isolation: isolate;
        flex-shrink: 0;
    }

    .mini-icon::after {
        content: "";
        position: absolute;
        inset: -6px;
        border-radius: 22px;
        border: 2px solid rgba(143, 179, 107, 0.20);
        animation: masukPulse 2.4s ease-in-out infinite;
        z-index: -1;
    }

    .mini-icon svg {
        width: 25px;
        height: 25px;
        stroke: currentColor;
        stroke-width: 2.2;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .masuk-alert {
        margin: 0 0 22px;
        padding: 14px 16px;
        border-radius: 18px;
        border: none;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.7;
        box-shadow: 0 10px 24px rgba(93, 66, 10, 0.08);
        animation: masukSlideUp 0.5s ease both;
    }

    .masuk-alert.alert-danger {
        background: var(--mw-danger-soft);
        color: #a82019;
        border: 1px solid rgba(217, 52, 43, 0.20);
    }

    .masuk-alert.alert-success {
        background: #eff9e9;
        color: var(--mw-green-deep);
        border: 1px solid rgba(79, 116, 56, 0.18);
    }

    .masuk-alert .close {
        outline: none;
    }

    .masuk-panel {
        width: 100%;
        border: 1px solid var(--mw-border);
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.92);
        padding: 22px;
        box-shadow: var(--mw-shadow);
        backdrop-filter: blur(10px);
        animation: masukSlideUp 0.6s ease both;
        animation-delay: 0.12s;
        position: relative;
        overflow: hidden;
    }

    .masuk-panel::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 5px;
        background: linear-gradient(90deg, var(--mw-green), rgba(143, 179, 107, 0.25), var(--mw-green-dark));
    }

    .masuk-card-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
        padding-top: 6px;
    }

    .masuk-section-title {
        margin: 0;
        font-size: 20px;
        font-weight: 800;
        color: var(--mw-black);
        letter-spacing: -0.2px;
    }

    .masuk-section-text {
        margin: 7px 0 0;
        color: var(--mw-muted);
        font-size: 13px;
        font-weight: 600;
        line-height: 1.55;
    }

    .add-area {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        white-space: nowrap;
    }

    .add-label {
        color: var(--mw-muted);
        font-size: 13px;
        font-weight: 800;
    }

    .add-btn {
        min-width: 156px;
        height: 48px;
        border: none;
        border-radius: 17px;
        background: linear-gradient(135deg, var(--mw-green), var(--mw-green-dark));
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        cursor: pointer;
        position: relative;
        isolation: isolate;
        overflow: hidden;
        box-shadow: 0 13px 24px rgba(143, 179, 107, 0.28);
        transition: transform 0.24s ease, box-shadow 0.24s ease, filter 0.24s ease;
        font-family: "Poppins", sans-serif;
        font-size: 13px;
        font-weight: 900;
    }

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
        z-index: -1;
    }

    .add-btn::after {
        content: "";
        position: absolute;
        inset: -6px;
        border-radius: 22px;
        border: 2px solid rgba(143, 179, 107, 0.26);
        animation: masukPulse 2.4s ease-in-out infinite;
        z-index: -2;
    }

    .add-btn:hover {
        color: #ffffff;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 18px 34px rgba(143, 179, 107, 0.34);
        filter: saturate(1.06);
    }

    .add-btn:hover::before {
        left: 120%;
    }

    .add-btn svg {
        width: 19px;
        height: 19px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.7;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .filter-card {
        margin-bottom: 18px;
        padding: 16px;
        border: 1px solid rgba(79, 116, 56, 0.16);
        border-radius: 22px;
        background: var(--mw-green-pale);
    }

    .date-label {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin: 0 0 12px;
        color: var(--mw-green-deep);
        font-size: 13px;
        font-weight: 900;
        letter-spacing: 0.15px;
    }

    .date-label svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        stroke-width: 2.4;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .filter-form {
        display: grid;
        grid-template-columns: minmax(190px, 1fr) minmax(190px, 1fr) 132px 132px;
        align-items: center;
        gap: 12px;
        width: 100%;
    }

    .date-input-wrap {
        position: relative;
        width: 100%;
    }

    .date-input {
        width: 100%;
        height: 48px;
        border: 1px solid rgba(79, 116, 56, 0.18);
        border-radius: 16px;
        background: #ffffff;
        color: var(--mw-black);
        font-family: "Poppins", sans-serif;
        font-size: 13px;
        font-weight: 800;
        padding: 0 48px 0 15px;
        outline: none;
        transition: border-color 0.22s ease, box-shadow 0.22s ease, transform 0.22s ease;
    }

    .date-input:hover,
    .date-input:focus {
        border-color: var(--mw-green);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.14), 0 12px 22px rgba(90, 123, 64, 0.08);
        transform: translateY(-1px);
    }

    .date-input::-webkit-calendar-picker-indicator {
        opacity: 0;
        cursor: pointer;
        position: absolute;
        right: 0;
        width: 48px;
        height: 48px;
    }

    .calendar-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        pointer-events: none;
        color: var(--mw-green-dark);
    }

    .calendar-icon svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        stroke-width: 2.2;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .filter-btn,
    .refresh-btn {
        height: 48px;
        border: none;
        border-radius: 16px;
        font-family: "Poppins", sans-serif;
        font-size: 13px;
        font-weight: 900;
        color: #ffffff;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
        transition: transform 0.22s ease, box-shadow 0.22s ease, background 0.22s ease;
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
    }

    .filter-btn {
        background: linear-gradient(135deg, var(--mw-blue), var(--mw-blue-dark));
        box-shadow: 0 10px 20px rgba(76, 148, 255, 0.22);
    }

    .refresh-btn {
        background: linear-gradient(135deg, var(--mw-green), var(--mw-green-dark));
        box-shadow: 0 10px 20px rgba(143, 179, 107, 0.20);
    }

    .filter-btn:hover,
    .refresh-btn:hover {
        color: #ffffff;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .filter-btn:hover {
        box-shadow: 0 14px 26px rgba(76, 148, 255, 0.28);
    }

    .refresh-btn:hover {
        box-shadow: 0 14px 26px rgba(143, 179, 107, 0.27);
    }

    .table-toolbar {
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

    .search-box {
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

    .search-box:focus-within {
        border-color: var(--mw-green);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.15), 0 14px 28px rgba(90, 123, 64, 0.11);
        transform: translateY(-2px);
    }

    .search-box svg {
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

    .search-box input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: var(--mw-black);
    }

    .search-box input::placeholder {
        color: #92a187;
    }

    .masuk-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid rgba(79, 116, 56, 0.14);
        border-radius: 22px;
        background: #ffffff;
        box-shadow: 0 12px 28px rgba(90, 123, 64, 0.08);
    }

    .masuk-table-wrap::-webkit-scrollbar {
        height: 9px;
    }

    .masuk-table-wrap::-webkit-scrollbar-track {
        background: #f4f8f0;
        border-radius: 999px;
    }

    .masuk-table-wrap::-webkit-scrollbar-thumb {
        background: rgba(143, 179, 107, 0.72);
        border-radius: 999px;
    }

    .masuk-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: fixed;
        font-family: "Poppins", sans-serif;
        color: var(--mw-black);
        overflow: hidden;
    }

    .masuk-table th {
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

    .masuk-table th:not(:last-child),
    .masuk-table td:not(:last-child) {
        border-right: 1px solid rgba(79, 116, 56, 0.10);
    }

    .masuk-table td {
        height: 64px;
        border-bottom: 1px solid rgba(79, 116, 56, 0.10);
        text-align: center;
        vertical-align: middle;
        font-size: 14px;
        font-weight: 600;
        color: var(--mw-black);
        background: rgba(255, 255, 255, 0.94);
        padding: 8px 12px;
        transition: background 0.22s ease, transform 0.22s ease;
    }

    .masuk-table tbody tr:last-child td {
        border-bottom: none;
    }

    .masuk-row {
        animation: masukRowIn 0.38s ease both;
    }

    .masuk-row:nth-child(1) { animation-delay: 0.03s; }
    .masuk-row:nth-child(2) { animation-delay: 0.06s; }
    .masuk-row:nth-child(3) { animation-delay: 0.09s; }
    .masuk-row:nth-child(4) { animation-delay: 0.12s; }
    .masuk-row:nth-child(5) { animation-delay: 0.15s; }

    .masuk-table tbody .masuk-row:hover td {
        background: #fbfef8;
    }

    .masuk-table tbody .masuk-row:hover td:first-child {
        color: var(--mw-green-dark);
    }

    .col-no { width: 8%; }
    .col-kategori { width: 18%; }
    .col-tanggal { width: 18%; }
    .col-barang { width: 24%; }
    .col-jumlah { width: 14%; }
    .col-keterangan { width: 18%; }

    .number-pill,
    .date-badge,
    .category-badge,
    .jumlah-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .number-pill {
        min-width: 34px;
        height: 34px;
        border-radius: 13px;
        background: #f6faf2;
        border: 1px solid rgba(79, 116, 56, 0.14);
        color: #53634a;
        font-size: 13px;
        font-weight: 900;
    }

    .category-badge {
        min-width: 116px;
        min-height: 34px;
        padding: 7px 13px;
        border-radius: 999px;
        background: #e7f7df;
        color: #2f7d32;
        border: 1px solid rgba(47, 125, 50, 0.22);
        box-shadow: 0 8px 18px rgba(47, 125, 50, 0.08);
        gap: 8px;
        font-size: 13px;
        font-weight: 900;
        letter-spacing: 0.1px;
    }

    .category-badge::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
        background: #2f7d32;
        box-shadow: 0 0 0 4px rgba(47, 125, 50, 0.12);
        animation: masukDotPulse 1.8s ease-in-out infinite;
    }

    .date-badge {
        min-width: 108px;
        height: 34px;
        padding: 0 12px;
        border-radius: 999px;
        background: #f6faf2;
        border: 1px solid rgba(79, 116, 56, 0.14);
        color: #53634a;
        gap: 7px;
        font-size: 13px;
        font-weight: 900;
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

    .product-name {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        max-width: 100%;
        font-weight: 900;
    }

    .product-dot {
        width: 8px;
        height: 8px;
        min-width: 8px;
        border-radius: 50%;
        background: var(--mw-green);
        box-shadow: 0 0 0 5px rgba(143, 179, 107, 0.15);
        animation: masukDotPulse 2s ease-in-out infinite;
    }

    .product-text,
    .keterangan-text {
        display: inline-block;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
    }

    .jumlah-badge {
        min-width: 70px;
        height: 36px;
        border-radius: 13px;
        background: #e7f7df;
        color: #2f7d32;
        border: 1px solid rgba(47, 125, 50, 0.22);
        font-size: 14px;
        font-weight: 900;
    }

    .keterangan-text {
        color: #53634a;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.45;
    }

    .masuk-row:hover .category-badge,
    .masuk-row:hover .jumlah-badge,
    .masuk-row:hover .date-badge {
        transform: translateY(-2px);
    }

    .masuk-row:hover .jumlah-badge,
    .masuk-row:hover .category-badge {
        box-shadow: 0 10px 18px rgba(47, 125, 50, 0.14);
    }

    .empty-row {
        height: 96px !important;
        padding: 28px !important;
        color: var(--mw-muted) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        line-height: 1.7;
        background: #fbfef8 !important;
    }

    .empty-state {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 13px 18px;
        border-radius: 999px;
        background: #f6faf2;
        border: 1px dashed rgba(79, 116, 56, 0.26);
        color: var(--mw-muted);
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
        margin-top: 18px;
        font-size: 13px;
        font-weight: 700;
        color: var(--mw-muted);
    }

    .table-footer strong {
        color: var(--mw-green-deep);
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

    /* =========================
       MODAL TAMBAH BARANG MASUK
    ========================= */
    .modal-backdrop.show {
        opacity: 0.34 !important;
        backdrop-filter: blur(4px);
    }

    body.modal-open .masuk-page {
        overflow: visible;
    }

    #modalMasuk .modal-dialog {
        max-width: 720px;
    }

    #modalMasuk .modal-content {
        border: none;
        border-radius: 24px;
        box-shadow: 0 24px 70px rgba(0, 0, 0, 0.24);
        overflow: hidden;
        font-family: "Poppins", sans-serif;
    }

    #modalMasuk .modal.fade .modal-dialog {
        transform: translateY(18px) scale(0.98);
    }

    #modalMasuk.show .modal-dialog {
        transform: translateY(0) scale(1);
    }

    #modalMasuk .modal-header {
        min-height: 78px;
        background: linear-gradient(135deg, #8fb36b 0%, #7da45a 100%);
        border-bottom: none;
        padding: 22px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    #modalMasuk .modal-title {
        color: #111111;
        font-size: 24px;
        font-weight: 800;
        margin: 0;
    }

    #modalMasuk .modal-header .close {
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

    #modalMasuk .modal-header .close:hover {
        background: #ffd1d1;
        transform: rotate(90deg) scale(1.04);
    }

    #modalMasuk .modal-header .close::before {
        content: "×";
        font-family: "Poppins", sans-serif;
        font-size: 31px;
        font-weight: 800;
        color: #d93636;
        line-height: 1;
        margin-top: -3px;
    }

    #modalMasuk .modal-header .close span {
        display: none;
    }

    #modalMasuk .modal-body {
        padding: 28px 30px 12px;
        background: #ffffff;
    }

    #modalMasuk .modal-body label {
        font-size: 15px;
        font-weight: 700;
        color: #111111;
        margin-bottom: 8px;
    }

    #modalMasuk .form-control {
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

    #modalMasuk textarea.form-control {
        min-height: 96px;
        resize: vertical;
    }

    #modalMasuk .form-control:focus {
        border-color: var(--mw-green);
        box-shadow: 0 0 0 4px rgba(143, 179, 107, 0.18);
        transform: translateY(-1px);
    }

    #modalMasuk .modal-footer {
        border-top: none;
        background: #ffffff;
        padding: 16px 30px 30px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    #modalMasuk .modal-footer .btn {
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

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation: none !important;
            transition: none !important;
        }
    }

    @media (max-width: 1050px) {
        .masuk-page {
            padding: 34px 24px 68px;
        }

        .masuk-header,
        .masuk-card-head {
            flex-direction: column;
        }

        .header-mini-card {
            width: 100%;
            max-width: 420px;
        }

        .filter-form {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 760px) {
        .masuk-page {
            padding: 28px 16px 56px;
        }

        .masuk-panel {
            padding: 18px 14px;
            border-radius: 22px;
        }

        .table-toolbar,
        .table-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box,
        .entries-control,
        .add-area,
        .add-btn {
            width: 100%;
        }

        .add-area {
            justify-content: stretch;
        }

        .filter-form {
            grid-template-columns: 1fr;
        }

        .masuk-table {
            min-width: 980px;
        }

        .pagination-custom {
            justify-content: space-between;
        }
    }
    /* Menghilangkan dot khusus pada isi kolom kode transaksi */
.kode-transaksi-badge::before {
    content: none !important;
    display: none !important;
}

.kode-transaksi-badge {
    gap: 0 !important;
}
</style>

@php
    $totalDataMasuk = method_exists($riwayat, 'total') ? $riwayat->total() : $riwayat->count();
@endphp

<div class="masuk-page">
    <div class="masuk-shell">
        <div class="masuk-header">
            <div class="title-area">
                <span class="masuk-eyebrow">Transaksi Gudang</span>
                <h1 class="masuk-title">Laporan Barang Masuk</h1>
                <p class="masuk-subtitle">
                    Pantau riwayat transaksi barang masuk yang tercatat di gudang Anda.
                </p>
            </div>

            <div class="header-mini-card">
                <span class="mini-content">
                    <span>Total Data Masuk</span>
                    <strong>{{ $totalDataMasuk }}</strong>
                    <span class="mini-helper">transaksi tercatat</span>
                </span>

                <span class="mini-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M8 6H21"></path>
                        <path d="M8 12H21"></path>
                        <path d="M8 18H21"></path>
                        <path d="M3 6H3.01"></path>
                        <path d="M3 12H3.01"></path>
                        <path d="M3 18H3.01"></path>
                    </svg>
                </span>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show masuk-alert" role="alert">
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
            <div class="alert alert-success alert-dismissible fade show masuk-alert" role="alert">
                {{ session('success') }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="masuk-panel">
            <div class="masuk-card-head">
                <div>
                    <h2 class="masuk-section-title">Daftar Transaksi Masuk</h2>
                </div>

                <div class="add-area">

                    <button class="add-btn" type="button" data-toggle="modal" data-target="#modalMasuk" aria-label="Tambah barang masuk">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 5V19"></path>
                            <path d="M5 12H19"></path>
                        </svg>
                        <span>Barang Masuk</span>
                    </button>
                </div>
            </div>

            <div class="filter-card">
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
                    Pilih tanggal masuk
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
                        <span>Segarkan</span>
                    </a>
                </form>
            </div>

            <div class="table-toolbar">
                <div class="entries-control">
                    <span>Tampilkan</span>

                    <select id="masukEntries">
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>

                    <span>Data</span>
                </div>

                <div class="search-box">
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="M16.5 16.5L21 21"></path>
                    </svg>

                    <input type="text" id="masukSearch" placeholder="Cari transaksi masuk..." autocomplete="off">
                </div>
            </div>

            <div class="masuk-table-wrap">
                <table class="masuk-table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-kategori">KODE TRANSAKSI</th>
                            <th class="col-tanggal">TANGGAL MASUK</th>
                            <th class="col-barang">NAMA BARANG</th>
                            <th class="col-jumlah">JUMLAH MASUK</th>
                            <th class="col-keterangan">KETERANGAN</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($riwayat as $r)
                            <tr class="masuk-row">
                                <td>
                                    <span class="number-pill">{{ $loop->iteration }}</span>
                                </td>

                                <td>
                                    @php
                                        $kodeAsli = $r->kode_transaksi ?? $r->kode ?? '';
                                        $angkaKode = preg_replace('/\D/', '', $kodeAsli);
                                        $angkaKode = $angkaKode !== '' ? $angkaKode : ($r->id ?? $loop->iteration);
                                    @endphp

                                    <span class="category-badge kode-transaksi-badge">
                                        {{ str_pad((int) $angkaKode, 3, '0', STR_PAD_LEFT) }}
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
                                        <span class="product-text" title="{{ $r->produk?->nama_produk ?? '-' }}">{{ $r->produk?->nama_produk ?? '-' }}</span>
                                    </span>
                                </td>

                                <td>
                                    <span class="jumlah-badge">+{{ $r->jumlah ?? 0 }}</span>
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
                                        Data barang masuk belum tersedia.
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div id="masukInfo">
                    Menampilkan 0 dari 0 data
                </div>

                <div class="pagination-custom">
                    <button type="button" id="prevPage">‹ Sebelumnya</button>
                    <span class="page-number" id="currentPageText">1</span>
                    <button type="button" id="nextPage">Selanjutnya ›</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMasuk" tabindex="-1" role="dialog" aria-labelledby="modalMasukLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('master-data.transaksi.masuk.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="modalMasukLabel">Tambah Barang Masuk</h5>
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
                    <label>Jumlah Masuk</label>
                    <input type="number" name="jumlah" class="form-control" min="1" placeholder="Masukkan jumlah barang" required>
                </div>

                <div class="form-group mb-0">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan transaksi..."></textarea>
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
        const modalMasuk = document.getElementById('modalMasuk');

        if (modalMasuk && modalMasuk.parentElement !== document.body) {
            document.body.appendChild(modalMasuk);
        }

        const searchInput = document.getElementById('masukSearch');
        const entriesSelect = document.getElementById('masukEntries');
        const rows = Array.from(document.querySelectorAll('.masuk-row'));
        const info = document.getElementById('masukInfo');
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

            info.innerHTML = `Menampilkan <strong>${showingStart}</strong> sampai <strong>${showingEnd}</strong> dari <strong>${totalRows}</strong> data`;
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
