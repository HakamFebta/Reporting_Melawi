@extends('layout.template')
@section('title', 'Laporan | Reporting Melawi')
@section('content')
    <style>
        .table.dataTable {
            font-family: 'tahoma';
            font-size: 12px;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-info tmbh" style="width:100px;" type="button"><i
                            class="bx bx-plus">&nbsp;Tambah</i></button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="listdata" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">No</th>
                                        <th style="width:50px;">No Transaksi</th>
                                        <th style="width:500px;">Judul</th>
                                        <th style="width:100px;">Jenis</th>
                                        <th style="width:10px;text-align:center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah-modal">Tambah data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <form autocomplete="off">
                                        <div class="row">
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" value="SUBKEGIATAN" type="checkbox"
                                                        name="checkbox" id="checkskpd">
                                                    <label class="form-check-label">Sub Kegiatan</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" value="URUSAN" type="checkbox"
                                                        name="checkbox" id="checkurusan">
                                                    <label class="form-check-label">Urusan</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" value="PROGRAM" type="checkbox"
                                                        name="checkbox" id="checkprogram">
                                                    <label class="form-check-label">Program</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="checkkegiatan" value="KEGIATAN" value="KEGIATAN">
                                                    <label class="form-check-label">Kegiatan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Judul</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="judul"
                                                    placeholder="Tuliskan Judul">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Jenis Anggaran</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control jns_anggaran" style="width: 100%;">
                                                    <option value="" selected>-- Pilih Jenis Anggaran --</option>
                                                    @if (!empty($jns_anggaran))
                                                        @foreach ($jns_anggaran as $jns_anggarans)
                                                            <option value="{{ $jns_anggarans->kode }}"
                                                                data-jns="{{ $jns_anggarans->kode }}"
                                                                data-namajns="{{ $jns_anggarans->nama }}">
                                                                {{ $jns_anggarans->nama }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row chkskpd" hidden="true">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">SKPD</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control skpd" style="width: 100%;">
                                                    <option value="" selected>-- Pilih SKPD --</option>
                                                    @if (!empty($skpd))
                                                        @foreach ($skpd as $skpds)
                                                            <option value="{{ $skpds->kd_skpd }}"
                                                                data-kd_skpd="{{ $skpds->kd_skpd }}"
                                                                data-nm_skpd="{{ $skpds->nm_skpd }}">{{ $skpds->kd_skpd }}
                                                                - {{ $skpds->nm_skpd }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row chksubkegiatan" hidden="true">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Sub Kegiatan</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control subkegiatan" style="width:100%;">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row chkurusan" hidden="true">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Urusan</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control urusan" style="width: 100%;">
                                                    <option value="" selected>-- Pilih Urusan --</option>
                                                    @if (!empty($urusan))
                                                        @foreach ($urusan as $urusans)
                                                            <option value="{{ $urusans->kd_urusan }}"
                                                                data-kd_urusan="{{ $urusans->kd_urusan }}"
                                                                data-nm_urusan="{{ $urusans->nm_urusan }}">
                                                                {{ $urusans->kd_urusan }}
                                                                - {{ $urusans->nm_urusan }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row chkprogram" hidden="true">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Program</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control program" style="width: 100%;">
                                                    <option value="" selected>-- Pilih Program --</option>
                                                    @if (!empty($program))
                                                        @foreach ($program as $programs)
                                                            <option value="{{ $programs->kd_program }}"
                                                                data-kd_program="{{ $programs->kd_program }}"
                                                                data-nm_program="{{ $programs->nm_program }}">
                                                                {{ $programs->kd_program }} -
                                                                {{ $programs->nm_program }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif

                                                </select>
                                            </div>
                                        </div>

                                        <div class="row chkkegiatan" hidden="true">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Kegiatan</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control kegiatan" style="width: 100%;">
                                                    <option value="" selected>-- Pilih Kegiatan --</option>
                                                    @if (!empty($kegiatan))
                                                        @foreach ($kegiatan as $kegiatans)
                                                            <option value="{{ $kegiatans->kd_kegiatan }}"
                                                                data-kd_kegiatan="{{ $kegiatans->kd_kegiatan }}"
                                                                data-nm_kegiatan="{{ $kegiatans->nm_kegiatan }}">
                                                                {{ $kegiatans->kd_kegiatan }} -
                                                                {{ $kegiatans->nm_kegiatan }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif

                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3 mb-3">

                                            </div>
                                            <div class="col-sm-9">
                                                <button type="button" style="margin-right:4px;width:140px"
                                                    class="btn btn-success adddata"><i
                                                        class="bx bx-plus">&nbsp;Tambah</i></button>
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="text-center col-12 mx-auto">
                                                <button type="button" style="margin-right:4px;width:140px"
                                                    class="btn btn-success adddata"><i
                                                        class="bx bx-plus">&nbsp;Tambah</i></button>
                                            </div>
                                        </div> --}}
                                    </form>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                            <!-- Card two-->
                            <div class="card">
                                <div class="card-body">
                                    <table id="tblsubkegiatan" class="table table-bordered nowrap w-100">
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        @method('put')
                                        <thead>
                                            <tr>
                                                <th style="width:100px;">No</th>
                                                <th style="width:300px;">Kode Data</th>
                                                <th style="width:500px;">Nama Data</th>
                                                <th style="width:100px;text-align:center;">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- End card two-->

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="simpandata" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="viewmodaledit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modal">Edit data</h5>
                    <button type="button" class="close cls-edit" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Tampungan value edit --}}
                    <input type="text" class="form-control" id="editno_transaksi" hidden>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <form autocomplete="off">
                                        <div class="row">
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" value="SUBKEGIATAN" type="checkbox"
                                                        name="checkbox" id="editcheckskpd">
                                                    <label class="form-check-label">Sub Kegiatan</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" value="URUSAN" type="checkbox"
                                                        name="checkbox" id="editcheckurusan">
                                                    <label class="form-check-label">Urusan</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" value="PROGRAM" type="checkbox"
                                                        name="checkbox" id="editcheckprogram">
                                                    <label class="form-check-label">Program</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="editcheckkegiatan" value="KEGIATAN" value="KEGIATAN">
                                                    <label class="form-check-label">Kegiatan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Judul</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="editjudul"
                                                    placeholder="Tuliskan Judul">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Jenis Anggaran</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control editjns_anggaran" style="width: 100%;">
                                                    <option value="" selected>-- Pilih Jenis Anggaran --</option>
                                                    @if (!empty($jns_anggaran))
                                                        @foreach ($jns_anggaran as $jns_anggarans)
                                                            <option value="{{ $jns_anggarans->kode }}"
                                                                data-jns="{{ $jns_anggarans->kode }}"
                                                                data-namajns="{{ $jns_anggarans->nama }}">
                                                                {{ $jns_anggarans->nama }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row editchkskpd" hidden="true">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">SKPD</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control editskpd" style="width: 100%;">
                                                    <option value="" selected>-- Pilih SKPD --</option>
                                                    @if (!empty($skpd))
                                                        @foreach ($skpd as $skpds)
                                                            <option value="{{ $skpds->kd_skpd }}"
                                                                data-kd_skpd="{{ $skpds->kd_skpd }}"
                                                                data-nm_skpd="{{ $skpds->nm_skpd }}">
                                                                {{ $skpds->kd_skpd }}
                                                                - {{ $skpds->nm_skpd }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row editchksubkegiatan" hidden="true">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Sub Kegiatan</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control editsubkegiatan" style="width:100%;">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row editchkurusan" hidden="true">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Urusan</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control editurusan" style="width: 100%;">
                                                    <option value="" selected>-- Pilih Urusan --</option>
                                                    @if (!empty($urusan))
                                                        @foreach ($urusan as $urusans)
                                                            <option value="{{ $urusans->kd_urusan }}"
                                                                data-kd_urusan="{{ $urusans->kd_urusan }}"
                                                                data-nm_urusan="{{ $urusans->nm_urusan }}">
                                                                {{ $urusans->kd_urusan }}
                                                                - {{ $urusans->nm_urusan }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row editchkprogram" hidden="true">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Program</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control editprogram" style="width: 100%;">
                                                    <option value="" selected>-- Pilih Program --</option>
                                                    @if (!empty($program))
                                                        @foreach ($program as $programs)
                                                            <option value="{{ $programs->kd_program }}"
                                                                data-kd_program="{{ $programs->kd_program }}"
                                                                data-nm_program="{{ $programs->nm_program }}">
                                                                {{ $programs->kd_program }} -
                                                                {{ $programs->nm_program }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row editchkkegiatan" hidden="true">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Kegiatan</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control editkegiatan" style="width: 100%;">
                                                    <option value="" selected>-- Pilih Kegiatan --</option>
                                                    @if (!empty($kegiatan))
                                                        @foreach ($kegiatan as $kegiatans)
                                                            <option value="{{ $kegiatans->kd_kegiatan }}"
                                                                data-kd_kegiatan="{{ $kegiatans->kd_kegiatan }}"
                                                                data-nm_kegiatan="{{ $kegiatans->nm_kegiatan }}">
                                                                {{ $kegiatans->kd_kegiatan }} -
                                                                {{ $kegiatans->nm_kegiatan }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3 mb-3">

                                            </div>
                                            <div class="col-sm-9">
                                                <button type="button" style="margin-right:4px;width:140px"
                                                    class="btn btn-info editadddata"><i
                                                        class="bx bx-plus">&nbsp;Tambah</i></button>
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="text-center col-12 mx-auto">
                                                <button type="button" style="margin-right:4px;width:140px"
                                                    class="btn btn-success adddata"><i
                                                        class="bx bx-plus">&nbsp;Tambah</i></button>
                                            </div>
                                        </div> --}}
                                    </form>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                            <!-- Card two-->
                            <div class="card">
                                <div class="card-body">
                                    <table id="edittblsubkegiatan" class="table table-bordered nowrap w-100">
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        @method('put')
                                        <thead>
                                            <tr>
                                                <th style="width:100px;">No</th>
                                                <th style="width:300px;">Kode Data</th>
                                                <th style="width:500px;">Nama Data</th>
                                                <th style="width:10px;text-align:center;">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- End card two-->

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cls-edit" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="updatedata" class="btn btn-warning">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cetak-->
    <div class="modal fade" id="viewmodalcetak" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Cetak</h5>
                    <button type="button" class="close cls-cetak" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- View Cetak --}}
                <input type="text" class="form-control" id="ctkno_transaksi" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <form autocomplete="off">
                                        <div class="row">
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" value="SUBKEGIATAN" type="checkbox"
                                                        name="checkbox" id="ctkcheckskpd" disabled="true">
                                                    <label class="form-check-label">Sub Kegiatan</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" value="URUSAN" type="checkbox"
                                                        name="checkbox" id="ctkcheckurusan" disabled="true">
                                                    <label class="form-check-label">Urusan</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" value="PROGRAM" type="checkbox"
                                                        name="checkbox" id="ctkcheckprogram" disabled="true">
                                                    <label class="form-check-label">Program</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="ctkcheckkegiatan" disabled="true" value="KEGIATAN">
                                                    <label class="form-check-label">Kegiatan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Judul</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="ctkjudul"
                                                    placeholder="Tuliskan Judul" readonly>
                                                <input type="text" class="form-control" id="no_transaksi" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Jenis Anggaran</label>
                                            </div>
                                            <div class="col-sm-9 mb-3">
                                                <select class="form-control ctkjns_anggaran" style="width: 100%;">
                                                    <option value="" selected>-- Pilih Jenis Anggaran --</option>
                                                    @if (!empty($jns_anggaran))
                                                        @foreach ($jns_anggaran as $jns_anggarans)
                                                            <option value="{{ $jns_anggarans->kode }}"
                                                                data-jns="{{ $jns_anggarans->kode }}"
                                                                data-namajns="{{ $jns_anggarans->nama }}">
                                                                {{ $jns_anggarans->nama }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Periode</label>
                                            </div>
                                            <div class="col-sm-4 mb-3">
                                                <input class="form-control" type="date" id="ctktgl1">
                                            </div>
                                            <div class="col-sm-4 mb-3">
                                                <input class="form-control" type="date" id="ctktgl2">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 mb-3">
                                                <label class="col-form-label">Tanda Tangan</label>
                                            </div>
                                            <div class="col-sm-9 mb-3">
                                                <select class="form-control ctkttd" style="width: 100%;">
                                                    <option value="" selected>-- Pilih Penandatangan --</option>
                                                    @if (!empty($tandatangan))
                                                        @foreach ($tandatangan as $ttd)
                                                            <option value="{{ $ttd->id_ttd }}">
                                                                {{ $ttd->nama }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada data</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Tanggal Tanda Tangan</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="date" id="tglttd">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="text-center col-12 mx-auto">
                                                <button type="button" style="margin-right:4px;width:140px"
                                                    class="btn btn-primary" value="layar"
                                                    onclick="print(this.value);"><i
                                                        class="fas fa-share">&nbsp;Layar</i></button>
                                                <button type="button" style="margin-right:4px;width:140px"
                                                    class="btn btn-secondary" value="pdf"
                                                    onclick="print(this.value);"><i
                                                        class="far fa-file-pdf">&nbsp;PDF</i></button>
                                                <button type="button" style="width:140px" class="btn btn-warning"
                                                    value="excel" onclick="print(this.value);"><i
                                                        class="far fa-file-excel">&nbsp;Excel</i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                            <!-- Card two-->
                            <div class="card">
                                <div class="card-body">
                                    <table id="ctktblsubkegiatan" class="table stripe w-100">
                                        <thead>
                                            <tr>
                                                <th style="width:50px;">No</th>
                                                <th style="width:300px;text-align:center;">Kode Data</th>
                                                <th style="width:500px;text-align:center;">Nama Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- End card two-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

{{-- JS --}}
@section('js')
    @include('laporan.js.jslaporan')
    @include('laporan.js.jsedit')
    <script>
        $(document).ready(function() {
            //Modal
            $('#viewmodal').modal({
                backdrop: "static"
            });
            $('#viewmodalcetak').modal({
                backdrop: "static"
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Datatables
            table_list = $('#listdata').DataTable({
                processing: true,
                searching: true,
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                ajax: {
                    url: "{{ route('laporananggaran.listdata') }}",
                    type: "POST",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'no_transaksi',
                        name: 'no_transaksi',
                    },
                    {
                        data: 'judul',
                        name: 'judul',
                    },
                    {
                        data: 'jenis',
                        name: 'jenis',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                    },
                ]
            });

            $('.tmbh').on('click', function(e) {
                e.preventDefault();
                $(".chkprogram").attr("hidden", true);
                $(".chkurusan").attr("hidden", true);
                $(".chkskpd").attr("hidden", true);
                $(".chkkegiatan").attr("hidden", true);
                $(".chksubkegiatan").attr("hidden", true);
                $('#checkurusan').prop('checked', false);
                $('#checkprogram').prop('checked', false);
                $('#checkskpd').prop('checked', false);
                $('#checkkegiatan').prop('checked', false);
                // Judul
                $("#judul").val('');
                // 
                $(".skpd").val(null).trigger('change.select2');
                $(".program").val(null).trigger('change.select2');
                $(".urusan").val(null).trigger('change.select2');
                $(".kegiatan").val(null).trigger('change.select2');
                $(".subkegiatan").val(null).trigger('change.select2');
                $('.jns_anggaran').val(null).trigger('change.select2');
                $('#tblsubkegiatan').DataTable().clear().draw();
                $('#viewmodal').modal('show');
            });
        });
    </script>



@endsection
