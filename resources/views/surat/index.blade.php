@extends('layouts.base')
@section('page-title', 'Manajemen Surat')
@section('content')
@include('surat.create')
<div class="col-sm-12">
  <div class="card-body">
    <label><strong>Filter Data Surat</strong></label>
    <hr>
    <div class="row mb-2">
      <div class="col-sm-2">
        <div class="rak">
          <label>Waktu</label>
          <div class="form-group">
            <select name="waktu" class="form-control filter" id="waktu">
              <option value="">Pilih Waktu</option>
              <option value="Today">Hari ini</option>
              <option value="Yesterday">Kemarin</option>
              <option value="Last Week">Minggu Ini</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
          <label>Bulan</label>
          <div class="form-group">
            <select name="bulan" class="form-control filter" id="bulan">
              <option value="">Pilih Bulan</option>
              <option value="01">Januari</option>
              <option value="02">Februari</option>
              <option value="03">Maret</option>
              <option value="04">April</option>
              <option value="05">Mei</option>
              <option value="06">Juni</option>
              <option value="07">Juli</option>
              <option value="08">Agustus</option>
              <option value="09">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="Batch">
          <label>Tahun Anggaran</label>
          <div class="form-group">
            <input type="number" name="tahun" class="form-control filter" placeholder="Input tahun" id="tahun">
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
          <div class="row mt-4">
            <div class="col-sm-3">
            <label>Pilih Jenis Surat Yang Ingin Ditampilkan</label>
              <select name="jenis_surat" id="jenis_surat" class="form-control">
                <option value="">-- Silahkan Pilih --</option>
                <option value="BLUD">BLUD</option>
                <option value="BOK">BOK</option>
              </select>
            </div>
          </div>
      </div>
      <!-- Order Column styles-->
          <div class="card-body">
            <div class="table-responsive table-blud">
              <h4>Data Surat BLUD</h4>
              <table class="order-column surat">
                <thead>
                  <tr>
                    <th>No. BKU</th>
                    <th>No. Bukti</th>
                    <th>Tahun Anggaran</th>
                    <th>Dibuat pada</th>
                    <th>Total Export</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>

            <div class="table-responsive table-bok">
              <h4>Data Surat BOK</h4>
              <table class="order-column bok">
                <thead>
                  <tr>
                    <th>Keterangan</th>
                    <th>Kode Rekening</th>
                    <th>Penerima</th>
                    <th>Tahun Anggaran</th>
                    <th>Dibuat pada</th>
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
@endsection

@push('script.custom')
<script type="text/javascript">

let waktu = $("#waktu").val();
let month = $("#bulan").val();
let year = $("#tahun").val();
let jenis_surat = $('#jenis_surat').val();

$(document).ready(function() {  
  $('.table-blud').hide();
  $('.table-bok').hide();
  $('#jenis_surat').on('change', function() {
    if(this.value == "BLUD"){
      $('.table-bok').hide();
      $('.table-blud').show();
    } else if(this.value == "BOK") {
      $('.table-blud').hide();
      $('.table-bok').show();
    } else {
      $('.table-blud').hide();
      $('.table-bok').hide();
    }
  });

  const surat = $('.surat').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: true,
        pageLength: 5,
        columnDefs: [ {
              orderable: false,
              className: 'select-checkbox',
              targets:   0
          } ],
          select: {
              style:    'os',
              selector: 'td:first-child'
          },
        // scrollX: true,
        "order": [[ 0, "desc" ]],
        ajax: {
          url: '{{ route('surat.get') }}',
          type: "post",
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: function(d){
            d.waktu = waktu;
            d.month = month;
            d.tahun = year;
            return d
          }
        },
        columns: [
            {data: 'no_bku', name: 'id'},
            {data: 'no_bukti', name: 'no_bukti'},
            {data: 'tahun_anggaran', name: 'tahun_anggaran'},
            {data: 'created_at', name: 'created_at'},
            {data: 'total_export', name: 'total_export'},
            {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
        ]
    });
  
    const bok = $('.bok').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: true,
      pageLength: 5,
      columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
      // scrollX: true,
      "order": [[ 0, "desc" ]],
      ajax: {
        url: '{{ route('surat.get.bok') }}',
        type: "post",
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: function(d){
          d.waktu = waktu;
          d.month = month;
          d.tahun = year;
          return d
        }
      },
      columns: [
          {data: 'keterangan', name: 'keterangan'},
          {data: 'kode_rekening', name: 'kode_rekening'},
          {data: 'penerima', name: 'penerima'},
          {data: 'tahun_anggaran', name: 'tahun_anggaran'},
          {data: 'created_at', name: 'created_at'},
          {data: 'total_export', name: 'total_export'},
          {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
      ]
  });
  

  $(".filter").on('change', function(){
      waktu = $("#waktu").val();
      month = $("#bulan").val();
      year = $("#tahun").val();
      surat.ajax.reload(null,false)
    })
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
    let jenis_surat = $('#jenis_surat').val();
    if(jenis_surat == "BLUD"){
      $('.blud').show();
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
      });
    } else {
      $('.blud').hide();
      $.get(`/surat/bok/show/${id}`, function (data) {
          $('#editModalSurat').modal('show');
          $('#kode_rekeningEdit').val(data.kode_rekening);
          $('#idBOK').val(data.id);
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
        });
      }
  });

    $('#updateSurat').click(function(e) {
      e.preventDefault();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      let jenis_surat = $('#jenis_surat').val();
      if(jenis_surat == "BLUD"){
        var id = $('#no_bkuEdit').val();
        url = `/surat/update/${id}`;
      } else {
        var id = $('#idBOK').val();
        url = `/surat/bok/update/${id}`;
      }
      $.ajax({
          url: url,
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

      $( ".rekanan" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('rekanan.cari')}}",
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
          const id = $('#idPenerima').val();
          $(this).filter('.rekanan').val(ui.item.value);
          $('#alamat_penerima').text(ui.item.alamat);
          return false;
        }
      });
</script>

<script>
  $('.bku').hide();
  $('select#tipe_surat').on('change', function() {
    if(this.value == "BLUD"){
      $('.bku').show();
    } else {
      $('.bku').hide();
    }
});
</script>
@endpush