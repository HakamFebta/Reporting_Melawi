@section('js')
    <script>
        $(document).ready(function() {
            var table;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Aksi
            $('#show_skpd').hide();
            $('#keseluruhan').on('change', function() {
                $('#show_skpd').hide();
                $('#skpd').prop('checked', false);
                $("#kode_skpd").val(null).trigger('change')

            });
            $('#skpd').on('change', function() {
                $('#show_skpd').show();
                $("#kode_skpd").val([0]).trigger('change')
                $('#keseluruhan').prop('checked', false);
            });

            //Datatables
            table = $('#rincianrekeningbelanja').DataTable({
                processing: true,
                scrollY: '200px',
                searching: true,
                searchDelay: 100,
                scrollX: true,
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                columns: [{
                        data: null,
                        name: null,
                        targets: 0,
                    },
                    {
                        data: 'kode_data',
                        name: 'kode_data',
                    },
                    {
                        data: 'nama_data',
                        name: 'nm_data',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                    },
                ],

            });
            table.on('order.dt search.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();


            //SKPD
            $('#kode_skpd').select2({
                placeholder: '-- Pilih --',
                theme: 'bootstrap-5',
                allowClear: true,
                ajax: {
                    type: 'POST',
                    dataType: 'json',
                    url: "{{ route('kasda_kode_skpd') }}",
                    data: function(params) {
                        return {
                            term: params.term
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: data.hasil
                        };
                    },
                }
            });

            //Jenis Anggaran
            $('#jnsanggaran').select2({
                allowClear: true,
                theme: 'bootstrap-5',
                placeholder: '-- Pilih --',
                ajax: {
                    type: 'POST',
                    dataType: 'json',
                    url: "{{ route('kasda_jns_anggaran') }}",
                    data: function(params) {
                        return {
                            term: params.term
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: data.hasil
                        };
                    },
                }
            });

            //Rekening Belanja
            $('#rekening_belanja').select2({
                allowClear: true,
                theme: 'bootstrap-5',
                placeholder: '-- Pilih --',
                ajax: {
                    type: 'POST',
                    dataType: 'json',
                    url: "{{ route('kasda_rekening_belanja') }}",
                    data: function(params) {
                        return {
                            term: params.term
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: data.hasil
                        };
                    },
                }
            });

            $('#tambahrincian').on('click', function(e) {
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
                if ($('#rekening_belanja').select2('data') == '') {
                    toastr.warning('Pilih Rekening Belanja');
                    return;
                }
                let kode_rekening = $('#rekening_belanja').select2('data')[0].kd_rek3;
                let nama_rekening = $('#rekening_belanja').select2('data')[0].text;

                let isiandata = table.rows().data();
                let statusdata;
                let isi = $.each(isiandata, function(index, obj) {
                    if (kode_rekening == obj.kode_data) {
                        statusdata = '1';
                    }
                });
                if (statusdata == '1') {
                    toastr.info('Kode data sudah ada');
                    return;
                }
                table.row.add({
                    'kode_data': kode_rekening,
                    'nama_data': nama_rekening,
                    'aksi': `<div class="row">
                            <div class="col text-center">
                            <button class="btn btn-danger" id="removedata"><i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                             </div>`,
                }).draw();
            });

            // Aksi Hapus
            $('#rincianrekeningbelanja tbody').on('click', '#removedata', function() {
                table
                    .row($(this).parents('tr'))
                    .remove()
                    .draw();
            });
        });

        function print(val) {

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

            var table = $('#rincianrekeningbelanja').DataTable();
            var data = table.rows().data();
            if (data.length == 0) {
                toastr.error('Rincian data masih kosong');
                return;
            }
            var model_cetak = val;

            let ctktgl1 = $('#periode1').val();
            let ctktgl2 = $('#periode2').val();

            if (($('#keseluruhan').is(':checked') == false && $('#skpd').is(':checked') == false)) {
                toastr.info('Jenis masih kosong');
                return;
            }
            if ((ctktgl1 == '' || ctktgl2 == '')) {
                toastr.info('Tanggal masih kosong');
                return;
            }
            let alert_jns_ang = $('#jnsanggaran').select2('data');
            if ($('#skpd').is(':checked') == true) {
                if ($('#kode_skpd').select2('data') == '') {
                    toastr.info('SKPD masih belum dipilih');
                    return;
                }
            }
            if (alert_jns_ang == '') {
                toastr.info('Jenis anggaran masih kosong');
                return;
            }
            let jns_ang = $('#jnsanggaran').select2('data')[0].jenis_anggaran;
            let cetak_skpd = $('#keseluruhan').is(':checked') == true ? 'all' : $('#kode_skpd').select2('data')[0]
                .kode_skpd;
            let kd_data = table.rows().data().toArray().map(function(value, index) {
                return value.kode_data;
            });
            let kode_data = JSON.stringify(kd_data);
            let xr = new URL("{{ route('lrakasda') }}");
            let request = '?jns_ang=' + jns_ang + '&jmldata=' + '0' + '&model_cetak=' + model_cetak + '&skpd=' +
                cetak_skpd +
                '&periode1=' + ctktgl1 + '&sampaidengan' + '&periode2=' + ctktgl2 + '&rincian_data=' + kode_data;
            let lemparan = xr + request;
            window.open(lemparan, "_blank");
        }
    </script>
@endsection
