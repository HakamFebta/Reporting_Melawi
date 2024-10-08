
 <script>
     $(document).ready(function() {
         let table;
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         table = $('#tblttd').DataTable({
             processing: true,
             searching: true,
             scrollX: true,
             ajax: {
                 url: "{{ route('tandatangan.listdatattd') }}",
                 type: "POST",
                 dataSrc: ''
             },
             lengthMenu: [
                 [5, 10, 50, 100, 250, -1],
                 [5, 10, 50, 100, 250, "All"]
             ],
             columns: [{
                     data: null,
                     name: null,
                     targets: 0,
                 },
                 {
                     data: 'id_ttd',
                     name: 'id_ttd',
                     visible: false

                 },
                 {
                     data: 'nama',
                     name: 'nama'
                 },
                 {
                     data: 'nip',
                     name: 'nip',
                     visible: false

                 },
                 {
                     data: 'jabatan',
                     name: 'jabatan'
                 },
                 {
                     data: 'pangkat',
                     name: 'pangkat'
                 },
                 {
                     data: null,
                     orderable: false,
                     render: (data, type, row, meta) =>
                         `<button type="button" style="margin-left:20px;margin-right:3px;" class="btn btn-warning btn-sm button edit-data" title="Edit data" id="editdata" data-toggle="modal"/><i class="bx bx-pencil"></i></button>` +
                         `<button type="button" class="btn btn-danger btn-sm button hps-data" data-toggle="modal" id="hapusdata" title="Hapus data"/><i class="bx bxs-trash"></i></button>`,
                 }
             ]
         });
         table.on('order.dt search.dt', function() {
             table.column(0, {
                 search: 'applied',
                 order: 'applied'
             }).nodes().each(function(cell, i) {
                 cell.innerHTML = i + 1;
             });
         }).draw();

         $('#modaltambah').modal({
             backdrop: "static"
         });

         $('.tmbh').on('click', function() {
             $('#modaltambah').modal('show');
         });

         $("#tambah").validate({
             rules: {
                 nama: {
                     required: true,
                 },
                 nip: {
                     required: true,
                 },
                 jbtn: {
                     required: true,
                 },
                 pangkat: {
                     required: true,
                 }
             },
             messages: {
                 nama: {
                     required: "* isikan nama"
                 },
                 nip: {
                     required: "* isikan nip"
                 },
                 jbtn: {
                     required: "* isikan jabatan",
                 },
                 pangkat: {
                     required: "* isikan pangkat",
                 },
             }
         });

         $('.close').on('click', function() {
             $('#tblttd').DataTable().ajax.reload();
             kosongtambah();
         });

         $('.simpandata').on('click', function(e) {
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
             $('.simpandata').submit();

             if ($('#nama').val() == '' || $('#nip').val() == '' || $('#jbtn').val() == '' || $(
                     '#pangkat').val() == '') {
                 return;
             }
             $.ajax({
                 url: "{{ route('tandatangan.simpandatatandatangan') }}",
                 type: 'POST',
                 data: {
                     nama: $('#nama').val(),
                     nip: $('#nip').val(),
                     jbtn: $('#jbtn').val(),
                     pangkat: $('#pangkat').val()
                 },
                 beforeSend: function() {
                     $('.simpandata').prop('disabled', true);
                 },
                 success: function(d) {
                     if (d.pesan == 1) {
                         toastr.info('Nama Sudah terpakai');
                     } else if (d.pesan == 0) {
                         toastr.success('Berhasil Tersimpan');
                     }
                 },
                 error: function() {},
                 complete: function(d) {
                     $('.simpandata').prop('disabled', false);
                     $('#modaltambah').modal('hide');
                     kosongtambah();
                     $('#tblttd').DataTable().ajax.reload();
                 }
             });
         });

         //  Modal Edit
         $('#modaledit').modal({
             backdrop: "static"
         });

         $("#formedit").validate({
             rules: {
                 editnama: {
                     required: true,
                 },
                 editnip: {
                     required: true,
                 },
                 editjbtn: {
                     required: true,
                 },
                 editpangkat: {
                     required: true,
                 }
             },
             messages: {
                 editnama: {
                     required: "* isikan nama"
                 },
                 editnip: {
                     required: "* isikan nip"
                 },
                 editjbtn: {
                     required: "* isikan jabatan",
                 },
                 editpangkat: {
                     required: "* isikan pangkat",
                 },
             }
         });
         $('#tblttd tbody').on('click', '#editdata', function() {
             var data = table.row($(this).parents('tr')).data();
             $('#editid_ttd').val(data.id_ttd);
             $('#editnama').val(data.nama);
             $('#editnip').val(data.nip);
             $('#editjbtn').val(data.jabatan);
             $('#editpangkat').val(data.pangkat);
             $('#modaledit').modal('show');
         });

         $('.updatedata').on('click', function() {
             $('.updatedata').submit();
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
             if ($('#editnama').val() == '' || $('#editnip').val() == '' || $('#editjbtn').val() == '' ||
                 $('#editpangkat').val() == '') {
                 return;
             }
             $.ajax({
                 url: "{{ route('tandatangan.updatedatatandatangan') }}",
                 type: 'POST',
                 data: {
                     id_ttd: $('#editid_ttd').val(),
                     nama: $('#editnama').val(),
                     nip: $('#editnip').val(),
                     jbtn: $('#editjbtn').val(),
                     pangkat: $('#editpangkat').val()
                 },
                 beforeSend: function() {
                     $('.updatedata').prop('disabled', true);
                 },
                 success: function(d) {
                     if (d.pesan == 0) {
                         toastr.success('Berhasil diupdate');
                     }
                 },
                 error: function() {},
                 complete: function(d) {
                     $('.updatedata').prop('disabled', false);
                     $('#tblttd').DataTable().ajax.reload();
                     $('#modaledit').modal('hide');
                 }
             });
         });

         $('.edit-cls').on('click', function() {
             $('#formedit').validate().resetForm();
         });

         //  Hapus data
         $('#tblttd tbody').on('click', '#hapusdata', function() {
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
             var data = table.row($(this).parents('tr')).data();
             let pesan = confirm('Yakin hapus data ' + data.nama + ' ?');
             if (pesan == true) {
                 $.ajax({
                     url: "{{ route('tandatangan.hapusdatatandatangan') }}",
                     type: 'post',
                     data: {
                         //  "_token": "{{ csrf_token() }}",
                         id_ttd: data.id_ttd,
                     },
                     beforeSend: function() {},
                     success: function(data) {
                         toastr.success(data.pesan);
                     },
                     error: function(xhr, status, error) {},
                     complete: function(xhr, status) {
                         $('#tblttd').DataTable().ajax.reload();
                     }
                 });
             } else {
                 $('#tblttd').DataTable().ajax.reload();
             }
         });
     });

     function kosongtambah() {
         $('#tambah').validate().resetForm();
         $('#nama').val('');
         $('#nip').val('');
         $('#jbtn').val('');
         $('#pangkat').val('');
     }
 </script>
