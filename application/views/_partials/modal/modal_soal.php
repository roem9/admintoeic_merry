<div class="modal modal-blur fade" id="addSoal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Soal Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddSoal">
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_pembuatan" class="form form-control required">
                        <label for="">Tgl Pembuatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="tipe_soal" class="form form-control required">
                            <option value="">Pilih Tipe Soal</option>
                            <option value="TOEIC">TOEIC</option>
                            <option value="Latihan">Latihan</option>
                        </select>
                        <label for="">Tipe Soal</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="poin" class="number form form-control" disabled>
                        <label for="">Poin Per Soal</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_soal" class="form form-control required">
                        <label for="">Nama Soal</label>
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

<div class="modal modal-blur fade" id="editSoal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_soal" class="form">
                <div class="form-floating mb-3">
                    <input type="date" name="tgl_pembuatan" class="form form-control required">
                    <label for="">Tgl Pembuatan</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="tipe_soal" class="form form-control required">
                        <option value="">Pilih Tipe Soal</option>
                        <option value="TOEIC">TOEIC</option>
                        <option value="Latihan">Latihan</option>
                    </select>
                    <label for="">Tipe Soal</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="poin" class="number form form-control">
                    <label for="">Poin Per Soal</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="nama_soal" class="form form-control required">
                    <label for="">Nama Soal</label>
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

<div class="modal modal-blur fade" id="komponenSoal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Komponen Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group mb-3">
                    <li class="list-group-item list-group-item-info">Sesi Soal</li>
                    <div id="sesiSoal"></div>
                    <!-- <li class="list-group-item d-flex justify-content-between">
                        Nama Sub Soal
                        <a href="javascript:void(0)" class="deleteSesi" data-id="`+dataSesi.id+`">
                            <?= tablerIcon("trash", "me-1");?>
                        </a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Nama Sub Soal
                        <a href="javascript:void(0)" class="deleteSesi" data-id="`+dataSesi.id+`">
                            <?= tablerIcon("trash", "me-1 text-danger");?>
                        </a>
                    </li> -->
                </ul>
                
                <div class="alert alert-important alert-info alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <?= tablerIcon("info-circle", 'me-1')?>
                        </div>
                        <div>
                            Untuk menambahkan sesi soal isi form dibawah ini
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id_soal" class="form">
                <form class="user" id="formKomponenSoal">
                    <div class="form-floating mb-3">
                        <select name="id_sub" class="form form form-control required">
                            <option value="">Pilih Sub Soal</option>
                            <?php foreach ($sub_soal as $data) :?>
                                <option value="<?= $data['id_sub']?>"><?= $data['nama_sub']?></option>
                            <?php endforeach;?>
                        </select>
                        <label>Sub Soal</label>
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