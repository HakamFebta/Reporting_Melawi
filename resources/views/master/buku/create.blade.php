@extends('layout.dashboard')
@section('title', 'Tambah Buku | XYZ')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            {{-- <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Form Layouts</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Layouts</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div> --}}
            <!-- end page title -->
            <form action="{{ route('master.simpan_data') }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Form Buku</h4>
                                {{-- Flash --}}
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                @if ($message = Session::get('warning'))
                                    <div class="alert alert-warning alert-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                <div class="mb-2">
                                    <label for="judulbuku-input" class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control @error('judulbuku') is-invalid @enderror"
                                        id="judulbuku" name="judulbuku" value="{{ old('judulbuku') }}"
                                        placeholder="Judul Buku">
                                    <div class="invalid-feedback">
                                        @error('judulbuku')
                                            <p> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="kategori-input" class="form-label">Kategori</label>
                                    <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                        id="kategori" name="kategori" value="{{ old('kategori') }}" placeholder="Kategori">
                                    <div class="invalid-feedback">
                                        @error('kategori')
                                            <p> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="pengarang-input" class="form-label">Pengarang</label>
                                    <input type="text" class="form-control @error('pengarang') is-invalid @enderror"
                                        id="pengarang" name="pengarang" value="{{ old('pengarang') }}"
                                        placeholder="Pengarang">
                                    <div class="invalid-feedback">
                                        @error('pengarang')
                                            <p> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="isbn-input" class="form-label">ISBN</label>
                                    <input type="text" class="form-control @error('isbn') is-invalid @enderror"
                                        id="isbn" name="isbn" value="{{ old('isbn') }}" placeholder="Isi ISBN">
                                    <div class="invalid-feedback">
                                        @error('isbn')
                                            <p> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label for="jmlhal-input" class="form-label">Jumlah Halaman</label>
                                            <input type="number" min="0"
                                                class="form-control @error('jmlhal') is-invalid @enderror" id="jmlhal"
                                                name="jmlhal" value="{{ old('jmlhal') }}" placeholder="0">
                                            <div class="invalid-feedback">
                                                @error('jmlhal')
                                                    <p> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label for="jmlbuku-input" class="form-label">Jumlah buku</label>
                                            <input type="number" min="0"
                                                class="form-control @error('jmlbuku') is-invalid @enderror" id="jmlbuku"
                                                name="jmlbuku" value="{{ old('jmlbuku') }}" placeholder="0">
                                            <div class="invalid-feedback">
                                                @error('jmlbuku')
                                                    <p> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label for="thnterbit-input" class="form-label">Tahun Terbit</label>
                                            <input type="text"
                                                class="form-control @error('thnterbit') is-invalid @enderror" id="thnterbit"
                                                name="thnterbit" value="{{ old('thnterbit') }}" placeholder="0">
                                            <div class="invalid-feedback">
                                                @error('thnterbit')
                                                    <p> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="sinopsis-input" class="form-label">Sinopsis</label>
                                    <textarea class="form-control @error('sinopsis') is-invalid @enderror" id="sinopsis" name="sinopsis" rows="3">{{ old('sinopsis') }}</textarea>
                                    <div class="invalid-feedback">
                                        @error('sinopsis')
                                            <p> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="penerbit-input" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control @error('penerbit') is-invalid @enderror"
                                        id="penerbit" name="penerbit" value="{{ old('penerbit') }}"
                                        placeholder="Penerbit">
                                    <div class="invalid-feedback">
                                        @error('penerbit')
                                            <p> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="rak-input" class="form-label">Rak</label>
                                    <input type="text" class="form-control @error('rak') is-invalid @enderror"
                                        id="rak" name="rak" value="{{ old('rak') }}" placeholder="">
                                    <div class="invalid-feedback">
                                        @error('rak')
                                            <p> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" id="simpan" class="btn btn-primary w-md"
                                        style="margin-right:10px">Simpan</button>
                                    <a class="btn btn-secondary w-md" href="{{ route('master.masterbuku') }}"
                                        role="button">Kembali</a>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Gambar
                                </h4>
                                <p style="color:red;">* Max 2 Mb</p>
                                <div class="row">
                                    <div class="mb-3">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            name="image" id="image">
                                        <div class="invalid-feedback">
                                            @error('image')
                                                <p> {{ $message }} </p>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <img id="preview" style="display:none;" class="rounded mx-auto"
                                                src="" width="250" height="200" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
            </form>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //
            $(".alert").slideDown(4000).delay(8000).slideUp(1000);
            //
            image.onchange = evt => {
                preview = document.getElementById('preview');
                preview.style.display = 'block';
                const [file] = image.files
                if (file) {
                    preview.src = URL.createObjectURL(file)
                }
            }

            //
        });
    </script>
@endsection
