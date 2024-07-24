@extends('layout.template')
@section('title', 'Laporan LRA Kasda || SisKeu')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="page-content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-3 ms-3">
                                <div class="form-check form-switch form-switch-md">
                                    <input class="form-check-input" type="checkbox" role="switch" name="checkboxall"
                                        id="keseluruhan">
                                    <label class="form-check-label" for="keseluruhan">Keseluruhan</label>
                                </div>
                            </div>
                            <div class="col-md-3 ms-3">
                                <div class="form-check form-switch form-switch-md">
                                    <input class="form-check-input" type="checkbox" name="checkboxall" role="switch"
                                        id="skpd">
                                    <label class="form-check-label" for="skpd">SKPD</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2 items-center">
                                <label for="periode">Periode</label>
                            </div>
                            <div class="col-md-5 items-center">
                                <input type="date" class="form-control" id="periode1">
                            </div>
                            <div class="col-md-5 items-center">
                                <input type="date" class="form-control" id="periode2">
                            </div>
                        </div>
                        <div class="row mb-3" id="show_skpd">
                            <div class="col-md-2 items-center">
                                <label class="form-check-label">SKPD</label>
                            </div>
                            <div class="col-10">
                                <select class="form-select" id="kode_skpd" style="width: 100%"
                                    aria-label="Default select example">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label class="form-check-label">Jenis Anggaran</label>
                            </div>
                            <div class="col-10">
                                <select class="form-select" id="jnsanggaran" style="width: 100%"
                                    aria-label="Default select example">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2 items-center">
                                <span class="font-weight-bold">Rekening Belanja</span>
                            </div>
                            <div class="col-10">
                                <select class="form-select" aria-label="Default select example" id="rekening_belanja"
                                    style="width: 100%">
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 items-center">
                            </div>
                            <div class="col-10">
                                <button type="button" style="margin-right:4px;width:140px"
                                    class="btn btn-danger rounded-top" value="layar" id="tambahrincian"><i
                                        class="bx bx-plus">&nbsp;Tambah Rincian</i></button>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="text-center col-12 mx-auto">
                                <button type="button" style="margin-right:4px;width:140px"
                                    class="btn btn-primary rounded-pill" value="layar" onclick="print(this.value);"><i
                                        class="fas fa-share">&nbsp;Layar</i></button>
                                <button type="button" style="margin-right:4px;width:140px"
                                    class="btn btn-secondary rounded-pill" value="pdf" onclick="print(this.value);"><i
                                        class="far fa-file-pdf">&nbsp;PDF</i></button>
                                <button type="button" style="width:140px" class="btn btn-warning rounded-pill"
                                    value="excel" onclick="print(this.value);"><i
                                        class="far fa-file-excel">&nbsp;Excel</i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="rincianrekeningbelanja" class="table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">No</th>
                                        <th style="width:50px;">Kode Data</th>
                                        <th style="width:100px;">Nama Data</th>
                                        <th style="width:20px;text-align:center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('laporanLRAKasda.js')
@endsection
