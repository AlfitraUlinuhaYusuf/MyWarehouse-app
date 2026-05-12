@extends('layouts.admin')

@section('content')
<style>
    .produk-page {
        width: 100%;
        padding: 31px 30px 74px;
        font-family: "Poppins", sans-serif;
        background: #ffffff;
        color: #000000;
    }

    .produk-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 34px;
    }

    .produk-title {
        margin: 0;
        font-size: 27px;
        font-weight: 500;
        color: #000000;
        letter-spacing: 0.2px;
        text-transform: uppercase;
    }

    .produk-header-right {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-right: 38px;
    }

    .produk-search-form {
        width: 238px;
    }

    .search-box {
        width: 100%;
        height: 37px;
        border: 1px solid #b8b8b8;
        border-radius: 999px;
        display: flex;
        align-items: center;
        background: #ffffff;
        padding: 0 12px;
    }

    .search-box button {
        border: none;
        background: transparent;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .search-box svg {
        width: 21px;
        height: 21px;
        margin-right: 9px;
        color: #000000;
        flex-shrink: 0;
    }

    .search-box input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        font-family: "Poppins", sans-serif;
        font-size: 21px;
        font-weight: 400;
        color: #000000;
        line-height: 1;
    }

    .search-box input::placeholder {
        color: #6b6b6b;
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

    /*
        Penting:
        Selector memakai tanda ">" agar hanya tombol utama tambah/edit yang berubah.
        Tombol di dalam modal seperti Batal dan Simpan tidak ikut terkena style plus/edit.
    */
    .add-product-control > .btn,
    .add-product-control > button {
        width: 68px !important;
        height: 28px !important;
        min-width: 68px !important;
        border: none !important;
        border-radius: 7px !important;
        background: #9dff8f !important;
        color: #000000 !important;
        box-shadow: none !important;
        padding: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 0 !important;
        line-height: 1 !important;
    }

    .add-product-control > .btn::after,
    .add-product-control > button::after {
        content: "+";
        font-family: "Poppins", sans-serif;
        font-size: 36px;
        font-weight: 500;
        line-height: 1;
        margin-top: -4px;
        color: #000000;
    }

    .add-product-control > .btn i,
    .add-product-control > button i,
    .add-product-control > .btn span,
    .add-product-control > button span {
        display: none !important;
    }

    .filter-section {
        margin-bottom: 77px;
    }

    .filter-label {
        display: block;
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 8px;
        color: #000000;
    }

    .filter-select {
        width: 100%;
        height: 43px;
        border: 1px solid #bdbdbd;
        border-radius: 8px;
        background: #ffffff;
        font-family: "Poppins", sans-serif;
        font-size: 22px;
        font-weight: 400;
        color: #5a5a5a;
        padding: 0 14px;
        outline: none;
    }

    .table-control-row {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
        font-size: 16px;
        font-weight: 400;
        color: #000000;
    }

    .entries-select {
        height: 32px;
        border: 1px solid #bcbcbc;
        background: #eeeeee;
        font-family: "Poppins", sans-serif;
        font-size: 13px;
        color: #000000;
        padding: 0 7px;
        outline: none;
    }

    .produk-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .produk-table {
        width: 100%;
        min-width: 1080px;
        border-collapse: collapse;
        table-layout: fixed;
        font-family: "Poppins", sans-serif;
        color: #000000;
    }

    .produk-table th {
        height: 42px;
        background: #eeeeee;
        border: 1px solid #dddddd;
        text-align: center;
        vertical-align: middle;
        font-size: 15px;
        font-weight: 400;
    }

    .produk-table td {
        height: 176px;
        border: 1px solid #e2e2e2;
        text-align: center;
        vertical-align: top;
        padding: 14px 12px;
        font-size: 15px;
        font-weight: 400;
    }

    .col-no {
        width: 90px;
    }

    .col-gambar {
        width: 210px;
    }

    .col-nama {
        width: 175px;
    }

    .col-kategori {
        width: 160px;
    }

    .col-stok {
        width: 90px;
    }

    .col-harga {
        width: 150px;
    }

    .col-opsi {
        width: 220px;
    }

    .produk-image-wrap {
        width: 100%;
        height: 130px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .produk-image {
        width: 98px;
        height: 98px;
        border-radius: 8px;
        object-fit: cover;
    }

    .produk-placeholder {
        width: 106px;
        height: 106px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .produk-placeholder svg {
        width: 106px;
        height: 106px;
        stroke: #222222;
        stroke-width: 2.4;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .kategori-text,
    .nama-text,
    .stok-text,
    .harga-text {
        display: block;
        padding-top: 0;
        color: #000000;
        font-size: 15px;
        font-weight: 400;
        word-break: break-word;
    }

    .opsi-actions {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        gap: 15px;
        padding-top: 0;
    }

    .delete-form {
        margin: 0;
        padding: 0;
    }

    .btn-delete-custom {
        width: 64px;
        height: 27px;
        border: none;
        border-radius: 7px;
        background: #ff4b4b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        padding: 0;
    }

    .btn-delete-custom:hover {
        background: #f23d3d;
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

    .edit-control > .btn,
    .edit-control > button {
        width: 64px !important;
        height: 27px !important;
        min-width: 64px !important;
        border: none !important;
        border-radius: 7px !important;
        background: #6391ff !important;
        color: #000000 !important;
        box-shadow: none !important;
        padding: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 0 !important;
        line-height: 1 !important;
    }

    .edit-control > .btn::after,
    .edit-control > button::after {
        content: "";
        width: 18px;
        height: 18px;
        display: block;
        background-repeat: no-repeat;
        background-position: center;
        background-size: 18px 18px;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill='none' stroke='%23000000' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 20h9'/%3E%3Cpath d='M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z'/%3E%3C/svg%3E");
    }

    .edit-control > .btn i,
    .edit-control > button i,
    .edit-control > .btn span,
    .edit-control > button span {
        display: none !important;
    }

    .produk-empty {
        height: 90px !important;
        vertical-align: middle !important;
        color: #777777;
        font-size: 15px;
    }

    .produk-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-top: 8px;
        font-size: 14px;
        color: #000000;
    }

    .pagination-custom {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .pagination-custom a,
    .pagination-custom span {
        text-decoration: none;
        color: #000000;
        font-size: 15px;
        font-weight: 400;
    }

    .pagination-custom .page-num {
        min-width: 41px;
        height: 30px;
        background: #eeeeee;
        border: 1px solid #c8c8c8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .pagination-custom .disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    .alert-custom {
        margin-bottom: 18px;
        border-radius: 8px;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
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
        font-family: "Poppins", sans-serif !important;
    }

    .modal-header {
        min-height: 74px;
        background: #8fb36b !important;
        border-bottom: none !important;
        padding: 22px 26px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }

    .modal-title {
        color: #000000 !important;
        font-family: "Poppins", sans-serif !important;
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
    }

    .modal-header .close::before {
        content: "×";
        font-family: "Poppins", sans-serif;
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
    }

    .modal-body {
        background: #ffffff !important;
        padding: 26px 28px 14px !important;
    }

    .modal-body label,
    .modal .form-group label {
        font-family: "Poppins", sans-serif !important;
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
        font-family: "Poppins", sans-serif !important;
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
        font-family: "Poppins", sans-serif !important;
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
        font-family: "Poppins", sans-serif !important;
        font-size: 15px !important;
        font-weight: 600 !important;
        box-shadow: none !important;
        padding: 0 18px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        line-height: 1 !important;
    }

    .modal-footer .btn-secondary,
    .modal-footer .btn-light,
    .modal-footer button[data-dismiss="modal"] {
        background: #eeeeee !important;
        color: #000000 !important;
    }

    .modal-footer .btn-secondary:hover,
    .modal-footer .btn-light:hover,
    .modal-footer button[data-dismiss="modal"]:hover {
        background: #dddddd !important;
    }

    .modal-footer .btn-primary,
    .modal-footer .btn-success,
    .modal-footer button[type="submit"] {
        background: #8fb36b !important;
        color: #000000 !important;
    }

    .modal-footer .btn-primary:hover,
    .modal-footer .btn-success:hover,
    .modal-footer button[type="submit"]:hover {
        background: #7da45a !important;
    }

    .modal .invalid-feedback,
    .modal .text-danger {
        font-family: "Poppins", sans-serif !important;
        font-size: 13px !important;
    }

    /* =========================
       DELETE POPUP
    ========================= */
    .delete-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.38);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 5000;
        padding: 20px;
    }

    .delete-modal-overlay.show {
        display: flex;
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
        font-family: "Poppins", sans-serif;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
    }

    .delete-cancel-btn {
        background: #eeeeee;
        color: #000000;
    }

    .delete-cancel-btn:hover {
        background: #dddddd;
    }

    .delete-confirm-btn {
        background: #ff4b4b;
        color: #ffffff;
    }

    .delete-confirm-btn:hover {
        background: #e83e3e;
    }

    @media (max-width: 900px) {
        .produk-page {
            padding: 24px 18px 50px;
        }

        .produk-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .produk-header-right {
            width: 100%;
            margin-right: 0;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .produk-search-form {
            width: 100%;
            max-width: 360px;
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
    /* Tombol tambah barang */
.add-product-control button[data-toggle="modal"],
.add-product-control .btn[data-toggle="modal"],
.add-product-control button[data-bs-toggle="modal"],
.add-product-control .btn[data-bs-toggle="modal"] {
    width: 68px !important;
    height: 28px !important;
    min-width: 68px !important;
    border: none !important;
    border-radius: 7px !important;
    background: #9dff8f !important;
    color: #000000 !important;
    box-shadow: none !important;
    outline: none !important;
    padding: 0 !important;
    margin: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 0 !important;
    line-height: 1 !important;
    position: relative !important;
}

/* Ikon plus hitam */
.add-product-control button[data-toggle="modal"]::before,
.add-product-control .btn[data-toggle="modal"]::before,
.add-product-control button[data-bs-toggle="modal"]::before,
.add-product-control .btn[data-bs-toggle="modal"]::before {
    content: "+" !important;
    font-family: "Poppins", sans-serif !important;
    font-size: 36px !important;
    font-weight: 500 !important;
    color: #000000 !important;
    line-height: 1 !important;
    position: absolute !important;
    top: 50% !important;
    left: 50% !important;
    transform: translate(-50%, -55%) !important;
}

/* Hilangkan teks/icon asli pada tombol tambah */
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

/* Tombol edit barang */
.edit-control button[data-toggle="modal"],
.edit-control .btn[data-toggle="modal"],
.edit-control button[data-bs-toggle="modal"],
.edit-control .btn[data-bs-toggle="modal"] {
    width: 64px !important;
    height: 27px !important;
    min-width: 64px !important;
    border: none !important;
    border-radius: 7px !important;
    background: #6391ff !important;
    color: #000000 !important;
    box-shadow: none !important;
    outline: none !important;
    padding: 0 !important;
    margin: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 0 !important;
    line-height: 1 !important;
    position: relative !important;
}

/* Ikon edit/pensil hitam */
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

/* Hilangkan teks/icon asli pada tombol edit */
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
</style>

<div class="produk-page">
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
        <h1 class="produk-title">DAFTAR BARANG</h1>

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
                    <tr>
                        <td>
                            {{ $produk instanceof \Illuminate\Pagination\LengthAwarePaginator ? $produk->firstItem() + $index : $index + 1 }}
                        </td>

                        <td>
                            <div class="produk-image-wrap">
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
                        </td>

                        <td>
                            <span class="nama-text">{{ $item->nama_produk ?? '-' }}</span>
                        </td>

                        <td>
                            <span class="kategori-text">
                                {{ $item->kategori->nama_kategori
                                    ?? $item->kategoriProduk->nama_kategori
                                    ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <span class="stok-text">{{ $item->stok ?? 0 }}</span>
                        </td>

                        <td>
                            <span class="harga-text">
                                Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}
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
                            Data produk tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="produk-footer">
        <div>
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
        const deleteModal = document.getElementById('deleteModal');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const deleteProductName = document.getElementById('deleteProductName');

        let selectedDeleteForm = null;

        document.querySelectorAll('.open-delete-modal').forEach(function (button) {
            button.addEventListener('click', function () {
                selectedDeleteForm = button.closest('form');

                const productName = button.getAttribute('data-product-name') || 'barang ini';
                deleteProductName.textContent = productName;

                deleteModal.classList.add('show');
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
            if (event.key === 'Escape' && deleteModal) {
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