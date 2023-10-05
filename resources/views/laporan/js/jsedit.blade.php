<script>
    let edittblsubkegiatan;
    $(document).ready(function() {
        edittblsubkegiatan = $('#edittblsubkegiatan').DataTable({
            processing: true,
            searching: true,
            destroy: true,
            // scrollX: true,
            // scrollY: true,
            // fixedColumns: true,
            // scrollCollapse: true,
            // scrollY: '300px',
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
                }
            ],
        });
        edittblsubkegiatan.on('order.dt search.dt', function() {
            edittblsubkegiatan.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        $('.editsubkegiatan').select2({
            dropdownParent: $('#viewmodaledit')
        });
        $('.editjns_anggaran').select2({
            dropdownParent: $('#viewmodaledit')
        });
        $('.editskpd').select2({
            dropdownParent: $('#viewmodaledit')
        });
        $('.editurusan').select2({
            dropdownParent: $('#viewmodaledit')
        });
        $('.editprogram').select2({
            dropdownParent: $('#viewmodaledit')
        });
        $('.editkegiatan').select2({
            dropdownParent: $('#viewmodaledit')
        });

        $('#viewmodaledit').modal({
            backdrop: "static"
        });
        $('.editjns_anggaran').select2({
            dropdownParent: $('#viewmodaledit')
        });
        $('.editskpd').select2({
            dropdownParent: $('#viewmodaledit')
        });

        $('#edittblsubkegiatan tbody').on('click', '#removedata', function(e) {
            edittblsubkegiatan.row($(this).parents('tr')).remove().draw();
        });

        $('.cls-edit').on('click', function() {
            kosongedit();
        });

        $('#editcheckskpd').on('change', function() {
            if (this.checked == true) {
                $(".editchkskpd").attr("hidden", false);
                $(".editchkurusan").attr("hidden", true);
                $(".editchkprogram").attr("hidden", true);
                $(".editchksubkegiatan").attr("hidden", true);
                $('#editcheckskpd').prop('checked', true);
                $('#editcheckurusan').prop('checked', false);
                $('#editcheckprogram').prop('checked', false);
                $('#editcheckkegiatan').prop('checked', false);
            } else {
                $('#editcheckskpd').prop('checked', false);
                $(".editchkskpd").attr("hidden", true);
                $(".editchksubkegiatan").attr("hidden", true);
                $(".editsubkegiatan").val(null).trigger('change.select2');
                $(".editskpd").val(null).trigger('change.select2');
                $(".editprogram").val(null).trigger('change.select2');
                $(".editurusan").val(null).trigger('change.select2');
                $(".editkegiatan").val(null).trigger('change.select2');
                $(".editchkurusan").attr("hidden", true);
                $(".editchkprogram").attr("hidden", true);
                $(".editchkkegiatan").attr("hidden", true);
                $('#editcheckurusan').prop('checked', false);
                $('#editcheckprogram').prop('checked', false);
                $('#editcheckkegiatan').prop('checked', false);
            }
        });

        $('#editcheckurusan').on('change', function() {
            if (this.checked == true) {
                $(".editchkurusan").attr("hidden", false);
                $(".editchkskpd").attr("hidden", true);
                $(".editchkprogram").attr("hidden", true);
                $(".editchkkegiatan").attr("hidden", true);
                $(".editchksubkegiatan").attr("hidden", true);
                $('#editcheckskpd').prop('checked', false);
                $('#editcheckprogram').prop('checked', false);
                $('#editcheckkegiatan').prop('checked', false);
            } else {
                $(".editchkskpd").attr("hidden", true);
                $('#editcheckskpd').prop('checked', false);
                $(".editchkurusan").attr("hidden", true);
                $('#editcheckurusan').prop('checked', false);
                $(".editchkprogram").attr("hidden", true);
                $('#editcheckprogram').prop('checked', false);
                $(".editchkkegiatan").attr("hidden", true);
                $('#editcheckkegiatan').prop('checked', false);
                $(".editchksubkegiatan").attr("hidden", true);

                // 
                $(".editskpd").val(null).trigger('change.select2');
                $(".editprogram").val(null).trigger('change.select2');
                $(".editurusan").val(null).trigger('change.select2');
                $(".editkegiatan").val(null).trigger('change.select2');
                $(".editsubkegiatan").val(null).trigger('change.select2');
            }
        });
        $('#editcheckprogram').on('change', function() {
            if (this.checked == true) {
                $(".editchkprogram").attr("hidden", false);
                $(".editchksubkegiatan").attr("hidden", true);
                $(".editchkskpd").attr("hidden", true);
                $(".editchkurusan").attr("hidden", true);
                $(".editchkkegiatan").attr("hidden", true);
                $('#editcheckskpd').prop('checked', false);
                $('#editcheckurusan').prop('checked', false);
                $('#editcheckkegiatan').prop('checked', false);
            } else {
                $(".editchkprogram").attr("hidden", true);
                $(".editchkurusan").attr("hidden", true);
                $(".editchkskpd").attr("hidden", true);
                $('#editcheckurusan').prop('checked', false);
                $('#editcheckprogram').prop('checked', false);
                $('#editcheckskpd').prop('checked', false);
                $(".editchkkegiatan").attr("hidden", true);
                $('#checkkegiatan').prop('checked', false);
                $(".editchksubkegiatan").attr("hidden", true);
                // 
                $(".editskpd").val(null).trigger('change.select2');
                $(".editprogram").val(null).trigger('change.select2');
                $(".editurusan").val(null).trigger('change.select2');
                $(".editkegiatan").val(null).trigger('change.select2');
                $(".editsubkegiatan").val(null).trigger('change.select2');
            }
        });

        $('#editcheckkegiatan').on('change', function() {
            if (this.checked == true) {
                $(".editchkkegiatan").attr("hidden", false);
                $(".editchkprogram").attr("hidden", true);
                $(".editchkskpd").attr("hidden", true);
                $(".editchkurusan").attr("hidden", true);
                $('#editcheckskpd').prop('checked', false);
                $('#editcheckurusan').prop('checked', false);
                $('#editcheckprogram').prop('checked', false);
                $(".editchksubkegiatan").attr("hidden", true);
            } else {
                $(".editchkprogram").attr("hidden", true);
                $(".editchkurusan").attr("hidden", true);
                $(".editchkskpd").attr("hidden", true);
                $('#editcheckurusan').prop('checked', false);
                $('#editcheckprogram').prop('checked', false);
                $('#editcheckskpd').prop('checked', false);
                $(".editchkkegiatan").attr("hidden", true);
                $('#editcheckkegiatan').prop('checked', false);
                $(".editchksubkegiatan").attr("hidden", true);
                // 
                $(".editskpd").val(null).trigger('change.select2');
                $(".editprogram").val(null).trigger('change.select2');
                $(".editurusan").val(null).trigger('change.select2');
                $(".editkegiatan").val(null).trigger('change.select2');
                $(".editsubkegiatan").val(null).trigger('change.select2');
            }
        });

        $('.editadddata').on('click', function() {
            // let status = $("input[type='checkbox']").val();
            var statuscheckskpd = $("#editcheckskpd").is(":checked") ? "true" : "false";
            var statuscheckurusan = $("#editcheckurusan").is(":checked") ? "true" : "false";
            var statuscheckprogram = $("#editcheckprogram").is(":checked") ? "true" : "false";
            var statuscheckkegiatan = $("#editcheckkegiatan").is(":checked") ? "true" : "false";
            var checkskpd = $('#editcheckskpd').val();
            var checkurusan = $('#editcheckurusan').val();
            var checkprogram = $('#editcheckprogram').val();
            var checkkegiatan = $('#editcheckkegiatan').val();
            let statusdata;
            if (statuscheckkegiatan == "false" && statuscheckskpd == "false" && statuscheckurusan ==
                "false" && statuscheckprogram == "false") {
                alert('Pilih Jenis dulu');
                return;
            }
            let isiandata = edittblsubkegiatan.rows().data();
            if (statuscheckskpd == 'true') {
                let kd_data = $('.editsubkegiatan').val();
                let nm_data = $('.editsubkegiatan').find(':selected').data('nama');
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
                    edittblsubkegiatan.row.add({
                        'kode_data': kd_data,
                        'nama_data': nm_data,
                        'aksi': `<a href="javascript:void(0);" id="removedata" style="margin-left:5px;" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>`,
                    }).draw();
                }
                $('.editsubkegiatan').val(null).trigger('change.select2');
            }
            if (statuscheckurusan == 'true') {
                let kd_data = $('.editurusan').val();
                let nm_data = $('.editurusan').find(':selected').data('nm_urusan');
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
                    edittblsubkegiatan.row.add({
                        'kode_data': kd_data,
                        'nama_data': nm_data,
                        'aksi': `<a href="javascript:void(0);" id="removedata" style="margin-left:5px;" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>`,
                    }).draw();
                }
                $('.editurusan').val(null).trigger('change.select2');
            }
            if (statuscheckprogram == 'true') {
                let kd_data = $('.editprogram').val();
                let nm_data = $('.editprogram').find(':selected').data('nm_program');
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
                    edittblsubkegiatan.row.add({
                        'kode_data': kd_data,
                        'nama_data': nm_data,
                        'aksi': `<a href="javascript:void(0);" id="removedata" style="margin-left:5px;" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>`,
                    }).draw();
                }
                $('.editprogram').val(null).trigger('change.select2');
            }
            if (statuscheckkegiatan == 'true') {
                let kd_data = $('.editkegiatan').val();
                let nm_data = $('.editkegiatan').find(':selected').data('nm_kegiatan');
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
                    edittblsubkegiatan.row.add({
                        'kode_data': kd_data,
                        'nama_data': nm_data,
                        'aksi': `<a href="javascript:void(0);" id="removedata" style="margin-left:5px;" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>`,
                    }).draw();
                }
                $('.editkegiatan').val(null).trigger('change.select2');
            }
        });

        $('.editskpd').on('select2:select', function(e) {
            e.preventDefault();
            let skpd = this.value;
            $.ajax({
                url: "{{ route('laporananggaran.subkegiatan') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    skpd: skpd,
                    jns_ang: $('.editjns_anggaran').val()

                },
                beforeSend: function() {},
                success: function(data) {
                    $('.editsubkegiatan').empty();
                    $('.editsubkegiatan').append(
                        `<option value="" disabled selected>Pilih Sub Kegiatan</option>`
                    );
                    $.each(data, function(index, data) {
                        $('.editsubkegiatan').append(
                            `<option value="${data.kd_sub_kegiatan}" data-nama="${data.nm_sub_kegiatan}">${data.kd_sub_kegiatan} - ${data.nm_sub_kegiatan} </option>`
                        );
                    })
                },
                error: function(xhr, status, error) {},
                complete: function(xhr, status) {
                    $(".editchksubkegiatan").attr("hidden", false);
                }
            });
        });

        $('#updatedata').on('click', function() {
            let no_transaksi = $('#editno_transaksi').val();
            let judul = $('#editjudul').val();
            let sttsstatuscheckskpd = $("#editcheckskpd").is(":checked") ? "true" : "false";
            let sttsstatuscheckurusan = $("#editcheckurusan").is(":checked") ? "true" : "false";
            let sttsstatuscheckprogram = $("#editcheckprogram").is(":checked") ? "true" : "false";
            let sttsstatuscheckkegiatan = $("#editcheckkegiatan").is(":checked") ? "true" : "false";
            let sttscheckskpd = $('#editcheckskpd').val();
            let sttscheckurusan = $('#editcheckurusan').val();
            let sttscheckprogram = $('#editcheckprogram').val();
            let sttscheckkegiatan = $('#editcheckkegiatan').val();

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

            var datatampungan = edittblsubkegiatan.rows().data().toArray().map(function(value, index) {
                let data = {
                    kd_data: value.kode_data,
                    nm_data: value.nama_data,
                }
                return data;
            });

            if (edittblsubkegiatan.rows().data().length == 0) {
                alert('Rincian data masih kosong');
                return;
            }
            let data = {
                no_transaksi,
                judul,
                jenis,
                datatampungan
            }

            $.ajax({
                url: "{{ route('laporananggaran.updatedata') }}",
                type: 'post',
                data: ({
                    "_token": "{{ csrf_token() }}",
                    data: data,
                }),
                beforeSend: function() {
                    // setting a timeout
                    $('#updatedata').prop('disabled', true);
                },
                success: function(d) {
                    alert(d.pesan);
                    $('#listdata').DataTable().ajax.reload();
                },
                complete: function(xhr, status) {
                    $('#updatedata').prop('disabled', false);
                    kosongedit();
                    $('#viewmodaledit').modal('hide');
                }
            });
        });

        $('.editskpd').on('select2:select', function(e) {
            e.preventDefault();
            let skpd = this.value;
            $.ajax({
                url: "{{ route('laporananggaran.subkegiatan') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    skpd: skpd,
                    jns_ang: $('.editjns_anggaran').val()

                },
                beforeSend: function() {},
                success: function(data) {
                    $('.editsubkegiatan').empty();
                    $('.editsubkegiatan').append(
                        `<option value="" disabled selected>Pilih Sub Kegiatan</option>`
                    );
                    $.each(data, function(index, data) {
                        $('.editsubkegiatan').append(
                            `<option value="${data.kd_sub_kegiatan}" data-nama="${data.nm_sub_kegiatan}">${data.kd_sub_kegiatan} - ${data.nm_sub_kegiatan} </option>`
                        );
                    })
                },
                error: function(xhr, status, error) {},
                complete: function(xhr, status) {
                    $(".editchksubkegiatan").attr("hidden", false);
                }
            });
        });


    });



    function editdata(no_transaksi, judul, jenis) {
        $.ajax({
            url: "{{ route('laporananggaran.whereditdata') }}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                no_transaksi: no_transaksi,
                judul: judul,
                jenis: jenis
            },
            beforeSend: function() {},
            success: function(data) {
                $('#editjudul').val(data.listdata.judul);
                $('#editno_transaksi').val(data.listdata.no_transaksi);
                let jenis = data.listdata.jenis;
                if ($('#editcheckskpd').val() == jenis) {
                    $('#editcheckskpd').prop('checked', true);
                } else if ($('#editcheckurusan').val() == jenis) {
                    $('#editcheckurusan').prop('checked', true);
                } else if ($('#editcheckprogram').val() == jenis) {
                    $('#editcheckprogram').prop('checked', true);
                } else if ($('#editcheckkegiatan').val() == jenis) {
                    $('#editcheckkegiatan').prop('checked', true);
                } else {}
                $.each(data.rinciandata, function(index, data) {
                    edittblsubkegiatan.row.add({
                        'kode_data': data.kode_data,
                        'nama_data': data.nama_data,
                        'aksi': `<a href="javascript:void(0);" id="removedata" style="margin-left:5px;" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>`,
                    }).draw();
                });

                $('#viewmodaledit').modal('show');
            },
            error: function(xhr, status, error) {},
            complete: function(xhr, status) {}
        });
    }

    function kosongedit() {
        $('#edittblsubkegiatan').DataTable().clear().draw();
        $('#editcheckskpd').prop('checked', false);
        $(".editchkskpd").attr("hidden", true);
        $(".editchksubkegiatan").attr("hidden", true);
        $(".editsubkegiatan").val(null).trigger('change.select2');
        $(".editskpd").val(null).trigger('change.select2');
        $(".editprogram").val(null).trigger('change.select2');
        $(".editjns_anggaran").val(null).trigger('change.select2');
        $(".editurusan").val(null).trigger('change.select2');
        $(".editkegiatan").val(null).trigger('change.select2');
        $(".editchkurusan").attr("hidden", true);
        $(".editchkprogram").attr("hidden", true);
        $(".editchkkegiatan").attr("hidden", true);
        $('#editcheckurusan').prop('checked', false);
        $('#editcheckprogram').prop('checked', false);
        $('#editcheckkegiatan').prop('checked', false);
    }
</script>
