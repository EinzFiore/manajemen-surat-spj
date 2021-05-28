@extends('layouts.base')
@section('page-title', 'Manajemen Rekanan')
@section('content')
@include('admin.rekanan.create')
<div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Data Rekanan</h5>
      </div>
      <!-- Order Column styles-->
          <div class="card-body">
            <div class="table-responsive">
              <table class="order-column rekanan">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Perusahaan/Jabatan</th>
                    <th>Alamat</th>
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
  $(document).ready(function() {  
        // init datatable.
        var dataTable = $('.rekanan').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 5,
            // scrollX: true,
            "order": [[ 0, "desc" ]],
            ajax: '{{ route('admin.rekanan.get') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama', name: 'name'},
                {data: 'perusahaan', name: 'perusahaan'},
                {data: 'alamat', name: 'alamat'},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });

          $('#addNewRekanan').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.rekanan.add') }}",
                method: 'post',
                data: $("form#createRekanan").serialize(),
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

    $('body').on('click', '#editRekanan', function () {
      var id = $(this).data('id');
      $.get(`/admin/rekanan/show/${id}`, function (data) {
          $('#editModalRekanan').modal('show');
          $('#idRekanan').val(data.id);
          $('#namaRekanan').val(data.nama);
          $('#perusahaanRekanan').val(data.perusahaan);
          $('#alamatRekanan').val(data.alamat);
      })
    });

    // Edit users Ajax request.
    $('#updateRekanan').click(function(e) {
      const id = $('#idRekanan').val();
      e.preventDefault();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          url: `/admin/rekanan/update/${id}`,
          method: 'put',
          data: $('form#editRekanan').serialize(),
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
                      $('#updateRekanan').modal('hide');
                      location.reload();
                  }, 1000);
              }
          }
      });
  });

  // delete users
  $('body').on('click', '#deleteRekanan', function (e) {
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
  })
});
});
</script>
@endpush