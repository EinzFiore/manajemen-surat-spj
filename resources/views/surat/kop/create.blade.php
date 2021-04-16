<div>
    <div class="col-sm-12 mb-2">
        <div class="row">
          <div class="col-xl-6 col-sm-12">
              <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#addKop">Buat Kop Baru</button>
          </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="addKop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Kop Surat</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form id="createKop">
                <div class="form-group">
                  <label class="col-form-label" for="recipient-name">Tahun Anggaran</label>
                  <input class="form-control @error('tahun_anggaran') is-invalid @enderror" value="<?= date('Y') ?>" type="number" id="tahun_anggaran" name="tahun_anggaran" placeholder="20**">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="recipient-name">Kode Rekening</label>
                  <input class="form-control @error('kode_rekening') is-invalid @enderror" type="text" id="kode_rekening" name="kode_rekening" placeholder="Kode Rekening">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Nomor Bukti</label>
                  <input class="form-control @error('no_bukti') is-invalid @enderror"  type="text" id="no_bukti" name="no_bukti" placeholder="Nomor Bukti">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Kegiatan</label>
                  <textarea class="form-control @error('kegiatan') is-invalid @enderror"  type="text" id="kegiatan" name="kegiatan" placeholder="Kegiatan"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="addNewKop" type="button">Add</button>
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
        <form id="updateKop">
            <div class="form-group">
              <label class="col-form-label" for="recipient-name">Tahun Anggaran</label>
              <input class="form-control @error('tahun_anggaran') is-invalid @enderror" type="number" id="tahun_anggaran" name="tahun_anggaran" placeholder="20**">
            </div>
            <div class="form-group">
              <label class="col-form-label" for="recipient-name">Kode Rekening</label>
              <input class="form-control @error('kode_rekening') is-invalid @enderror" type="text" id="kode_rekening" name="kode_rekening" placeholder="Kode Rekening">
            </div>
            <div class="form-group">
              <label class="col-form-label" for="message-text">Nomor Bukti</label>
              <input class="form-control @error('no_bukti') is-invalid @enderror"  type="text" id="no_bukti" name="no_bukti" placeholder="Nomor Bukti">
            </div>
            <div class="form-group">
              <label class="col-form-label" for="message-text">Kegiatan</label>
              <input class="form-control @error('kegiatan') is-invalid @enderror"  type="text" id="kegiatan" name="kegiatan" placeholder="Kegiatan">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" id="updateNewKop" type="button">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>