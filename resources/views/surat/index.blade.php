@extends('layouts.base')
@section('page-title', 'Manajemen Surat')
@section('content')
@include('surat.create')
<div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Data Dokumen</h5>
      </div>
      <!-- Order Column styles-->
          <div class="card-body">
            <div class="table-responsive">
              <table class="order-column surat">
                <thead>
                  <tr>
                    <th>No. BKU</th>
                    <th>No. Bukti</th>
                    <th>Tahun Anggaran</th>
                    <th>Created At</th>
                    <th>Total Export</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
      <!-- Order Column Ends-->
    </div>
  </div>
</div>
@endsection

@push('script.custom')
<script type="text/javascript">
$(document).ready(function() {  
  // init datatable.
  var dataTable = $('.surat').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: false,
      pageLength: 5,
      // scrollX: true,
      "order": [[ 0, "desc" ]],
      ajax: '{{ route('surat.get') }}',
      columns: [
          {data: 'no_bku', name: 'id'},
          {data: 'no_bukti', name: 'no_bukti'},
          {data: 'tahun_anggaran', name: 'tahun_anggaran'},
          {data: 'created_at', name: 'created_at'},
          {data: 'total_export', name: 'total_export'},
          {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
      ]
  });

  $('#addNewSurat').click(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ route('surat.add') }}",
        method: 'post',
        data: $("form#createSurat").serialize(),
        success: function(result) {
        if(result.errors) {
          toastr.error(result.errors);
          $('.alert-danger').html('');
          $.each(result.errors, function(key, value) {
              toastr.errors(value);
                $('.alert-danger').show();
                $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
            });
        } else {
            $('.alert-danger').hide();
            $('.alert-success').show();
            toastr.success(result.success);
            $('.datatable').DataTable().ajax.reload();
            setInterval(function(res){ 
                $('#addUser').modal('hide');
                location.reload();
            }, 1000);
          }
        }
    });
  });

  $('body').on('click', '#editSurat', function () {
    var id = $(this).data('id');
    $.get(`/surat/show/${id}`, function (data) {
        $('#editModalSurat').modal('show');
        $('#kode_rekeningEdit').val(data.kode_rekening);
        $('#no_bkuEdit').val(data.no_bku);
        $('#no_buktiEdit').val(data.no_bukti);
        $('#ket_terimaEdit').val(data.ket_terima);
        $('#uang_keluarEdit').val(data.uang_keluar);
        $('#keteranganEdit').val(data.keterangan);
        $('#penerimaEdit').val(data.penerima);
        $('#alamat_penerimaEdit').val(data.alamat_penerima);
        $('#penyetujuEdit').val(data.nama_penyetuju);
        $('#id_penyetujuEdit').val(data.id_penyetuju);
        $('#pengetahuiEdit').val(data.nama_pengetahu);
        $('#idPengetahuEdit').val(data.id_pengetahu);
        $('#pembayarEdit').val(data.nama_pembayar);
        $('#idPembayarEdit').val(data.id_pembayar);
    })
  });

    $('#updateSurat').click(function(e) {
      var id = $('#no_bkuEdit').val();
      console.log(id);
      e.preventDefault();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          url: `/surat/update/${id}`,
          method: 'put',
          data: $('form#updateDataSurat').serialize(),
          success: function(result) {
            if(result.errors) {
              toastr.error(result.errors);
              $('.alert-danger').html('');
              $.each(result.errors, function(key, value) {
                  toastr.errors(value);
                    $('.alert-danger').show();
                    $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                });
            } else {
                $('.alert-danger').hide();
                $('.alert-success').show();
                toastr.success(result.success);
                $('.datatable').DataTable().ajax.reload();
                setInterval(function(res){ 
                    $('#editModalSurat').modal('hide');
                    location.reload();
                }, 1000);
            }
          }
      });
    });

  // delete users
  $('body').on('click', '#deletePegawai', function (e) {
    e.preventDefault();
    const url = $(this).attr('href');
    Swal.fire({
    title: 'Are you sure?',
    icon: 'warning',
    text: 'This record and it`s details will be permanantly deleted!',
    showDenyButton: true,
    confirmButtonText: `Delete`,
    denyButtonText: `Cancel`,
  }).then((result) => {
    if (result.isConfirmed) {
       Swal.fire('Success delete users', '', 'success')
        setInterval(function(){ 
          window.location.href = url;
        }, 1000);
    } else if (result.isDenied) {
      Swal.fire('Changes are not saved', '', 'info')
    }
  });
});
});
</script>

<script>
   const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $( ".pegawai" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('pegawai.cari')}}",
            type: 'post',
            dataType: "json",
            data: {
               _token: CSRF_TOKEN,
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
          const id = $('#idPenyetuju').val();
          // Set selection
          $(this).filter('.pegawai').val(ui.item.value);
          $('#idPegawai').val(ui.item.id_pegawai);
          $('#idPenyetuju').val(ui.item.id_pegawai);
          $('#idPengetahu').val(ui.item.id_pegawai);
          $('#idPembayar').val(ui.item.id_pegawai);
          console.log(id);
          return false;
        }
      });
</script>
@endpush