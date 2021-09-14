<div class="modal modal-blur fade" id="addSubSoal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Sub Soal Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddSubSoal">
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_pembuatan" class="form form-control required">
                        <label for="">Tgl Pembuatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_sub" class="form form-control required">
                        <label for="">Nama Sub Soal</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="catatan" class="form form-control required" style="height: 100px"></textarea>
                        <label for="" class="col-form-label">Catatan</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-auto mr-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btnTambah">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="editSubSoal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Sub Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_sub" class="form">
                <div class="form-floating mb-3">
                    <input type="date" name="tgl_pembuatan" class="form form-control required">
                    <label for="">Tgl Pembuatan</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="nama_sub" class="form form-control required">
                    <label for="">Nama Sub Soal</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="catatan" class="form form-control required" style="height: 100px"></textarea>
                    <label for="" class="col-form-label">Catatan</label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-auto mr-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success btnEdit">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
