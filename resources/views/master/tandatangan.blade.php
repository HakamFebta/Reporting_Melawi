@extends('layout.template')
@section('title', 'Tanda Tangan | Reporting Melawi')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm mb-2">
                    <h5 class="mb-sm-0 font-size-18">List Tanda Tangan</h5>
                </div>
                <div class="col mb-2">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-info tmbh" style="width:100px;" type="button"><i
                                class="bx bx-plus">&nbsp;Tambah</i></button>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tblttd" class="table table-striped table-bordered w-100">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                @method('put')
                                <thead>
                                    <tr>
                                        <th style="width:30px;">No</th>
                                        <th style="width:10px;" hidden>Id TTD</th>
                                        <th style="width:150px;">Nama</th>
                                        <th style="width:100px;" hidden>NIP</th>
                                        <th style="width:100px;text-align:center">Jabatan</th>
                                        <th style="width:100px;text-align:center">Pangkat</th>
                                        <th style="width:50px;text-align:center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>

    <!-- Modal Tambah-->
    <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #a6a792;">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="tambah" class="form-control">
                        <div class="form-group">
                            <label class="col-form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jbtn" id="jbtn">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Pangkat</label>
                            <input type="text" class="form-control" name="pangkat" id="pangkat">
                        </div>
                        <div class="form-group mt-2">
                            <button type="button" class="btn btn-primary simpandata">Simpan</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #a6a792;">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close edit-cls" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formedit" class="form-control">
                        <div class="form-group" hidden>
                            <label class="col-form-label">Id TTD</label>
                            <input type="text" class="form-control" name="editid_ttd" id="editid_ttd">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nama</label>
                            <input type="text" class="form-control" name="editnama" id="editnama">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">NIP</label>
                            <input type="text" class="form-control" name="editnip" id="editnip">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Jabatan</label>
                            <input type="text" class="form-control" name="editjbtn" id="editjbtn">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Pangkat</label>
                            <input type="text" class="form-control" name="editpangkat" id="editpangkat">
                        </div>
                        <div class="form-group mt-2">
                            <button type="button" class="btn btn-warning updatedata">Update</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary edit-cls" data-bs-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>
@endsection

{{-- JS --}}
@section('js')
    @include('master.js.jstandatangan')
@endsection
