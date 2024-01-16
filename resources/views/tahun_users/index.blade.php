<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/skote/layouts/invoices-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Aug 2022 04:38:25 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Tahun Anggaran | Reporting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Reporting" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <style type="text/css">
        @import "{{ asset('assets/libs/font-awesome/all.min.css') }}";
        @import "{{ asset('assets/css/bootstrap.min.css') }}";
        @import "{{ asset('assets/css/app.min.css') }}";
    </style>
    {{-- @import "style-ku.css"; --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/libs/font-awesome/all.min.css') }}" type="text/css" /> --}}

    <!-- Bootstrap Css -->
    {{-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" /> --}}
    <!-- Icons Css -->
    {{-- <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" /> --}}
    <!-- App Css-->
    {{-- <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" /> --}}

</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        {{-- <div class="main-content"> --}}

        <div class="page-content">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 col-sm-4">
                            <div class="card" style="width: 18rem;">

                                <div class="card-body">
                                    <div class="avatar-sm me-3 mx-lg-auto mb-3 mt-1 float-start float-lg-none">
                                        <span
                                            class="avatar-title rounded-circle bg-info bg-soft text-primary font-size-16">
                                            2023
                                        </span>
                                    </div>
                                    <button type="button" id="tahun" name="tahun" value="2023"
                                        class="btn btn-outline-primary">Masuk</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 col-sm-4">
                            <div class="card" style="width: 18rem;">

                                <div class="card-body">
                                    <div class="avatar-sm me-3 mx-lg-auto mb-3 mt-1 float-start float-lg-none">
                                        <span
                                            class="avatar-title rounded-circle bg-info bg-soft text-primary font-size-16">
                                            2024
                                        </span>
                                    </div>
                                    <button type="button" id="tahun" name="tahun" value="2024"
                                        class="btn btn-outline-primary">Masuk</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 col-sm-4">
                            <div class="card" style="width: 18rem;">

                                <div class="card-body">
                                    <div class="avatar-sm me-3 mx-lg-auto mb-3 mt-1 float-start float-lg-none">
                                        <span
                                            class="avatar-title rounded-circle bg-info bg-soft text-primary font-size-16">
                                            2025
                                        </span>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary">Masuk</button>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
                <!-- Content here -->

            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 col-sm-4">
                            <div class="card" style="width: 18rem;">

                                <div class="card-body">
                                    <div class="avatar-sm me-3 mx-lg-auto mb-3 mt-1 float-start float-lg-none">
                                        <span
                                            class="avatar-title rounded-circle bg-info bg-soft text-primary font-size-16">
                                            2026
                                        </span>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary">Masuk</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 col-sm-4">
                            <div class="card" style="width: 18rem;">

                                <div class="card-body">
                                    <div class="avatar-sm me-3 mx-lg-auto mb-3 mt-1 float-start float-lg-none">
                                        <span
                                            class="avatar-title rounded-circle bg-info bg-soft text-primary font-size-16">
                                            2027
                                        </span>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary">Masuk</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 col-sm-4">
                            <div class="card" style="width: 18rem;">

                                <div class="card-body">
                                    <div class="avatar-sm me-3 mx-lg-auto mb-3 mt-1 float-start float-lg-none">
                                        <span
                                            class="avatar-title rounded-circle bg-info bg-soft text-primary font-size-16">
                                            2028
                                        </span>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary">Masuk</button>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- Content here -->

            </div>
            <div class="container">
                <a class="btn btn-primary btn-lg" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button"><i
                        class="fa-solid fa-chevron-left"></i>&nbsp;Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>

        <!-- container-fluid -->
        {{-- </div> --}}
        <!-- End Page-content -->


        <footer class="footer">

        </footer>
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/font-awesome/all.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name=tahun]').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('reporting.pilihantahun') }}",
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        tahun: this.value
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        location.href = "{{ route('reporting.dashboard') }}";
                    },
                    error: function(xhr, status, error) {},
                    complete: function(xhr, status) {

                    }
                });
            });
        });
    </script>

</body>

<!-- Mirrored from themesbrand.com/skote/layouts/invoices-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Aug 2022 04:38:25 GMT -->

</html>
