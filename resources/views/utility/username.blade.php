@extends('layout.template')
@section('title', 'List User | Reporting Melawi')
@section('content')
    <style>
        .table.dataTable {
            font-family: 'tahoma';
            font-size: 12px;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm mb-2">
                    <h5 class="mb-sm-0 font-size-18">List Users</h5>
                </div>
                <div class="col-sm-1 mb-2">
                    <button class="btn btn-info tmbh" style="width:90px;" type="button"><i
                            class="bx bx-plus">Tambah</i></button>
                </div>
                <div class="col-sm-3 mb-2">
                    <form autocomplete="off">
                        <div class="form-check form-switch form-switch-md">
                            <input class="form-check-input" style="float: right;" type="checkbox" id="statususernameall"
                                name="statususernameall">
                            <label class="form-check-label justify-content-md-end" for="statususernameall">Aksi
                                semua</label>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tblusername" class="table table-striped table-bordered w-100">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                @method('put')
                                <thead>
                                    <tr>
                                        <th style="width:30px;">No</th>
                                        <th style="width:350px;" hidden>Id Users</th>
                                        <th style="width:350px;" hidden>Jenis</th>
                                        <th style="width:350px;" hidden>Roles</th>
                                        <th style="width:350px;" hidden>Nama</th>
                                        <th style="width:200px;">Username</th>
                                        <th style="width:100px;">Type</th>
                                        <th style="width:10px;text-align:center">Aktif</th>
                                        <th style="width:70px;text-align:center">Aksi</th>
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



    <!-- Modal Edit -->
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Username</h5>
                    <button type="button" class="close cls-edit" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" hidden>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label">Id User</label>
                        </div>
                        <div class="col-sm-9 mb-2">
                            <input type="text" class="form-control" id="edit_iduser" placeholder="Id User">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label">Username</label>
                        </div>
                        <div class="col-sm-9 mb-2">
                            <input type="text" class="form-control" id="editusername" placeholder="Username" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label">Jenis</label>
                        </div>
                        <div class="col-sm-9 mb-2">
                            <select class="form-control editjenis" style="width:100%;">
                                <option value="">-- Pilih --</option>
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                                <option value="3">Client</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label">Pengguna</label>
                        </div>
                        <div class="col-sm-9 mb-2">
                            <select class="form-control editpengguna" style="width:100%;">
                                <option value="">-- Pilih --</option>
                                @if (!empty($roles))
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->roles }}">
                                            {{ $role->name_roles }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">Tidak ada data</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cls-edit" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning update-data">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="tmbahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Username</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="newModalForm" class="form-control">
                        <div class="form-group">
                            <label class="col-form-label">Nama</label>
                            <input type="text" class="form-control" id="tmbhnama" name="tmbhnama"
                                placeholder="Isikan Nama">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Username</label>
                            <input type="text" class="form-control" id="tmbhusername" name="tmbhusername"
                                placeholder="Isikan Username">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Isikan password" id="tmbhpassword"
                                name="tmbhpassword">
                        </div>
                        <div class="form-group mt-2">
                            <button type="button" class="btn btn-primary simpandata">Simpan</button>
                        </div>
                    </form>
                    <div class="form-group mt-2 psnsimpan" hidden="true">
                        <div class="alert alert-block text-center" role="alert" id="pesansimpan">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection

{{-- JS --}}
@section('js')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#tblusername').DataTable({
                processing: true,
                searching: true,
                scrollX: true,
                lengthMenu: [5, 10, 25, 50, 75, 100],
                ajax: {
                    url: "{{ route('utility.listdatausername') }}",
                    type: "POST",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'id_user',
                        name: 'id_user',
                        visible: false,
                    },
                    {
                        data: 'jenis',
                        name: 'jenis',
                        visible: false,
                    },
                    {
                        data: 'roles',
                        name: 'roles',
                        visible: false,
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        visible: false,
                    },
                    {
                        data: 'username',
                        name: 'username',
                    },
                    {
                        data: 'nm_jenis',
                        name: 'Type',

                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                    },
                    {
                        title: 'Aksi',
                        data: null,
                        orderable: false,
                        render: (data, type, row, meta) =>
                            `<button type="button" style="margin-left:20px;margin-right:3px;" class="btn btn-warning btn-sm buttonedit-data" title="Edit Username" data-toggle="modal" onClick="editdata('${data.id_user}','${data.jenis}','${data.roles}','${data.username}')"/><i class="bx bx-pencil"></i></button>` +
                            `<button type="button" class="btn btn-danger btn-sm buttonhps-data" data-toggle="modal" onClick="hapusdata('${data.id_user}','${data.username}')" title="Hapus Username"/><i class="bx bxs-trash"></i></button>`,
                    }
                ],
            });

            $('#statususernameall').on('change', function(e) {
                e.preventDefault();
                let status = this.checked == true ? '1' : '0';
                $.ajax({
                    url: "{{ route('utility.updatestatususernameall') }}",
                    type: 'post',
                    data: ({
                        "_token": "{{ csrf_token() }}",
                        status: status,
                    }),
                    success: function(d) {},
                    complete: function(xhr, status) {
                        $('#tblusername').DataTable().ajax.reload();
                    }
                });

            });

            // $('.tambah').on('click', function() {

            // });

            $('.editjenis').select2({
                dropdownParent: $('#modaledit'),
                theme: "bootstrap-5",
                allowClear: true,
                placeholder: "Pilih Jenis"

            });
            $('.editpengguna').select2({
                dropdownParent: $('#modaledit'),
                theme: "bootstrap-5",
                allowClear: true,
                placeholder: "Pilih Pengguna"
            });

            $('.update-data').on('click', function() {
                $('#edit_iduser').val();
                var editjenis = $('.editjenis').val();
                // alert(editjenis);
                // return;
                let editpengguna = $('.editpengguna').val();
                if (editjenis == '' || editpengguna == '') {
                    alert('Pilihan masih kosong');
                    return;
                }
                $.ajax({
                    url: "{{ route('utility.whereupdateusername') }}",
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id_user: $('#edit_iduser').val(),
                        jenis: $('.editjenis').val(),
                        pengguna: $('.editpengguna').val()

                    },
                    beforeSend: function() {},
                    success: function(data) {
                        alert(data.pesan);
                    },
                    error: function(xhr, status, error) {},
                    complete: function(xhr, status) {
                        $('#tblusername').DataTable().ajax.reload();
                        $('#modaledit').modal('hide');
                    }
                });
            });

            $('.cls-edit').on('click', function() {
                kosongedit();
            });

            $('#modaledit').modal({
                backdrop: "static"
            });


            //Modal Tambah
            $('#tmbahmodal').modal({
                backdrop: "static"
            });
            $('.close').on('click', function() {
                $('#tblusername').DataTable().ajax.reload();
                kosongtambah();
            });
            $('.tmbh').on('click', function() {
                $('#tmbahmodal').modal('show');
            });

            // Action Tambah
            $('.simpandata').on('click', function() {
                $('.simpandata').submit();
                if ($('#tmbhnama').val() == '' || $('#tmbhusername').val() == '' || $('#tmbhpassword')
                    .val() == '') {
                    return;
                }
                let username = $('#tmbhusername').val()
                username = username.replace(' ', '_');
                let password = $('#tmbhpassword').val()
                password = password.replace(' ', '');

                let data = {
                    nama: $('#tmbhnama').val(),
                    username: username,
                    password: password,
                }
                if (data) {
                    $.ajax({
                        url: "{{ route('utility.simpandatausername') }}",
                        type: 'post',
                        data: ({
                            data: data
                        }),
                        beforeSend: function() {
                            $('.simpandata').prop('disabled', true);
                        },
                        success: function(d) {
                            $(".psnsimpan").attr("hidden", false);
                            if (d.pesan == 1) {
                                $('#pesansimpan').removeClass('alert-success');
                                $('#pesansimpan').addClass(
                                    'alert-warning');
                                $('#pesansimpan').html('Username Sudah terpakai');
                            } else if (d.pesan == 0) {
                                $('#pesansimpan').removeClass('alert-warning');
                                $('#pesansimpan').addClass(
                                    'alert-success alert-block text-center');
                                $('#pesansimpan').html('Berhasil Tersimpan');
                            }
                            $("#pesansimpan").fadeTo(2000, 500).slideUp(500, function() {
                                $("#pesansimpan").slideUp(500);
                            });
                        },
                        complete: function() {
                            $('.simpandata').prop('disabled', false);
                            $('#tblusername').DataTable().ajax.reload();
                            kosongtambah();
                        },
                    });
                }

            });


            //    Validate
            $("#newModalForm").validate({
                rules: {
                    tmbhnama: {
                        required: true,
                        minlength: 5
                    },
                    tmbhusername: {
                        required: true,
                        minlength: 5
                    },
                    tmbhpassword: {
                        required: true,
                    }
                },
                messages: {
                    tmbhnama: {
                        required: "* isikan nama",
                        minlength: "Panjang data minimal 5 karakter"
                    },
                    tmbhusername: {
                        required: "* isikan Username",
                        minlength: "Panjang data minimal 5 karakter"
                    },
                    tmbhpassword: {
                        required: "* isikan Password",
                    },
                }
            });

        });

        function editdata(id_user, jenis, roles, username) {
            $('#edit_iduser').val(id_user);
            $('#editusername').val(username);
            $('.editjenis').val(jenis).trigger('change');
            $('.editpengguna').val(roles).trigger('change');
            $('#modaledit').modal('show');
        }


        function hapusdata(id_user, username) {
            let confirme = confirm("Yakin menghapus username " + username + " ?");
            if (confirme == true) {
                $.ajax({
                    url: "{{ route('utility.hapususername') }}",
                    type: 'POST',
                    data: ({
                        "_token": "{{ csrf_token() }}",
                        id_user: id_user
                    }),
                    success: function(d) {
                        alert(d.pesan);
                        // if (d.pesan) {
                        $('#tblusername').DataTable().ajax.reload();
                        // }
                    },
                });
            } else {
                $('#tblusername').DataTable().ajax.reload();
            }
        }

        function ubahStatus(id_user, username, status) {
            $.ajax({
                url: "{{ route('utility.updatestatususername') }}",
                type: 'put',
                data: ({
                    "_token": "{{ csrf_token() }}",
                    username: username,
                    id_user: id_user,
                    status: status,
                }),
                success: function(d) {
                    if (d.pesan) {
                        $('#tblusername').DataTable().ajax.reload();
                    }
                },
            });
        }

        function kosongedit() {
            $('#edit_iduser').val('');
            $('#editusername').val('');
            $('.editjenis').val(null).trigger('change');
            $('.editpengguna').val(null).trigger('change');
        }

        function kosongtambah() {
            $('#newModalForm').validate().resetForm();
            $('#tmbhnama').val('');
            $('#tmbhusername').val('');
            $('#tmbhpassword').val('');

        }
    </script>
@endsection



{{-- '<span class="icon-drag"><span class="hide-id-drop">' + data + '</span></span>'; --}}
