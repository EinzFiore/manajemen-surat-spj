<div>
    <div class="col-sm-12 mb-2">
        <div class="row">
          <div class="col-xl-6 col-sm-12">
              <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#addPegawai">Tambah Pegawai</button>
          </div>
        </div>
    </div>
  </div>

  
<div class="modal fade" id="addPegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pegawai</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form id="createPegawai">
                <div class="form-group">
                  <label class="col-form-label" for="recipient-name">Nama</label>
                  <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="nama" placeholder="Nama Pegawai">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="recipient-name">Jabatan</label>
                  <input class="form-control @error('username') is-invalid @enderror" type="text" id="jabatan" name="jabatan" placeholder="Jabatan">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">NIP</label>
                  <input class="form-control @error('email') is-invalid @enderror"  type="text" id="nip" name="nip" placeholder="NIP">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="addNewPegawai" type="button">Add</button>
            </div>
        </form>
      </div>
    </div>
  </div>

<div class="modal fade" id="editModalPegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Pegawai</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="editPegawai">
            <div class="form-group">
              <label class="col-form-label" for="recipient-name">Nama</label>
              <input class="form-control @error('name') is-invalid @enderror" type="text" id="namaPegawai" name="nama" placeholder="Nama Pegawai">
              <input class="form-control" type="hidden" id="idPegawai">
            </div>
            <div class="form-group">
              <label class="col-form-label" for="recipient-name">Jabatan</label>
              <input class="form-control @error('username') is-invalid @enderror" type="text" id="jabatanPegawai" name="jabatan" placeholder="Jabatan">
            </div>
            <div class="form-group">
              <label class="col-form-label" for="message-text">NIP</label>
              <input class="form-control @error('email') is-invalid @enderror"  type="text" id="nipPegawai" name="nip" placeholder="NIP">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" id="updatePegawai" type="button">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>