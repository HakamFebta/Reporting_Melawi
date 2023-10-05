@extends('layout.dashboard')
@section('title', 'Buku | XYZ')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row mb-2">
            <div class="col-12">
                <div class="page-title-right">
                    {{-- <button id="tambah_keluarga" class="btn btn-outline-info tomboltambah" style="float: right;"><i
                                class="bx bx-plus-circle"></i> Tambah Data</button> --}}
                    <a class="btn btn-primary clicktambah" href="{{ route('master.create') }}" role="button" style="float: right;"><i class="bx bx-plus-circle"></i>&nbsp;Tambah Data</a>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    {{-- <th>Foto</th> --}}
                                    <th>Judul Buku</th>
                                    <th>Penerbit</th>
                                    <th>Stock</th>
                                    <th>Kategori</th>
                                    <th>Rak</th>
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
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        table = $('#datatable').DataTable({
            destroy: true
            , searching: true
            , lengthMenu: [5, 10, 50, 100, 500, 1000]
            , ajax: {
                url: "{{ route('master.listdata') }}"
                , type: "POST"
            , }
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                },
                // {
                //     data: '',
                //     name: 'Foto',
                //     orderable: false
                // },
                {
                    data: 'judul_buku'
                    , name: 'Judul Buku'
                }
                , {
                    data: 'penerbit'
                    , name: 'Penerbit'
                }
                , {
                    data: 'jml_buku'
                    , name: 'Stock'
                }
                , {
                    data: 'kategori'
                    , name: 'Kategori'
                }
                , {
                    data: 'rak'
                    , name: 'Rak'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , className: "text-center"
                , }
            , ]

        });
        // $(".clicktambah").on("click", function() {

        // });
    });

</script>
@endsection
