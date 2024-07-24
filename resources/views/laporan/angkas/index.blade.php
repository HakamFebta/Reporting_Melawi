@extends('layout.template')
@section('title', 'Anggaran Kas | Siskeu')
@section('content')
    <div class="page-content">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Anggaran kas</label>
                            <div class="col-md-10">
                                <select class="form-control jns_angkas" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <option value="tetap">Penetapan</option>
                                    <option value="geser1">Penyempurnaan I</option>
                                    <option value="geser2">Penyempurnaan II</option>
                                    <option value="geser3">Penyempurnaan III</option>
                                    <option value="geser4">Penyempurnaan IV</option>
                                    <option value="geser5">Penyempurnaan V</option>
                                    <option value="ubah1">Perubahan I</option>
                                    <option value="ubah2">Perubahan II</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="text-center col-12 mx-auto">
                                <button type="button" style="margin-right:4px;width:140px"
                                    class="btn btn-primary rounded-pill" value="layar" onclick="print(this.value);"><i
                                        class="fas fa-share">&nbsp;Layar</i></button>
                                {{-- <button type="button" style="margin-right:4px;width:140px" class="btn btn-secondary"
                                    value="pdf" onclick="print(this.value);"><i
                                        class="far fa-file-pdf">&nbsp;PDF</i></button>
                                <button type="button" style="width:140px" class="btn btn-warning" value="excel"
                                    onclick="print(this.value);"><i class="far fa-file-excel">&nbsp;Excel</i></button> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>

@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.jns_angkas').select2({
                theme: "bootstrap-4",
                placeholder: '-- Pilih --',
                allowClear: true
            });
        });

        function print(jenis) {
            let jns_angkas = $('.jns_angkas').val();
            let xr = new URL("{{ route('laporananggaran.cetakangkas') }}");
            let request = '?jns_angkas=' + jns_angkas + '&jenis=' + jenis;
            let lemparan = xr + request;
            window.open(lemparan, "_blank");
        }
    </script>
@endsection


@endsection
