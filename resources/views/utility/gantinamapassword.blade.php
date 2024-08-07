@extends('layout.template')
@section('title', 'Username & Password | SisKeu')
@section('content')
    <style>
        .table.dataTable {
            font-family: 'tahoma';
            font-size: 12px;
        }

        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

            background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Ganti Username dan Password</h4>
                    </div>
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
                                        <th style="width:10px;">No</th>
                                        <th style="width:350px;" hidden>Id Users </th>
                                        <th style="width:200px;">Nama </th>
                                        <th style="width:200px;">Username</th>
                                        <th style="width:200px;">Jenis</th>
                                        <th style="width:120px;text-align:center">Aksi</th>

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
    <div class="loading" style="display: none"></div>
    {{-- Modal Ganti username --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Username</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label class="col-form-label">Nama</label>
                            <input type="text" class="form-control" id="nama">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Username</label>
                            <input type="text" class="form-control" id="username" readonly>
                            {{-- id_user hidden --}}
                            <input type="text" class="form-control" id="id_user" hidden>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Username baru</label>
                            <input type="text" class="form-control" id="usernamenew">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning simpandata-username">Update</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Ganti password --}}
    <div class="modal fade" id="modalpassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="mb-3">
                            <label class="form-label">Password baru</label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" class="form-control" placeholder="Isikan password baru"
                                    aria-label="Password" id="passwordnew" aria-describedby="password-addon">
                                <button class="btn btn-light " type="button" id="password-addon"><i
                                        class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary simpandata-password">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- JS --}}
@section('js')
    <script>
        var table;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#usernamenew").on({
                keydown: function(e) {
                    if (e.which === 32)
                        return false;
                },
                keyup: function() {
                    this.value = this.value;
                },
                change: function() {
                    this.value = this.value.replace(/\s/g, "");

                }
            });

            $("#passwordnew").on({
                keydown: function(e) {
                    if (e.which === 32)
                        return false;
                },
                keyup: function() {
                    this.value = this.value.toLowerCase();
                },
                change: function() {
                    this.value = this.value.replace(/\s/g, "");

                }
            });

            table = $('#tblusername').DataTable({
                processing: true,
                searching: true,
                scrollX: true,
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                ajax: {
                    url: "{{ route('utility.listdatausernameall') }}",
                    type: "POST",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'id_user',
                        name: 'Id Users',
                        visible: false,
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'username',
                        name: 'username',
                    },
                    {
                        data: 'jenis',
                        name: 'jenis',

                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        targets: 'aksi',
                        orderable: false,
                    }
                ]
            });

            // Modal edit
            $('#exampleModal').modal({
                backdrop: "static"
            });
            // Aksi
            $('#tblusername tbody').on('click', '.buttonedit-username', function() {
                $('#usernamenew').val(null);
                var data = table.row($(this).parents('tr')).data();
                $('#nama').val(data['nama']);
                $('#username').val(data['username']);

                $('#id_user').val(data['id_user']);
                $('#exampleModal').modal('show');
            });
            //ajax simpan username
            $(".simpandata-username").on("click", function(e) {
                e.preventDefault();
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                let usernamenew = $('#usernamenew').val();
                $.ajax({
                    url: "{{ route('utility.updateusername') }}",
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        username: $('#username').val(),
                        id_user: $('#id_user').val(),
                        nama: $('#nama').val(),
                        usernamenew: usernamenew
                    },
                    beforeSend: function() {
                        // setting a timeout
                        $('.loading').show();
                        $('.simpandata-username').prop('disabled', true);
                    },
                    success: function(status) {
                        if (status.pesan == '1') {
                            toastr.info('Username sudah dipakai');
                        } else if (status.pesan == '0') {
                            toastr.success('Berhasil diupdate');
                        }
                        $('#tblusername').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.pesan);
                    },
                    complete: function(xhr, status) {
                        // $('#nama').val(null);
                        $('#usernamenew').val(null);
                        $('.simpandata-username').prop('disabled', false);
                        $('#exampleModal').modal('hide');
                        $('.loading').hide();

                    }
                });
            });

            $('#modalpassword').modal({
                backdrop: "static"
            });
            $('#tblusername tbody').on('click', '.buttonedit-password', function() {
                var data = table.row($(this).parents('tr')).data();
                $('#username').val(data['username']);
                $('#id_user').val(data['id_user']);
                $('#modalpassword').modal('show');
            });
            //ajax simpan password
            $(".simpandata-password").on("click", function() {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                let passwordnew = $('#passwordnew').val();
                if (passwordnew == '') {
                    toastr.info('Password baru tidak boleh kosong');
                    return;
                }
                $.ajax({
                    url: "{{ route('utility.updatepassword') }}",
                    type: 'post',
                    data: ({
                        "_token": "{{ csrf_token() }}",
                        username: $('#username').val(),
                        id_user: $('#id_user').val(),
                        passwordnew: passwordnew
                    }),
                    beforeSend: function() {
                        // setting a timeout
                        $('.loading').show();
                        // $('.loading').css('display', 'block');
                        $('.simpandata-password').prop('disabled', true);
                    },
                    success: function(d) {
                        if (d.perbandingan == 'sama') {
                            window.location.href = "{{ route('login') }}";
                        } else {
                            toastr.success(d.pesan);
                            $('#tblusername').DataTable().ajax.reload();
                        }
                    },
                    complete: function(xhr, status) {
                        $('#modalpassword').modal('hide');
                        $('#passwordnew').val(null);
                        $('.simpandata-password').prop('disabled', false);
                        // $('.loading').css('display', 'none');
                        $('.loading').hide();

                    }
                });
            });

        });

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
    </script>
@endsection
{{-- '<span class="icon-drag"><span class="hide-id-drop">' + data + '</span></span>'; --}}
