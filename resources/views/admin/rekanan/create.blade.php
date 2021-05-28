<div>
    <div class="col-sm-12 mb-2">
        <div class="row">
          <div class="col-xl-6 col-sm-12">
              <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#addRekanan">Tambah Rekanan</button>
          </div>
        </div>
    </div>
  </div>

  
<div class="modal fade" id="addRekanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Rekanan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form id="createRekanan">
                <div class="form-group">
                  <label class="col-form-label" for="recipient-name">Nama</label>
                  <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="nama" placeholder="Nama Rekanan">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="recipient-name">Alamat</label>
                  <textarea class="form-control @error('username') is-invalid @enderror" type="text" id="jabatan" name="alamat" placeholder="Alamat"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="addNewRekanan" type="button">Add</button>
            </div>
        </form>
      </div>
    </div>
  </div>

<div class="modal fade" id="editModalRekanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Rekanan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="editRekanan">
            <div class="form-group">
              <label class="col-form-label" for="recipient-name">Nama</label>
              <input class="form-control @error('name') is-invalid @enderror" type="text" id="namaRekanan" name="nama" placeholder="Nama Rekanan">
              <input class="form-control" type="hidden" id="idRekanan">
            </div>
            <div class="form-group">
              <label class="col-form-label" for="recipient-name">Alamat</label>
              <textarea class="form-control @error('username') is-invalid @enderror" type="text" id="alamatRekanan" name="alamat" placeholder="Alamat"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" id="updateRekanan" type="button">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>