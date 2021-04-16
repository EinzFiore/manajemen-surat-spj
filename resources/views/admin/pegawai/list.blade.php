@extends('layouts.base')
@section('page-title', 'Manajemen Pegawai')
@section('content')
@include('admin.pegawai.create')
<div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Data Pegawai</h5>
      </div>
      <!-- Order Column styles-->
          <div class="card-body">
            <div class="table-responsive">
              <table class="order-column pegawai">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>NIP</th>
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
        var dataTable = $('.pegawai').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 5,
            // scrollX: true,
            "order": [[ 0, "desc" ]],
            ajax: '{{ route('admin.pegawai.get') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama', name: 'name'},
                {data: 'jabatan', name: 'name'},
                {data: 'nip', name: 'email'},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });

          $('#addNewPegawai').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.pegawai.add') }}",
                method: 'post',
                data: $("form#createPegawai").serialize(),
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

    $('body').on('click', '#editPegawai', function () {
      var id = $(this).data('id');
      $.get(`/admin/pegawai/show/${id}`, function (data) {
          $('#editModalPegawai').modal('show');
          $('#idPegawai').val(data.id);
          $('#namaPegawai').val(data.nama);
          $('#jabatanPegawai').val(data.jabatan);
          $('#nipPegawai').val(data.nip);
      })
    });

    // Edit users Ajax request.
    $('#updatePegawai').click(function(e) {
      const id = $('#idPegawai').val();
      e.preventDefault();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          url: `/admin/pegawai/update/${id}`,
          method: 'put',
          data: $('form#editPegawai').serialize(),
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
                      $('#updatePegawai').modal('hide');
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
  })
});
});
</script>
@endpush