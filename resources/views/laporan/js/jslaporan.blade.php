<script>
    $(document).ready(function() {
        //Datatables
        table = $('#tblsubkegiatan').DataTable({
            processing: true,
            searching: true,
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
        // Modal cetak
        $('.ctkjns_anggaran').select2({
            dropdownParent: $('#viewmodalcetak')
        });
        $('.ctkttd').select2({
            dropdownParent: $('#viewmodalcetak')
        });

        // End
        // Hidden
        // $('.chkskpd').hide();
        // $('.chkurusan').hide();
        // $('.chkprogram').hide();
        // End
        $('.subkegiatan').select2({
            dropdownParent: $('#viewmodal')
        });
        $('.jns_anggaran').select2({
            dropdownParent: $('#viewmodal')
        });
        $('.skpd').select2({
            dropdownParent: $('#viewmodal')
        });
        $('.urusan').select2({
            dropdownParent: $('#viewmodal')
        });
        $('.program').select2({
            dropdownParent: $('#viewmodal')
        });
        $('.kegiatan').select2({
            dropdownParent: $('#viewmodal')
        });


        $('#checkskpd').on('change', function() {
            if (this.checked == true) {
                $(".chkskpd").attr("hidden", false);
                $(".chkurusan").attr("hidden", true);
                $(".chkprogram").attr("hidden", true);
                $(".chksubkegiatan").attr("hidden", true);
                $(".chkkegiatan").attr("hidden", true);
                $('#checkskpd').prop('checked', true);
                $('#checkurusan').prop('checked', false);
                $('#checkprogram').prop('checked', false);
                $('#checkkegiatan').prop('checked', false);
            } else {
                $('#checkskpd').prop('checked', false);
                $(".chkskpd").attr("hidden", true);
                $(".kegiatan").attr("hidden", true);
                $(".chksubkegiatan").attr("hidden", true);
                $(".chkkegiatan").attr("hidden", true);
                $(".subkegiatan").val(null).trigger('change.select2');
                $(".skpd").val(null).trigger('change.select2');
                $(".program").val(null).trigger('change.select2');
                $(".urusan").val(null).trigger('change.select2');
                $(".kegiatan").val(null).trigger('change.select2');
                $(".chkurusan").attr("hidden", true);
                $(".chkprogram").attr("hidden", true);
                $(".chkkegiatan").attr("hidden", true);
                $('#checkurusan').prop('checked', false);
                $('#checkprogram').prop('checked', false);
                $('#checkkegiatan').prop('checked', false);
            }
        });

        $('#checkurusan').on('change', function() {
            if (this.checked == true) {
                $(".chkurusan").attr("hidden", false);
                $(".chkskpd").attr("hidden", true);
                $(".chkprogram").attr("hidden", true);
                $(".chkkegiatan").attr("hidden", true);
                $(".chksubkegiatan").attr("hidden", true);
                $('#checkskpd').prop('checked', false);
                $('#checkprogram').prop('checked', false);
                $('#checkkegiatan').prop('checked', false);
            } else {
                $(".chkskpd").attr("hidden", true);
                $('#checkskpd').prop('checked', false);
                $(".chkurusan").attr("hidden", true);
                $('#checkurusan').prop('checked', false);
                $(".chkprogram").attr("hidden", true);
                $('#checkprogram').prop('checked', false);
                $(".chkkegiatan").attr("hidden", true);
                $('#checkkegiatan').prop('checked', false);
                $(".chksubkegiatan").attr("hidden", true);

                // 
                $(".skpd").val(null).trigger('change.select2');
                $(".program").val(null).trigger('change.select2');
                $(".urusan").val(null).trigger('change.select2');
                $(".kegiatan").val(null).trigger('change.select2');
                $(".subkegiatan").val(null).trigger('change.select2');
            }
        });
        $('#checkprogram').on('change', function() {
            if (this.checked == true) {
                $(".chkprogram").attr("hidden", false);
                $(".chksubkegiatan").attr("hidden", true);
                $(".chkskpd").attr("hidden", true);
                $(".chkurusan").attr("hidden", true);
                $(".chkkegiatan").attr("hidden", true);
                $('#checkskpd').prop('checked', false);
                $('#checkurusan').prop('checked', false);
                $('#checkkegiatan').prop('checked', false);
            } else {
                $(".chkprogram").attr("hidden", true);
                $(".chkurusan").attr("hidden", true);
                $(".chkskpd").attr("hidden", true);
                $('#checkurusan').prop('checked', false);
                $('#checkprogram').prop('checked', false);
                $('#checkskpd').prop('checked', false);
                $(".chkkegiatan").attr("hidden", true);
                $('#checkkegiatan').prop('checked', false);
                $(".chksubkegiatan").attr("hidden", true);
                // 
                $(".skpd").val(null).trigger('change.select2');
                $(".program").val(null).trigger('change.select2');
                $(".urusan").val(null).trigger('change.select2');
                $(".kegiatan").val(null).trigger('change.select2');
                $(".subkegiatan").val(null).trigger('change.select2');
            }
        });

        $('#checkkegiatan').on('change', function() {
            if (this.checked == true) {
                $(".chkkegiatan").attr("hidden", false);
                $(".chkprogram").attr("hidden", true);
                $(".chkskpd").attr("hidden", true);
                $(".chkurusan").attr("hidden", true);
                $('#checkskpd').prop('checked', false);
                $('#checkurusan').prop('checked', false);
                $('#checkprogram').prop('checked', false);
                $(".chksubkegiatan").attr("hidden", true);
            } else {
                $(".chkprogram").attr("hidden", true);
                $(".chkurusan").attr("hidden", true);
                $(".chkskpd").attr("hidden", true);
                $('#checkurusan').prop('checked', false);
                $('#checkprogram').prop('checked', false);
                $('#checkskpd').prop('checked', false);
                $(".chkkegiatan").attr("hidden", true);
                $('#checkkegiatan').prop('checked', false);
                $(".chksubkegiatan").attr("hidden", true);
                // 
                $(".skpd").val(null).trigger('change.select2');
                $(".program").val(null).trigger('change.select2');
                $(".urusan").val(null).trigger('change.select2');
                $(".kegiatan").val(null).trigger('change.select2');
                $(".subkegiatan").val(null).trigger('change.select2');
            }
        });

        // Sub kegiatan
        $('.adddata').on('click', function() {
            // let status = $("input[type='checkbox']").val();
            var statuscheckskpd = $("#checkskpd").is(":checked") ? "true" : "false";
            var statuscheckurusan = $("#checkurusan").is(":checked") ? "true" : "false";
            var statuscheckprogram = $("#checkprogram").is(":checked") ? "true" : "false";
            var statuscheckkegiatan = $("#checkkegiatan").is(":checked") ? "true" : "false";
            var checkskpd = $('#checkskpd').val();
            var checkurusan = $('#checkurusan').val();
            var checkprogram = $('#checkprogram').val();
            var checkkegiatan = $('#checkkegiatan').val();
            let statusdata;
            if (statuscheckkegiatan == "false" && statuscheckskpd == "false" && statuscheckurusan ==
                "false" && statuscheckprogram == "false") {
                alert('Pilih Jenis dulu');
                return;
            }
            let isiandata = table.rows().data();
            if (statuscheckskpd == 'true') {
                let kd_data = $('.subkegiatan').val();
                let nm_data = $('.subkegiatan').find(':selected').data('nama');
                if (kd_data == null || kd_data == '') {
                    alert('Pilih Sub Kegiatan dulu');
                    return;
                }
                let isi = $.each(isiandata, function(index, obj) {
                    if (kd_data == obj.kode_data) {
                        statusdata = '1';
                    }
                    if (kd_data.length != obj.kode_data.length) {
                        statusdata = '2';
                    }
                });
                if (statusdata == '1') {
                    alert('Kode data sudah ada');
                    return;
                } else if (statusdata == '2') {
                    alert('Kode data jumlah digit berbeda');
                    return;
                } else if (statusdata == undefined) {
                    table.row.add({
                        'kode_data': kd_data,
                        'nama_data': nm_data,
                        'aksi': `<a href="javascript:void(0);" id="removedata" style="margin-left:12px;" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>`,
                    }).draw();
                }
                $('.subkegiatan').val(null).trigger('change.select2');
            }
            if (statuscheckurusan == 'true') {
                let kd_data = $('.urusan').val();
                let nm_data = $('.urusan').find(':selected').data('nm_urusan');
                if (kd_data == null || kd_data == '') {
                    alert('Pilih Kode Urusan dulu');
                    return;
                }
                let isi = $.each(isiandata, function(index, obj) {
                    if (kd_data == obj.kode_data) {
                        statusdata = '1';
                    }
                    if (kd_data.length != obj.kode_data.length) {
                        statusdata = '2';
                    }
                });
                if (statusdata == '1') {
                    alert('Kode data sudah ada');
                    return;
                } else if (statusdata == '2') {
                    alert('Kode data jumlah digit berbeda');
                    return;
                } else if (statusdata == undefined) {
                    table.row.add({
                        'kode_data': kd_data,
                        'nama_data': nm_data,
                        'aksi': `<a href="javascript:void(0);" id="removedata" style="margin-left:12px;" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>`,
                    }).draw();
                }
                $('.urusan').val(null).trigger('change.select2');
            }
            if (statuscheckprogram == 'true') {
                let kd_data = $('.program').val();
                let nm_data = $('.program').find(':selected').data('nm_program');
                if (kd_data == null || kd_data == '') {
                    alert('Pilih Kode Program dulu');
                    return;
                }
                let isi = $.each(isiandata, function(index, obj) {
                    if (kd_data == obj.kode_data) {
                        statusdata = '1';
                    }
                    if (kd_data.length != obj.kode_data.length) {
                        statusdata = '2';
                    }
                });
                if (statusdata == '1') {
                    alert('Kode data sudah ada');
                    return;
                } else if (statusdata == '2') {
                    alert('Kode data jumlah digit berbeda');
                    return;
                } else if (statusdata == undefined) {
                    table.row.add({
                        'kode_data': kd_data,
                        'nama_data': nm_data,
                        'aksi': `<a href="javascript:void(0);" id="removedata" style="margin-left:12px;" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>`,
                    }).draw();
                }
                $('.program').val(null).trigger('change.select2');
            }
            if (statuscheckkegiatan == 'true') {
                let kd_data = $('.kegiatan').val();
                let nm_data = $('.kegiatan').find(':selected').data('nm_kegiatan');
                if (kd_data == null || kd_data == '') {
                    alert('Pilih Kode Program dulu');
                    return;
                }
                let isi = $.each(isiandata, function(index, obj) {
                    if (kd_data == obj.kode_data) {
                        statusdata = '1';
                    }
                    if (kd_data.length != obj.kode_data.length) {
                        statusdata = '2';
                    }
                });
                if (statusdata == '1') {
                    alert('Kode data sudah ada');
                    return;
                } else if (statusdata == '2') {
                    alert('Kode data jumlah digit berbeda');
                    return;
                } else if (statusdata == undefined) {
                    table.row.add({
                        'kode_data': kd_data,
                        'nama_data': nm_data,
                        'aksi': `<a href="javascript:void(0);" id="removedata" style="margin-left:12px;" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>`,
                    }).draw();
                }
                $('.kegiatan').val(null).trigger('change.select2');
            }

        });

        $('.skpd').on('select2:select', function(e) {
            e.preventDefault();
            let skpd = this.value;
            $.ajax({
                url: "{{ route('laporananggaran.subkegiatan') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    skpd: skpd,
                    jns_ang: $('.jns_anggaran').val()

                },
                beforeSend: function() {},
                success: function(data) {
                    $('.subkegiatan').empty();
                    $('.subkegiatan').append(
                        `<option value="" disabled selected>Pilih Sub Kegiatan</option>`
                    );
                    $.each(data, function(index, data) {
                        $('.subkegiatan').append(
                            `<option value="${data.kd_sub_kegiatan}" data-nama="${data.nm_sub_kegiatan}">${data.kd_sub_kegiatan} - ${data.nm_sub_kegiatan} </option>`
                        );
                    })
                },
                error: function(xhr, status, error) {},
                complete: function(xhr, status) {
                    $(".chksubkegiatan").attr("hidden", false);
                }
            });
        });

        $('#tblsubkegiatan tbody').on('click', '#removedata', function(e) {
            table.row($(this).parents('tr')).remove().draw();
        });

        $('#simpandata').on('click', function() {
            let judul = $('#judul').val();
            let sttsstatuscheckskpd = $("#checkskpd").is(":checked") ? "true" : "false";
            let sttsstatuscheckurusan = $("#checkurusan").is(":checked") ? "true" : "false";
            let sttsstatuscheckprogram = $("#checkprogram").is(":checked") ? "true" : "false";
            let sttsstatuscheckkegiatan = $("#checkkegiatan").is(":checked") ? "true" : "false";
            let sttscheckskpd = $('#checkskpd').val();
            let sttscheckurusan = $('#checkurusan').val();
            let sttscheckprogram = $('#checkprogram').val();
            let sttscheckkegiatan = $('#checkkegiatan').val();

            if (sttsstatuscheckskpd == 'true') {
                jenis = sttscheckskpd;
            } else if (sttsstatuscheckurusan == 'true') {
                jenis = sttscheckurusan;
            } else if (sttsstatuscheckprogram == 'true') {
                jenis = sttscheckprogram;
            } else if (sttsstatuscheckkegiatan == 'true') {
                jenis = sttscheckkegiatan;
            } else {}

            if (judul == '') {
                alert('Judul tidak boleh kosong');
                return;
            }
            var datatampungan = table.rows().data().toArray().map(function(value, index) {
                let data = {
                    kd_data: value.kode_data,
                    nm_data: value.nama_data,
                }
                return data;
            });
            if (table.rows().data().length == 0) {
                alert('Rincian data masih kosong');
                return;
            }

            let data = {
                judul,
                jenis,
                datatampungan
            }

            $.ajax({
                url: "{{ route('laporananggaran.simpandata') }}",
                type: 'post',
                data: ({
                    "_token": "{{ csrf_token() }}",
                    data: data,
                }),
                beforeSend: function() {
                    // setting a timeout
                    $('#simpandata').prop('disabled', true);
                },
                success: function(d) {
                    alert(d.pesan);
                    $('#listdata').DataTable().ajax.reload();
                },
                complete: function(xhr, status) {
                    $('#simpandata').prop('disabled', false);
                    $('#viewmodal').modal('hide');
                }
            });
        });

        $('.cls-cetak').on('click', function() {
            $('#ctktblsubkegiatan').DataTable().clear().draw();
            $('#ctkcheckskpd').prop('checked', false);
            $('#ctkcheckurusan').prop('checked', false);
            $('#ctkcheckprogram').prop('checked', false);
            $('#ctkcheckkegiatan').prop('checked', false);
            $('.ctkjns_anggaran').val(null).trigger('change.select2');
            $('.ctkttd').val(null).trigger('change.select2');
            $('#ctktgl1').val('');
            $('#ctktgl2').val('');
            $('#tglttd').val('');
            $('#ctkno_transaksi').val('');
        });

    });

    function cetak(no_transaksi, judul, jenis, id_user) {
        let ctktblsubkegiatan = $('#ctktblsubkegiatan').DataTable({
            processing: true,
            searching: true,
            destroy: true,
            scrollX: true,
            // scrollY: true,
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
                }
            ],
        });
        ctktblsubkegiatan.on('order.dt search.dt', function() {
            ctktblsubkegiatan.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        // alert(no_transaksi);
        $.ajax({
            url: "{{ route('laporananggaran.wherelist') }}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                id_user: id_user,
                no_transaksi: no_transaksi,
                judul: judul,
                jenis: jenis
            },
            beforeSend: function() {},
            success: function(data) {
                $('#ctkjudul').val(data.listdata.judul);
                $('#ctkno_transaksi').val(data.listdata.no_transaksi);
                let jenis = data.listdata.jenis;
                if ($('#ctkcheckskpd').val() == jenis) {
                    $('#ctkcheckskpd').prop('checked', true);
                } else if ($('#ctkcheckurusan').val() == jenis) {
                    $('#ctkcheckurusan').prop('checked', true);
                } else if ($('#ctkcheckprogram').val() == jenis) {
                    $('#ctkcheckprogram').prop('checked', true);
                } else if ($('#ctkcheckkegiatan').val() == jenis) {
                    $('#ctkcheckkegiatan').prop('checked', true);
                } else {}
                $.each(data.rinciandata, function(index, data) {
                    ctktblsubkegiatan.row.add({
                        'kode_data': data.kode_data,
                        'nama_data': data.nama_data,
                    }).draw();
                });
                $('#viewmodalcetak').modal('show');

            },
            error: function(xhr, status, error) {},
            complete: function(xhr, status) {}
        });

    }

    function deletedata(no_transaksi, jenis) {
        let hapusdata = confirm("Yakin hapus data : " + no_transaksi + " ?");
        if (hapusdata == true) {
            $.ajax({
                url: "{{ route('laporananggaran.hapusdata') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    no_transaksi: no_transaksi,
                    jenis: jenis

                },
                beforeSend: function() {},
                success: function(data) {

                },
                error: function(xhr, status, error) {},
                complete: function(xhr, status) {
                    $('#listdata').DataTable().ajax.reload();
                }
            });
        } else {
            $('#listdata').DataTable().ajax.reload();
        }


    }

    function print(jeniscetak) {
        let ctktgl1 = $('#ctktgl1').val();
        let ctktgl2 = $('#ctktgl2').val();
        let ctkno_transaksi = $('#ctkno_transaksi').val();
        let ttd = $('.ctkttd').val();
        let tglttd = $('#tglttd').val();

        let ctkjns_anggaran = $('.ctkjns_anggaran').val();
        if (ctkjns_anggaran == '' || ctkjns_anggaran == null || ctkjns_anggaran == undefined) {
            alert('Pilih Jenis Anggaran');
            return;
        }
        if ((ctktgl1 == '' || ctktgl2 == '') || ctktgl1 == null || ctktgl2 == null) {
            alert('Pilih Periode dulu');
            return;
        }
        if (ttd == '') {
            alert('Pilih Penandatangan dulu');
            return;
        }
        if (tglttd == '') {
            alert('Pilih Tanggal Penandatangan dulu');
            return;
        }
        if ($("#ctkcheckskpd").is(":checked") == true) {
            let jenis = $("#ctkcheckskpd").val();
            let xr = new URL("{{ route('laporananggaran.cetakdatasubkegiatan') }}");
            let ctktblsubkegiatan = $('#ctktblsubkegiatan').DataTable();
            let kd_data = ctktblsubkegiatan.rows().data().toArray().map(function(value, index) {
                return value.kode_data;
            });
            let kode_data = JSON.stringify(kd_data);
            let request = '?jns_ang=' + ctkjns_anggaran + '&ttd=' + ttd + '&tglttd=' + tglttd + '&jenis=' + jenis +
                '&jns_cetak=' +
                jeniscetak +
                '&periode1=' + ctktgl1 + '&dan' + '&periode2=' + ctktgl2 + '&no_transaksi=' + ctkno_transaksi +
                '&rincian_data=' + kode_data;
            let lemparan = xr + request;
            window.open(lemparan, "_blank");
        } else if ($("#ctkcheckurusan").is(":checked") == true) {
            let jenis = $("#ctkcheckurusan").val();
            let xr = new URL("{{ route('laporananggaran.cetakdataurusan') }}");
            let ctktblsubkegiatan = $('#ctktblsubkegiatan').DataTable();
            let kd_data = ctktblsubkegiatan.rows().data().toArray().map(function(value, index) {
                return value.kode_data;
            });
            let kode_data = JSON.stringify(kd_data);
            let request = '?jns_ang=' + ctkjns_anggaran + '&ttd=' + ttd + '&tglttd=' + tglttd + '&jenis=' + jenis +
                '&jns_cetak=' + jeniscetak +
                '&periode1=' + ctktgl1 + '&dan' + '&periode2=' + ctktgl2 + '&no_transaksi=' + ctkno_transaksi +
                '&rincian_data=' + kode_data;
            let lemparan = xr + request;
            window.open(lemparan, "_blank");
        } else if ($("#ctkcheckprogram").is(":checked") == true) {
            let jenis = $("#ctkcheckprogram").val();
            let xr = new URL("{{ route('laporananggaran.cetakdataprogram') }}");
            let ctktblsubkegiatan = $('#ctktblsubkegiatan').DataTable();
            let kd_data = ctktblsubkegiatan.rows().data().toArray().map(function(value, index) {
                return value.kode_data;
            });
            let kode_data = JSON.stringify(kd_data);
            let request = '?jns_ang=' + ctkjns_anggaran + '&ttd=' + ttd + '&tglttd=' + tglttd + '&jenis=' + jenis +
                '&jns_cetak=' + jeniscetak +
                '&periode1=' + ctktgl1 + '&dan' + '&periode2=' + ctktgl2 + '&no_transaksi=' + ctkno_transaksi +
                '&rincian_data=' + kode_data;
            let lemparan = xr + request;
            window.open(lemparan, "_blank");
        } else if ($("#ctkcheckkegiatan").is(":checked") == true) {
            let jenis = $("#ctkcheckkegiatan").val();
            let xr = new URL("{{ route('laporananggaran.cetakdatakegiatan') }}");
            let ctktblsubkegiatan = $('#ctktblsubkegiatan').DataTable();
            let kd_data = ctktblsubkegiatan.rows().data().toArray().map(function(value, index) {
                return value.kode_data;
            });
            let kode_data = JSON.stringify(kd_data);
            let request = '?jns_ang=' + ctkjns_anggaran + '&ttd=' + ttd + '&tglttd=' + tglttd + '&jenis=' + jenis +
                '&jns_cetak=' + jeniscetak +
                '&periode1=' + ctktgl1 + '&dan' + '&periode2=' + ctktgl2 + '&no_transaksi=' + ctkno_transaksi +
                '&rincian_data=' + kode_data;
            let lemparan = xr + request;
            window.open(lemparan, "_blank");
        }

    }
</script>
