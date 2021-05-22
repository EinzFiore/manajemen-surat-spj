<div>
    <div class="col-sm-12 mb-2">
        <div class="row">
          <div class="col-xl-6 col-sm-12">
              <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#addSurat">Surat Baru</button>
          </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="addSurat" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Buat Surat Baru</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form id="createSurat">
              <div class="form-group">
                <label class="col-form-label" for="recipient-name">Kode Rekening</label>
                <input class="form-control @error('kode_rekening') is-invalid @enderror" type="text" id="kode_rekening" name="kode_rekening" placeholder="Kode Rekening">
              </div>
              <div class="form-group">
                <label class="col-form-label" for="recipient-name">No. BKU</label>
                <input class="form-control @error('no_bku') is-invalid @enderror" type="number" id="no_bku" name="no_bku" placeholder="Nomor BKU">
              </div>
              <div class="form-group">
                <label class="col-form-label" for="recipient-name">No. Bukti</label>
                <input class="form-control @error('no_bukti') is-invalid @enderror" type="text" id="no_bukti" name="no_bukti" placeholder="Nomor Bukti">
              </div>
                <div class="form-group">
                  <label class="col-form-label" for="recipient-name">Keterangan Terima</label>
                  <textarea class="form-control @error('ket_terima') is-invalid @enderror" type="text" id="ket_terima" name="ket_terima" placeholder="Keterangan"></textarea>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Uang Keluar</label>
                  <input class="form-control @error('uang_keluar') is-invalid @enderror"  type="number" id="uang_keluar" name="uang_keluar" placeholder="Jumlah Uang Keluar">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Keterangan Pengeluaran</label>
                  <textarea class="form-control @error('keterangan') is-invalid @enderror"  type="text" id="keterangan" name="keterangan" placeholder="Keterangan Uang Keluar"></textarea>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Penerima</label>
                  <input class="form-control @error('penerima') is-invalid @enderror"  type="text" id="penerima" name="penerima" placeholder="Nama Penerima">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Alamat Penerima</label>
                  <textarea class="form-control @error('alamat_penerima') is-invalid @enderror"  type="text" id="alamat_penerima" name="alamat_penerima" placeholder="Alamat Penerima"></textarea>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Penyetuju</label>
                  <input class="form-control pegawai @error('penyetuju') is-invalid @enderror"  type="text" id="penyetuju" name="nama_penyetuju" placeholder="Nama Penyetuju">
                  <input class="form-control idPegawai" type="hidden" id="idPenyetuju" name="id_penyetuju">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Pengetahui</label>
                  <input class="form-control pegawai @error('pengetahui') is-invalid @enderror"  type="text" id="pengetahui " name="nama_pengetahui" placeholder="Nama Pengetahui">
                  <input class="form-control idPegawai" type="hidden" id="idPengetahu" name="id_pengetahu">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Pembayar</label>
                  <input class="form-control pegawai @error('pembayar') is-invalid @enderror"  type="text" id="pembayar " name="nama_pembayar" placeholder="Nama Pembayar">
                  <input class="form-control idPegawai" type="hidden" id="idPembayar" name="id_pembayar">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="addNewSurat" type="button">Add</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editModalSurat" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Surat</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form id="updateDataSurat">
              <div class="form-group">
                <label class="col-form-label" for="recipient-name">Kode Rekening</label>
                <input class="form-control @error('kode_rekening') is-invalid @enderror" type="text" id="kode_rekeningEdit" name="kode_rekening" placeholder="Kode Rekening">
              </div>
              <div class="form-group">
                <label class="col-form-label" for="recipient-name">No. BKU</label>
                <input class="form-control @error('no_bku') is-invalid @enderror" type="number" id="no_bkuEdit" name="no_bku" placeholder="Nomor BKU" readonly>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="recipient-name">No. Bukti</label>
                <input class="form-control @error('no_bukti') is-invalid @enderror" type="text" id="no_buktiEdit" name="no_bukti" placeholder="Nomor Bukti">
              </div>
                <div class="form-group">
                  <label class="col-form-label" for="recipient-name">Keterangan Terima</label>
                  <textarea class="form-control @error('ket_terima') is-invalid @enderror" type="text" id="ket_terimaEdit" name="ket_terima" placeholder="Keterangan"></textarea>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Uang Keluar</label>
                  <input class="form-control @error('uang_keluar') is-invalid @enderror"  type="number" id="uang_keluarEdit" name="uang_keluar" placeholder="Jumlah Uang Keluar">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Keterangan Pengeluaran</label>
                  <textarea class="form-control @error('keterangan') is-invalid @enderror"  type="text" id="keteranganEdit" name="keterangan" placeholder="Keterangan Uang Keluar"></textarea>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Penerima</label>
                  <input class="form-control @error('penerima') is-invalid @enderror"  type="text" id="penerimaEdit" name="penerima" placeholder="Nama Penerima">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Alamat Penerima</label>
                  <textarea class="form-control @error('alamat_penerima') is-invalid @enderror"  type="text" id="alamat_penerimaEdit" name="alamat_penerima" placeholder="Alamat Penerima"></textarea>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Penyetuju</label>
                  <input class="form-control pega wai @error('penyetuju') is-invalid @enderror"  type="text" id="penyetujuEdit" name="nama_penyetuju" placeholder="Nama Penyetuju">
                  <input class="form-control idPegawai" type="hidden" id="id_penyetujuEdit" name="id_penyetuju">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Pengetahui</label>
                  <input class="form-control pegawai @error('pengetahui') is-invalid @enderror"  type="text" id="pengetahuiEdit" name="nama_pengetahui" placeholder="Nama Pengetahui">
                  <input class="form-control idPegawai" type="hidden" id="idPengetahuEdit" name="id_pengetahu">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="message-text">Pembayar</label>
                  <input class="form-control pegawai @error('pembayar') is-invalid @enderror"  type="text" id="pembayarEdit" name="nama_pembayar" placeholder="Nama Pembayar">
                  <input class="form-control idPegawai" type="hidden" id="idPembayarEdit" name="id_pembayar">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="updateSurat" type="button">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>