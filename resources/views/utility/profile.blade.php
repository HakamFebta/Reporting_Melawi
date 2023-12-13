@extends('layout.template')
@section('title', 'Profile | Reporting Melawi')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Profile</h4>
                        <button type="button" id="refresh" style="width:140px" class="btn btn-warning">&nbsp;Refresh</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3 mb-2">
                                    <label class="col-form-label">Nama</label>
                                </div>
                                <div class="col-sm-9 mb-2">
                                    <input type="text" class="form-control" id="nama" value="{{ $nama }}"
                                        placeholder="Nama" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 mb-2">
                                    <label class="col-form-label">Username</label>
                                </div>
                                <div class="col-sm-9 mb-2">
                                    <input type="text" class="form-control" id="username" value="{{ $username }}"
                                        placeholder="Username" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 mb-2">
                                    <label class="col-form-label">Nama Baru</label>
                                </div>
                                <div class="col-sm-9 mb-2">
                                    <input type="text" class="form-control" id="namanew" placeholder="Nama Baru">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 mb-2">
                                    <label class="col-form-label">Username Baru</label>
                                </div>
                                <div class="col-sm-9 mb-2">
                                    <input type="text" class="form-control" id="usernamenew" placeholder="Username Baru">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 mb-2">
                                    <label class="col-form-label">Password Baru</label>
                                </div>
                                <div class="col-sm-9 mb-2">
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" class="form-control" placeholder="Isikan password baru"
                                            aria-label="Password" id="passwordnew" aria-describedby="password-addon">
                                        <button class="btn btn-light " type="button" id="password-addon"><i
                                                class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="text-center col-12 mx-auto">
                                    <button type="button" id="update" style="margin-right:4px;width:140px"
                                        class="btn btn-info">&nbsp;Update</button>
                                    <button type="button" id="cancel" style="width:140px"
                                        class="btn btn-secondary">&nbsp;Cancel</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>

    @section('js')
        <script type="text/javascript">
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
                        this.value = this.value;
                    },
                    change: function() {
                        this.value = this.value.replace(/\s/g, "");

                    }
                });

                // Klik Button
                $("#update").on("click", function(e) {
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
                    $.ajax({
                        url: "{{ route('reporting.updateprofile') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            namanew: $('#namanew').val(),
                            usernamenew: $('#usernamenew').val(),
                            passwordnew: $('#passwordnew').val(),
                        },
                        beforeSend: function() {
                            // setting a timeout
                            $('#update').prop('disabled', true);
                        },
                        success: function(data) {
                            if (data.pesan == '3' || data.pesan == '4' || data.pesan == '6' || data
                                .pesan == '7') {
                                const delayInMilliseconds = 3000; //1 second
                                toastr.success(data.text);
                                setTimeout(function() {
                                    window.location.href = "{{ route('login') }}";
                                }, delayInMilliseconds);
                            } else if (data.pesan == '8') {
                                toastr.warning(data.text);
                            } else {
                                toastr.success(data.text);
                                // window.location.href = "{{ route('reporting.profile') }}";
                            }

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.pesan);
                        },
                        complete: function(xhr, status) {
                            $('#usernamenew').val('');
                            $('#namanew').val('');
                            $('#passwordnew').val('');
                            $('#update').prop('disabled', false);
                        }
                    });
                });

                $('#refresh').on('click', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('reporting.refreshprofile') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        beforeSend: function() {
                            // setting a timeout
                            $('#refresh').prop('disabled', true);
                        },
                        success: function(data) {
                            // alert(data.hasil.nama);
                            $('#nama').val(data.hasil.nama);
                            $('#username').val(data.hasil.username);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.pesan);
                        },
                        complete: function(xhr, status) {
                            $('#refresh').prop('disabled', false);
                        }
                    });
                });

                $('#cancel').on('click', function(e) {
                    e.preventDefault();
                    $('#usernamenew').val('');
                    $('#namanew').val('');
                    $('#passwordnew').val('');
                });

            });
        </script>
    @endsection


@endsection
