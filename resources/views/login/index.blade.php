<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/skote/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Aug 2022 04:38:30 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Login | Reporting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Reporting Melawi" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/logo/RM_MELAWI.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <style>
        /* body {
            background-image:;
        } */
    </style>
</head>


<body style="background-image: url('{{ asset('assets/logo/Background_1.jpg') }}')">
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 col-xl-5">
                    <div class="card overflow-hidden">
                        {{-- <div class="mt-4 text-center">
                                <h5 class="font-size-14 mb-2">Sistem Informasi Daerah </h5>
                                <h5 class="font-size-14 mb-3">Kabupaten Melawi</h5>
                            </div> --}}
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-8">
                                    <div class="text-primary p-4">
                                        <h4 class="text-primary">{{ $daerah->nama }}</h4>
                                        <p>{{ $daerah->kabupaten }}</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('assets/images/profile-img.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2">
                                <form action="{{ route('login.action') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input autofocus type="text"
                                            class="form-control  @error('username')
                                            is-invalid
                                        @enderror"
                                            name="username" id="username" value="{{ old('username') }}"
                                            placeholder="Username">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password"
                                                class="form-control
                                                    @error('password')
                                                    is-invalid
                                                    @enderror"
                                                name="password" id="password" placeholder="password"
                                                aria-label="Password" aria-describedby="password-addon">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="mb-3 -mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light"
                                            type="submit">Masuk</button>
                                    </div>
                                </form>
                                <div class="message mb-3">
                                    @if ($message = Session::get('key'))
                                        <div class="alert alert-danger alert-block text-center">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif
                                    @if ($message = Session::get('message'))
                                        <div class="alert alert-info alert-block text-center">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end account-pages -->

    <!-- JAVASCRIPT -->
    <script>
        window.setTimeout(function() {
            $(".message").fadeTo(9000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 1200);
    </script>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

<!-- Mirrored from themesbrand.com/skote/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Aug 2022 04:38:30 GMT -->

</html>
